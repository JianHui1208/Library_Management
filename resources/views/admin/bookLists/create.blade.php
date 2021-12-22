@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.bookList.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.book-lists.store") }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="form-group {{ $errors->has('uid') ? 'has-error' : '' }}">
                            <label class="required" for="uid">{{ trans('cruds.bookList.fields.uid') }}</label>
                            <input class="form-control" type="text" name="uid" id="uid" value="{{ old('uid', '') }}" required>
                            @if($errors->has('uid'))
                                <span class="help-block" role="alert">{{ $errors->first('uid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.uid_helper') }}</span>
                        </div> --}}
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.bookList.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('book_category') ? 'has-error' : '' }}">
                            <label for="book_category_id">{{ trans('cruds.bookList.fields.book_category') }}</label>
                            <select class="form-control select2" name="book_category_id" id="book_category_id">
                                @foreach($book_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('book_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('book_category'))
                                <span class="help-block" role="alert">{{ $errors->first('book_category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.book_category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('book_tags') ? 'has-error' : '' }}">
                            <label for="book_tags">{{ trans('cruds.bookList.fields.book_tag') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="book_tags[]" id="book_tags" multiple>
                                @foreach($book_tags as $id => $book_tag)
                                    <option value="{{ $id }}" {{ in_array($id, old('book_tags', [])) ? 'selected' : '' }}>{{ $book_tag }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('book_tags'))
                                <span class="help-block" role="alert">{{ $errors->first('book_tags') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.book_tag_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bookList.fields.language') }}</label>
                            <select class="form-control" name="language" id="language">
                                <option value disabled {{ old('language', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\BookList::LANGUAGE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('language', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('language'))
                                <span class="help-block" role="alert">{{ $errors->first('language') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.language_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                            <label for="year">{{ trans('cruds.bookList.fields.year') }}</label>
                            <input class="form-control" type="number" name="year" id="year" value="{{ old('year', '') }}" step="1">
                            @if($errors->has('year'))
                                <span class="help-block" role="alert">{{ $errors->first('year') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.year_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.bookList.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\BookList::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">{{ trans('cruds.bookList.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookList.fields.image_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.book-lists.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($bookList) && $bookList->image)
      var file = {!! json_encode($bookList->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection