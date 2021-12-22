@extends('layouts.admin')
@section('content')
<div class="content">
    @can('system_setting_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.system-settings.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.systemSetting.title_singular') }}
                </a>
            </div>
        </div>
    @endcan

    @foreach ($type as $item)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $item->type }}
            </div>

            <div class="panel-body">
                <form action="{{ route("admin.system-settings.custom_edit") }}" class="custom_edit_form">
                    @csrf
                    @foreach ($SystemSetting as $SystemSetting_item)
                        @if ($item->type == $SystemSetting_item->type)
                            <div class="form-group">
                                <label for="{{ $SystemSetting_item->id }}">{{ $SystemSetting_item->title }}</label>
                                @if($SystemSetting_item->layout == 1)
                                    <input class="form-control" type="text" name="{{ $SystemSetting_item->id }}"
                                        id="{{ $SystemSetting_item->id }}" value="{{ $SystemSetting_item->value }}"
                                        placeholder="{{ $SystemSetting_item->title }}"  required>
                                @elseif($SystemSetting_item->layout == 2)
                                    <input type="hidden" name="{{ $SystemSetting_item->id }}" id="{{ $SystemSetting_item->id }}" value="0">
                                    <input class="form-check-input" type="checkbox" name="{{ $SystemSetting_item->id }}" id="{{ $SystemSetting_item->id }}" value="1" {{ $SystemSetting_item->value == 1 ? 'checked' : '' }}>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-danger btn-submit">{{ trans('global.save') }}</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
@parent

<script>
    $(function() {
        $(".custom_edit_form").on('submit', function(e) {

            e.preventDefault();

            var form = $(this);

            var formData = form.serializeArray();
            var type = "POST";

            var btn_submit = form.find('.btn-submit');
            var value = btn_submit.text();

            btn_submit.html("{{ trans('global.loading') }}");

            $.ajax({
                type: type,
                url: form.attr('action'),
                data: formData,
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        alert(data.ret_msg);
                    }
                },
                complete: function(xhr, textStatus) {
                    btn_submit.html(value);
                }
            });
        });
    })
</script>
@endsection
