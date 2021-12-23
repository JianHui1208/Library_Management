@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.bookLoan.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.book-loans.update", [$bookLoan->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                            <label for="user_id">{{ trans('cruds.bookLoan.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $bookLoan->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <span class="help-block" role="alert">{{ $errors->first('user') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookLoan.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('book') ? 'has-error' : '' }}">
                            <label for="book_id">{{ trans('cruds.bookLoan.fields.book') }}</label>
                            <select class="form-control select2" name="book_id" id="book_id">
                                @foreach($books as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('book_id') ? old('book_id') : $bookLoan->book->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('book'))
                                <span class="help-block" role="alert">{{ $errors->first('book') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookLoan.fields.book_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('expired_time') ? 'has-error' : '' }}">
                            <label for="expired_time">{{ trans('cruds.bookLoan.fields.expired_time') }}</label>
                            <input class="form-control datetime" type="text" name="expired_time" id="expired_time" value="{{ old('expired_time', $bookLoan->expired_time) }}">
                            @if($errors->has('expired_time'))
                                <span class="help-block" role="alert">{{ $errors->first('expired_time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookLoan.fields.expired_time_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bookLoan.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\BookLoan::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $bookLoan->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookLoan.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('expired_pay') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="expired_pay" value="0">
                                <input type="checkbox" name="expired_pay" id="expired_pay" value="1" {{ $bookLoan->expired_pay || old('expired_pay', 0) === 1 ? 'checked' : '' }}>
                                <label for="expired_pay" style="font-weight: 400">{{ trans('cruds.bookLoan.fields.expired_pay') }}</label>
                            </div>
                            @if($errors->has('expired_pay'))
                                <span class="help-block" role="alert">{{ $errors->first('expired_pay') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookLoan.fields.expired_pay_helper') }}</span>
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