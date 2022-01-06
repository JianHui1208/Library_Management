@extends('layouts.user')
@section('content')
    <div class="tbl-header">
        <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th class="th_bookList">{{ trans('cruds.bookLoan.fields.book') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.book_category') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookList.fields.language') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookLoan.fields.created_at') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookLoan.fields.expired_time') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookLoan.fields.status') }}</th>
                </tr>
            </thead>
        </table>
        <div class="tbl-content">
            <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td class="td_bookList">{{ $loan->book->title }}</td>
                            <td class="td_bookList">{{ $loan->book->book_category->title }}</td>
                            <td class="td_bookList">{{ App\Models\BookList::LANGUAGE_SELECT[$loan->book->language] ?? '' }}</td>
                            <td class="td_bookList">{{ date('d-m-Y', strtotime($loan->created_at)) }}</td>
                            <td class="td_bookList">{{ date('d-m-Y', strtotime($loan->expired_time)) }}</td>
                            <td class="td_bookList">{{ App\Models\BookLoan::STATUS_SELECT[$loan->status] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection