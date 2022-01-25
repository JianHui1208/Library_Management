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
                            <h3>{{ trans('cruds.bookList.fields.book_category') }}: {{ $bookLists->book_category->title }}</h3>
                            {{ trans('cruds.bookList.fields.book_tag') }}: 
                            <div class='input-select-tag'>
                                <div class='selected-tags'>
                                    @foreach($bookLists->book_tags as $key => $book_tag)
                                        <span class='alert button alert-info'>{{ $book_tag->title }}</span>  
                                    @endforeach
                                </div>
                            </div>
                            {{ trans('cruds.bookList.fields.language') }}: {{ App\Models\BookList::LANGUAGE_SELECT[$bookLists->language] ?? '' }}<br>
                            {{ trans('cruds.bookList.fields.year') }}: {{ $bookLists->year }}<br>
                            {{ trans('cruds.bookList.fields.status') }}: {{ App\Models\BookList::STATUS_SELECT[$bookLists->status] ?? '' }}
                        </div>
                        @auth
                            <form action="{{ route('users.bookloan.add') }}" id="myForm" method="post">
                                @csrf
                                <div style="float: right;">
                                    <input type="hidden" name="book_id" value="{{ $bookLists->id }}">
                                    @if($bookLoan == null)
                                        <button class="btn btn-success" value="1" name="type" type="submit">Booking</button>
                                        <button class="btn btn-info" value="3" name="type" type="submit">Borrow</button>
                                    @else
                                        @if($bookLoan->status == 1)
                                            <h1 class="text-gray-600 dark:text-gray-400">Borrowing</h1>
                                        @elseif($bookLoan->status != 5)
                                            <button class="btn btn-success" value="1" name="type" type="submit">Booking</button>
                                            <button class="btn btn-info" value="3" name="type" type="submit">Borrow</button>
                                        @elseif($bookLoan->status == 5)
                                            <button class="btn btn-success" disabled>Already Booking</button>
                                            <button class="btn btn-danger" value="2" name="type" type="submit">Cancel Booking</button>
                                        @endif
                                    @endif
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function submitForm() {
        document.getElementById("myForm").submit();
    }
</script>
@endsection