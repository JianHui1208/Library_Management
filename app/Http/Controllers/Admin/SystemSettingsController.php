<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySystemSettingRequest;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use Illuminate\Support\Facades\DB;
use App\Models\SystemSetting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SystemSettingsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('system_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $SystemSetting = SystemSetting::all();
        $type = SystemSetting::all()->unique('type');

        return view('admin.systemSettings.index', compact('SystemSetting', 'type'));

        if ($request->ajax()) {
            $query = SystemSetting::query()->select(sprintf('%s.*', (new SystemSetting())->table))->orderBy('id', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'system_setting_show';
                $editGate = 'system_setting_edit';
                $deleteGate = 'system_setting_delete';
                $crudRoutePart = 'system-settings';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
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
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('key', function ($row) {
                return $row->key ? $row->key : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
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

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.systemSettings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('system_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.systemSettings.create');
    }

    public function store(StoreSystemSettingRequest $request)
    {
        $systemSetting = SystemSetting::create($request->all());

        if ($request->input('image', false)) {
            $systemSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $systemSetting->id]);
        }

        return redirect()->route('admin.system-settings.index');
    }

    public function edit(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.systemSettings.edit', compact('systemSetting'));
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

        return redirect()->route('admin.system-settings.index');
    }

    public function show(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.systemSettings.show', compact('systemSetting'));
    }

    public function destroy(SystemSetting $systemSetting)
    {
        abort_if(Gate::denies('system_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $systemSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroySystemSettingRequest $request)
    {
        SystemSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('system_setting_create') && Gate::denies('system_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SystemSetting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function custom_edit(Request $request)
    {
        \DB::beginTransaction();
        try {

            foreach ($request->all() as $key => $item) {

                $SystemSetting = SystemSetting::find($key);

                if (empty($SystemSetting)) {
                    continue;
                }

                $SystemSetting->update([
                    'value' => $item
                ]);

            }

            \DB::commit();

        } catch (\Exception $e) {

            \DB::rollback();

            return [
                'status' => -1,
                'ret_msg' => 'Something Error !!'
            ];
        }

        return [
            'status' => 0,
            'ret_msg' => trans('global.update_success')
        ];

    }
}
