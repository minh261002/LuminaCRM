<div class="w-100 d-flex justify-content-center">
    <label class="form-check form-switch d-flex gap-2">
        <input class="form-check-input toggle-branch-active" type="checkbox" data-id="{{ $branch->id }}"
            {{ $branch->is_active ? 'checked' : '' }}>
        <span
            class="form-check-label label-branch-active">{{ $branch->is_active ? 'Hoạt động' : 'Không hoạt động' }}</span>
    </label>
</div>
