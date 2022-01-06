<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentManagementRequest;
use App\Http\Requests\StoreContentManagementRequest;
use App\Http\Requests\UpdateContentManagementRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\ContentManagement;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class ContentManagementController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('content_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContentManagement::query()->select(sprintf('%s.*', (new ContentManagement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'content_management_show';
                $editGate = 'content_management_edit';
                $actionGate = 'content_management_edit';
                $deleteGate = 'content_management_delete';
                $crudRoutePart = 'content-managements';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'actionGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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
            $table->editColumn('status', function ($row) {
                return $row->status ? ContentManagement::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.contentManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('content_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentManagements.create');
    }

    public function store(StoreContentManagementRequest $request)
    {
        $contentManagement = ContentManagement::create($request->all());

        if ($request->input('image', false)) {
            $contentManagement->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentManagement->id]);
        }

        return redirect()->route('admin.content-managements.index');
    }

    public function edit(ContentManagement $contentManagement)
    {
        abort_if(Gate::denies('content_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentManagements.edit', compact('contentManagement'));
    }

    public function update(UpdateContentManagementRequest $request, ContentManagement $contentManagement)
    {
        $contentManagement->update($request->all());

        if ($request->input('image', false)) {
            if (!$contentManagement->image || $request->input('image') !== $contentManagement->image->file_name) {
                if ($contentManagement->image) {
                    $contentManagement->image->delete();
                }
                $contentManagement->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($contentManagement->image) {
            $contentManagement->image->delete();
        }

        return redirect()->route('admin.content-managements.index');
    }

    public function show(ContentManagement $contentManagement)
    {
        abort_if(Gate::denies('content_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentManagements.show', compact('contentManagement'));
    }

    public function destroy(ContentManagement $contentManagement)
    {
        abort_if(Gate::denies('content_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentManagementRequest $request)
    {
        ContentManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_management_create') && Gate::denies('content_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentManagement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function actions(Request $request)
    {
        $contentManagement = ContentManagement::where('id', '=', $request->input('id'))->first();

        if($contentManagement->status == 1){
            $contentManagement->status = 2;
        } else {
            $contentManagement->status = 1;
        }

        $contentManagement->save();

        Toastr::success('Content Status Updated Successfully','Success');
        return back();
    }

    public function getContent()
    {
        $contents = ContentManagement::where('status', 1)->get();

        return view('welcome', compact('contents'));
    }

    public function getContentDetail($id)
    {
        $contents = ContentManagement::where('id', $id)->first();
        return view('users.content.show', compact('contents'));
    }
}
