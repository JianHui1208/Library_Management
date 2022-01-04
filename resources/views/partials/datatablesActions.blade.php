@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan

@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan

@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="confirmAlert()" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan

@if(isset($actionGate))
    @can($actionGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.actions') }}" method="POST" onsubmit="confirmAlert()" style="display: inline-block;">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <input type="submit" class="btn btn-xs btn-success" value="{{ trans('global.active') }}">
        </form>
    @endcan
@endif

<script>
    function confirmAlert() {
        confirm("{{ trans('global.areYouSure') }}");
    }
</script>