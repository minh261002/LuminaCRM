<div class="w-100 d-flex justify-content-center">
    <label class="form-check form-switch d-flex gap-2">
        <input class="form-check-input toggle-payment-method-active" type="checkbox" data-id="{{ $paymentMethod->id }}"
            {{ $paymentMethod->is_active ? 'checked' : '' }}>
        <span
            class="form-check-label label-payment-method-active">{{ $paymentMethod->is_active ? 'Hoạt động' : 'Không hoạt động' }}</span>
    </label>
</div>
