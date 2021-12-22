@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.question.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                            <label for="answer">{{ trans('cruds.question.fields.answer') }}</label>
                            <input class="form-control" type="text" name="answer" id="answer" value="{{ old('answer', '') }}">
                            @if($errors->has('answer'))
                                <span class="help-block" role="alert">{{ $errors->first('answer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.answer_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.question.fields.language') }}</label>
                            <select class="form-control" name="language" id="language">
                                <option value disabled {{ old('language', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Question::LANGUAGE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('language', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('language'))
                                <span class="help-block" role="alert">{{ $errors->first('language') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.language_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.question.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Question::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.status_helper') }}</span>
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