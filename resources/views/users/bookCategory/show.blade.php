@extends('layouts.user')
@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if(session('message'))
            <div class="row" style='padding:20px 20px 0 20px;'>
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        <ul class="list-unstyled">
                            <li class="text-gray-900 dark:text-white" style="list-style: none;">{{ session('message') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if(session('errors'))
            <div class="row" style='padding:20px 20px 0 20px;'>
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            <li class="text-gray-900 dark:text-white" style="list-style: none;">{{ session('errors') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid md:grid-cols-2 ">
                <div class="p-6">
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <h1>{{ trans('cruds.bookList.fields.title') }}: {{ $bookCategory->title }}</h1>
                            <h3>{{ trans('cruds.bookList.fields.description') }}: {{ $bookCategory->description }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tbl-header">
                <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th class="th_bookList">No.</th>
                            <th class="th_bookList">{{ trans('cruds.bookList.fields.title') }}</th>
                            <th class="th_bookList">{{ trans('cruds.bookList.fields.image') }}</th>
                            <th class="th_bookList">{{ trans('cruds.bookList.fields.language') }}</th>
                            <th class="th_bookList">{{ trans('cruds.bookList.fields.year') }}</th>
                        </tr>
                    </thead>
                </table>
                <div class="tbl-content">
                    <table class="table_bookList" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            @foreach($bookLists as $bookList)
                                <tr>
                                    <td class="td_bookList">{{ $loop->index + 1 }}</td>
                                    <td class="td_bookList"><a class="linkStyle" href="{{ route('users.bookList.show', [$bookList->uid]) }}">{{ $bookList->title }}</a></td>
                                    <td class="td_bookList">
                                        @if($bookList->image)
                                            <a href="{{ $bookList->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $bookList->image->getUrl('thumb') }}">
                                            </a>
                                        @else
                                            <img width="50" src="{{ asset('image/book.png') }}">
                                        @endif
                                    </td>
                                    <td class="td_bookList">{{ App\Models\BookList::LANGUAGE_SELECT[$bookList->language] ?? '' }}</td>
                                    <td class="td_bookList">{{ $bookList->year }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection