<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use App\Http\Resources\Admin\SystemSettingResource;
use App\Models\SystemSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemSettingsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('system_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemSettingResource(SystemSetting::all());
    }

    public function store(StoreSystemSettingRequest $request)
    {
        $systemSetting = SystemSetting::create($request->all());

        if ($request->input('image', false)) {
            $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new SystemSettingResource($systemSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SystemSettingResource($systemSetting);
    }

    public function update(UpdateSystemSettingRequest $request, SystemSetting $systemSetting)
    {
        $systemSetting->update($request->all());

        if ($request->input('image', false)) {
            if (!$systemSetting->image || $request->input('image') !== $systemSetting->image->file_name) {
                if ($systemSetting->image) {
                    $systemSetting->image->delete();
                }
                $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($systemSetting->image) {
            $systemSetting->image->delete();
        }

        return (new SystemSettingResource($systemSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
