<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBookListRequest;
use App\Http\Requests\StoreBookListRequest;
use App\Http\Requests\UpdateBookListRequest;
use App\Models\BookCategory;
use App\Models\BookList;
use App\Models\BookTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookListController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('book_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookList::with(['book_category', 'book_tags'])->select(sprintf('%s.*', (new BookList())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'book_list_show';
                $editGate = 'book_list_edit';
                $deleteGate = 'book_list_delete';
                $crudRoutePart = 'book-lists';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('uid', function ($row) {
                return $row->uid ? $row->uid : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('book_category_title', function ($row) {
                return $row->book_category ? $row->book_category->title : '';
            });

            $table->editColumn('book_tag', function ($row) {
                $labels = [];
                foreach ($row->book_tags as $book_tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $book_tag->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('language', function ($row) {
                return $row->language ? BookList::LANGUAGE_SELECT[$row->language] : '';
            });
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BookList::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'book_category', 'book_tag', 'image']);

            return $table->make(true);
        }

        return view('admin.bookLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('book_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book_categories = BookCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $book_tags = BookTag::pluck('title', 'id');

        return view('admin.bookLists.create', compact('book_categories', 'book_tags'));
    }

    public function store(StoreBookListRequest $request)
    {
        $uid = BookList::generateUID();
        $booklistUID = BookList::where('uid', $uid)->first();

        while ($booklistUID) {
            $uid = BookList::generateUID();
            $booklistUID = BookList::where('uid', $uid)->first();
        }

        $request['uid'] = $uid;
        $bookList = BookList::create($request->all());
        $bookList->book_tags()->sync($request->input('book_tags', []));
        if ($request->input('image', false)) {
            $bookList->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bookList->id]);
        }

        return redirect()->route('admin.book-lists.index');
    }

    public function edit(BookList $bookList)
    {
        abort_if(Gate::denies('book_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $book_categories = BookCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $book_tags = BookTag::pluck('title', 'id');

        $bookList->load('book_category', 'book_tags');

        return view('admin.bookLists.edit', compact('bookList', 'book_categories', 'book_tags'));
    }

    public function update(UpdateBookListRequest $request, BookList $bookList)
    {
        $bookList->update($request->all());
        $bookList->book_tags()->sync($request->input('book_tags', []));
        if ($request->input('image', false)) {
            if (!$bookList->image || $request->input('image') !== $bookList->image->file_name) {
                if ($bookList->image) {
                    $bookList->image->delete();
                }
                $bookList->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bookList->image) {
            $bookList->image->delete();
        }

        return redirect()->route('admin.book-lists.index');
    }

    public function show(BookList $bookList)
    {
        abort_if(Gate::denies('book_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookList->load('book_category', 'book_tags');

        return view('admin.bookLists.show', compact('bookList'));
    }

    public function destroy(BookList $bookList)
    {
        abort_if(Gate::denies('book_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookList->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookListRequest $request)
    {
        BookList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('book_list_create') && Gate::denies('book_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BookList();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
