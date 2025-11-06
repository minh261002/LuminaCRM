<div class="w-100 d-flex justify-content-center">
    <label class="form-check form-switch d-flex gap-2">
        <input class="form-check-input toggle-user-active" type="checkbox" data-id="{{ $user->id }}"
            {{ $user->is_active ? 'checked' : '' }}>
        <span class="form-check-label label-user-active">{{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}</span>
    </label>
</div>
