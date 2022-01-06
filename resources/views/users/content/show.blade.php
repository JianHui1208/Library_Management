@extends('layouts.user')
@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="width: 50%">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1">
                <div class="slideshow-container">
                    <div class="fade">
                        <img class="img-content p-6" src="{{ $contents->image->getUrl() }}" style="width:100%">
                        <h3 class="p-6" style="color: white">{{ $contents->title }}</h3>
                        <p class="p-6" style="color: white">{{ $contents->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection