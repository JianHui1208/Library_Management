<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreContentManagementRequest;
use App\Http\Requests\UpdateContentManagementRequest;
use App\Http\Resources\Admin\ContentManagementResource;
use App\Models\ContentManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentManagementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('content_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContentManagementResource(ContentManagement::all());
    }

    public function store(StoreContentManagementRequest $request)
    {
        $contentManagement = ContentManagement::create($request->all());

        if ($request->input('image', false)) {
            $contentManagement->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new ContentManagementResource($contentManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContentManagement $contentManagement)
    {
        abort_if(Gate::denies('content_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContentManagementResource($contentManagement);
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

        return (new ContentManagementResource($contentManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContentManagement $contentManagement)
    {
        abort_if(Gate::denies('content_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
