<div class="w-100 d-flex justify-content-center">
    <label class="form-check form-switch d-flex gap-2">
        <input class="form-check-input toggle-warehouse-active" type="checkbox" data-id="{{ $warehouse->id }}"
            {{ $warehouse->is_active ? 'checked' : '' }}>
        <span
            class="form-check-label label-warehouse-active">{{ $warehouse->is_active ? 'Hoạt động' : 'Không hoạt động' }}</span>
    </label>
</div>
