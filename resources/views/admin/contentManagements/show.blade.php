@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.contentManagement.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.content-managements.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentManagement.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $contentManagement->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentManagement.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $contentManagement->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentManagement.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $contentManagement->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentManagement.fields.image') }}
                                    </th>
                                    <td>
                                        @if($contentManagement->image)
                                            <a href="{{ $contentManagement->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $contentManagement->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentManagement.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ContentManagement::STATUS_SELECT[$contentManagement->status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.content-managements.index') }}">
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