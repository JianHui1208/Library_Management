@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label for="username">{{ trans('cruds.user.fields.username') }}</label>
                            <input class="form-control" type="text" name="username" id="username" value="{{ old('username', '') }}">
                            @if($errors->has('username'))
                                <span class="help-block" role="alert">{{ $errors->first('username') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                            <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                            @if($errors->has('phone_number'))
                                <span class="help-block" role="alert">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.user.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\User::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '2') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="help-block" role="alert">{{ $errors->first('roles') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection