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
        @if($errors->count() > 0)
            <div class="row" style='padding:20px 20px 0 20px;'>
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li class="text-gray-900 dark:text-white" style="list-style: none;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                <h1>{{ trans('global.my_profile') }}</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('users.update.profile') }}">
            @csrf
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                <input class="effect-1 profileInput" type="text" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                <input class="effect-1 profileInput" type="text" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                                <input class="effect-1 profileInput" type="text" name="username" value="{{ $user->username }}">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                                <input class="effect-1 profileInput" type="text" name="phone_number" value="{{ $user->phone_number }}">
                                <br><br>
                                <div style="float: right;">
                                    <button class="btn btn-danger" type="submit">{{ trans('global.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                <h1>{{ trans('global.change_password') }}</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('users.update.password') }}">
            @csrf
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="password">{{ trans('global.new_password') }}</label>
                                <input class="effect-1 profileInput" type="password" name="password">
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                <label class="required" for="password_confirmation">{{ trans('global.repeat_new_password') }}</label>
                                <input class="effect-1 profileInput" type="password" name="password_confirmation">
                                <br><br>
                                <div style="float: right;">
                                    <button class="btn btn-danger" type="submit">{{ trans('global.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection