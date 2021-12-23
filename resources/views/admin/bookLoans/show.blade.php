@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bookLoan.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-loans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bookLoan->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $bookLoan->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.book') }}
                                    </th>
                                    <td>
                                        {{ $bookLoan->book->uid ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.expired_time') }}
                                    </th>
                                    <td>
                                        {{ $bookLoan->expired_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BookLoan::STATUS_SELECT[$bookLoan->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookLoan.fields.expired_pay') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $bookLoan->expired_pay ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.book-loans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection