@extends('layouts.user')
@section('content')
    <div class="tbl-header">
        <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.title') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.book_category') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.language') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.year') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.image') }}</th>
                </tr>
            </thead>
        </table>
        <div class="tbl-content">
            <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach($bookLists as $bookList)
                        <tr>
                            <td class="td_bookList"><a href="{{ route('users.bookList.show', [$bookList->uid]) }}">{{ $bookList->title }}</a></td>
                            <td class="td_bookList">{{ $bookList->book_category->title }}</td>
                            <td class="td_bookList">{{ App\Models\BookList::LANGUAGE_SELECT[$bookList->language] ?? '' }}</td>
                            <td class="td_bookList">{{ $bookList->year }}</td>
                            <td class="td_bookList">
                                @if($bookList->image)
                                    <a href="{{ $bookList->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $bookList->image->getUrl('thumb') }}">
                                    </a>
                                @else
                                    <img width="50" src="{{ asset('image/book.png') }}">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection