@extends('layouts.user')
@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="width: 50%">
        <form action="{{ route('users.search.result') }}" method="post">
            @csrf
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1">
                    <input class="effect-1 profileInput p-6" type="search" name="keyword" placeholder="Search...">
                </div>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1">
                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                            <h3>{{ trans('cruds.bookCategory.title_singular') }}</h3>
                            @foreach($categories as $category)
                                <input class="p-6" type="checkbox" name="category[]" id="{{ $category->title }}" value="{{ $category->id }}">
                                <label for="{{ $category->title }}">{{ $category->title }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1">
                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                            <h3>{{ trans('cruds.bookTag.title_singular') }}</h3>
                            @foreach($tags as $tag)
                                <input class="p-6" type="checkbox" name="tag[]" id="{{ $tag->title }}" value="{{ $tag->id }}">
                                <label for="{{ $tag->title }}">{{ $tag->title }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div style="float: right;">
                <button class="btn btn-danger" type="submit">{{ trans('global.submit') }}</button>
            </div>
        </form>
    </div>

@endsection