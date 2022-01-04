@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bookList.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-lists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.uid') }}
                                    </th>
                                    <td>
                                        {{ $bookList->uid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $bookList->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $bookList->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.book_category') }}
                                    </th>
                                    <td>
                                        {{ $bookList->book_category->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.book_tag') }}
                                    </th>
                                    <td>
                                        @foreach($bookList->book_tags as $key => $book_tag)
                                            <span class="label label-info">{{ $book_tag->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.language') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BookList::LANGUAGE_SELECT[$bookList->language] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.year') }}
                                    </th>
                                    <td>
                                        {{ $bookList->year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BookList::STATUS_SELECT[$bookList->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookList.fields.image') }}
                                    </th>
                                    <td>
                                        @if($bookList->image)
                                            <a href="{{ $bookList->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $bookList->image->getUrl('thumb') }}">
                                            </a>
                                        @else
                                            <img width="50" src="{{ asset('image/book.png') }}">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-lists.index') }}">
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