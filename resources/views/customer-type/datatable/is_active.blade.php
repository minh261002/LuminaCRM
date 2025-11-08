<div class="w-100 d-flex justify-content-center">
    <label class="form-check form-switch d-flex gap-2">
        <input class="form-check-input toggle-customer-type-active" type="checkbox" data-id="{{ $customerType->id }}"
            {{ $customerType->is_active ? 'checked' : '' }}>
        <span
            class="form-check-label label-customer-type-active">{{ $customerType->is_active ? 'Hoạt động' : 'Không hoạt động' }}</span>
    </label>
</div>
