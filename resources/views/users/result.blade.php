@extends('layouts.user')
@section('content')
    <br><br>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @forelse ($bookLists as $bookList)
            <div class="mt-8-result bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid md:grid-cols-2 ">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold items-center">
                                @if($bookList->image)
                                    <a href="{{ $bookList->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bookList->image->getUrl('thumb') }}">
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
                                <h1>{{ trans('cruds.bookList.fields.title') }}: {{ $bookList->title }}</h1>
                                <h3>{{ trans('cruds.bookList.fields.description') }}: {{ $bookList->description }}</h3>
                                <h3>{{ trans('cruds.bookList.fields.book_category') }}: {{ $bookList->book_category->title }}</h3>
                                {{ trans('cruds.bookList.fields.book_tag') }}: 
                                <div class='input-select-tag'>
                                    <div class='selected-tags'>
                                        @foreach($bookList->book_tags as $key => $book_tag)
                                            <span class='alert button alert-info'>{{ $book_tag->title }}</span>  
                                        @endforeach
                                    </div>
                                </div>
                                {{ trans('cruds.bookList.fields.language') }}: {{ App\Models\BookList::LANGUAGE_SELECT[$bookList->language] ?? '' }}<br>
                                {{ trans('cruds.bookList.fields.year') }}: {{ $bookList->year }}<br>
                                {{ trans('cruds.bookList.fields.status') }}: {{ App\Models\BookList::STATUS_SELECT[$bookList->status] ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h1 class="text-gray-500">It is Empty Book</h1>
            <button onclick="history.back()" class="btn btn-success" style="float: center;">Go Back</button>
        @endforelse
    </div>

@endsection