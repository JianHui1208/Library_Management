@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs selects-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselects-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <div class="container">
                                <div class="row">
                                    @foreach($unique as $u)
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading a" data-l="{{$u->type}}" id="s-part">
                                                    {{ $u->type }}
                                                </div>
                                                <div class="panel-body overflow-auto b" style="height: 200px;">
                                                    @foreach ($permissions as $permission)
                                                        @if ($permission->type == $u->type)
                                                        <div class="form-check c">
                                                            <input type="checkbox" class="check2 {{$permission->type}}" name="permissions[]" id="">
                                                            <label for="">{{ $permission->title }}</label>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>    
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>  
                            @if($errors->has('permissions'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('permissions') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function(){
        $(document).on('click' , '.a' , function(e){
            var v = $(this).attr('data-l');
            if($('.'+v+'').is(':checked')) {
                $('.'+v+'').prop('checked', false);
            } else {
                $('.'+v+'').prop('checked', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.selects-all').click(function() {
            var checked = true;
            $('input[type="checkbox"]').each(function() {
            this.checked = checked;
            });
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('.deselects-all').click(function() {
            var checked = false;
            $('input[type="checkbox"]').each(function() {
            this.checked = checked;
            });
        })
    });
</script>
@endsection