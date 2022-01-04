@extends('layouts.user')
@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid md:grid-cols-2 ">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold items-center">
                            @if($bookLists->image)
                                <a href="{{ $bookLists->image->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $bookLists->image->getUrl('thumb') }}">
                                </a>
                            @else
                                <img src="{{ asset('image/book.png') }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <h1>{{ trans('cruds.bookList.fields.title') }}: {{ $bookLists->title }}</h1>
                            <h3>{{ trans('cruds.bookList.fields.description') }}: {{ $bookLists->description }}</h3>
                            {{ trans('cruds.bookList.fields.book_category') }}: {{ $bookLists->book_category->title }} <br>
                            {{ trans('cruds.bookList.fields.book_tag') }}: 
                                        @foreach($bookLists->book_tags as $key => $book_tag)
                                            <span class="label label-info">{{ $book_tag->title }}</span>
                                        @endforeach
                                        <br>
                            {{ trans('cruds.bookList.fields.language') }}: {{ App\Models\BookList::LANGUAGE_SELECT[$bookLists->language] ?? '' }}<br>
                            {{ trans('cruds.bookList.fields.year') }}: {{ $bookLists->year }}<br>
                            {{ trans('cruds.bookList.fields.status') }}: {{ App\Models\BookList::STATUS_SELECT[$bookLists->status] ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection