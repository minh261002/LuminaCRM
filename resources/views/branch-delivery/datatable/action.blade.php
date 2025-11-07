<a href="{{ route('branch-deliveries.edit', $id) }}" class="btn btn-sm btn-primary">
    <i class="ti ti-pencil fs-1"></i>
</a>

<x-delete-button :id="$id" :deleteUrl="route('branch-deliveries.delete', $id)" />
