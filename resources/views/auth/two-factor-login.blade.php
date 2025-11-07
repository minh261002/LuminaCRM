@extends('layouts.guest')

@section('title', 'Xác thực 2 lớp')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Xác thực 2 lớp</h2>
            <p class="text-center text-muted mb-4">
                Vui lòng nhập mã xác thực 6 chữ số từ ứng dụng Google Authenticator của bạn
            </p>
            <form action="{{ route('two-factor.verify-login') }}" method="POST" autocomplete="off" id="twoFactorForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Mã xác thực</label>
                    <input type="text" class="form-control text-center" name="code" autocomplete="off" id="code"
                        placeholder="000000" maxlength="6" pattern="[0-9]{6}" required autofocus />
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <small class="form-hint mt-2">
                        Bạn cũng có thể sử dụng mã khôi phục nếu cần
                    </small>
                </div>

                <div class="form-footer">
                    <button type="submit" id="submitBtn" class="btn btn-primary w-100">Xác thực</button>
                    <a href="{{ route('login') }}" class="btn btn-link w-100 mt-2">Quay lại đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Auto-focus on code input
            $('#code').focus();

            // Only allow numbers
            $('#code').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Auto-submit when 6 digits entered
            $('#code').on('input', function() {
                if (this.value.length === 6) {
                    $('#twoFactorForm').submit();
                }
            });

            // Form submission
            let isSubmitting = false;
            $('#twoFactorForm').on('submit', function(e) {
                if (isSubmitting) return;

                const code = $('#code').val();
                if (code.length !== 6) {
                    e.preventDefault();
                    return;
                }

                isSubmitting = true;
                const btn = $('#submitBtn');
                btn.prop('disabled', true)
                    .html(
                        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xác thực...'
                    );
            });
        });
    </script>
@endpush
