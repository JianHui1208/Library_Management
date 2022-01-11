<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookTagRequest;
use App\Http\Requests\StoreBookTagRequest;
use App\Http\Requests\UpdateBookTagRequest;
use App\Models\BookTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookTagController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('book_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookTag::query()->select(sprintf('%s.*', (new BookTag())->table))->orderBy('id', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'book_tag_show';
                $editGate = 'book_tag_edit';
                $deleteGate = 'book_tag_delete';
                $actionGate = 'book_tag_delete';
                $crudRoutePart = 'book-tags';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'actionGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BookTag::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bookTags.index');
    }

    public function create()
    {
        abort_if(Gate::denies('book_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookTags.create');
    }

    public function store(StoreBookTagRequest $request)
    {
        $bookTag = BookTag::create($request->all());

        return redirect()->route('admin.book-tags.index');
    }

    public function edit(BookTag $bookTag)
    {
        abort_if(Gate::denies('book_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookTags.edit', compact('bookTag'));
    }

    public function update(UpdateBookTagRequest $request, BookTag $bookTag)
    {
        $bookTag->update($request->all());

        return redirect()->route('admin.book-tags.index');
    }

    public function show(BookTag $bookTag)
    {
        abort_if(Gate::denies('book_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookTags.show', compact('bookTag'));
    }

    public function destroy(BookTag $bookTag)
    {
        abort_if(Gate::denies('book_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookTagRequest $request)
    {
        BookTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
