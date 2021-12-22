@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.systemSetting.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.system-settings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.key') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->key }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.value') }}
                                    </th>
                                    <td>
                                        {{ $systemSetting->value }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.systemSetting.fields.image') }}
                                    </th>
                                    <td>
                                        @if($systemSetting->image)
                                            <a href="{{ $systemSetting->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $systemSetting->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.system-settings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection