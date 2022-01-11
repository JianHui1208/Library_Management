@extends('layouts.user')
@section('content')
    <div class="tbl-header">
        <table class="table_bookCategory" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th class="th_bookList">No.</th>
                    <th class="th_bookList">{{ trans('cruds.bookCategory.fields.title') }}</th>
                    <th class="th_bookList">{{ trans('cruds.bookCategory.fields.description') }}</th>
                </tr>
            </thead>
        </table>
        <div class="tbl-content">
            <table class="table_bookCategory" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach($bookCategoies as $bookCategory)
                        <tr>
                            <td class="td_bookList">{{ $loop->index + 1 }}</td>
                            <td class="td_bookList"><a class="linkStyle" href="{{ route('users.bookCategory.show', [$bookCategory->id]) }}">{{ $bookCategory->title }}</a></td>
                            <td class="td_bookList">{{ $bookCategory->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection