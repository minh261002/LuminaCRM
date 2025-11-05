@extends('layouts.guest')

@section('title', 'Đặt lại mật khẩu')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Đặt lại mật khẩu</h2>

            <form action="{{ route('password.update') }}" method="POST" autocomplete="off" id="resetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ request()->get('email') }}"
                        readonly />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control">
                        <button class="btn" type="button" id="showPassword">
                            <i class="ti ti-eye icon me-0"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">Nhập lại mật khẩu</label>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            autocomplete="new-password">
                        <button class="btn" type="button" id="showPasswordConfirmation">
                            <i class="ti ti-eye icon me-0"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" id="loginBtn" class="btn btn-primary w-100">Đặt lại mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isSubmitting = false;

        $('#resetPasswordForm').on('submit', function(e) {
            if (isSubmitting) return;
            e.preventDefault();

            const pass = $('#password').val();
            const confirm = $('#password_confirmation').val();
            if (pass !== confirm) {
                alert('Mật khẩu xác nhận không khớp!');
                return;
            }

            isSubmitting = true;
            const btn = $('#loginBtn');
            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xử lý...'
            );

            setTimeout(() => {
                // ĐÚNG ID form
                $('#resetPasswordForm').off('submit');
                e.currentTarget.submit();
            }, 500);
        });

        // Toggle hiển/ẩn mật khẩu dùng Tabler Icons
        function togglePassword(inputSelector, triggerSelector) {
            const input = $(inputSelector);
            const icon = $(triggerSelector).find('i'); // <i class="ti ...">

            const isHidden = input.attr('type') === 'password';
            input.attr('type', isHidden ? 'text' : 'password');

            // Đổi icon: eye <-> eye-off
            // Tabler Icons dùng class ti ti-eye / ti ti-eye-off
            if (icon.hasClass('ti-eye')) {
                icon.removeClass('ti-eye').addClass('ti-eye-off');
            } else {
                icon.removeClass('ti-eye-off').addClass('ti-eye');
            }
        }

        $('#showPassword').on('click', function() {
            togglePassword('#password', '#showPassword');
        });

        $('#showPasswordConfirmation').on('click', function() {
            togglePassword('#password_confirmation', '#showPasswordConfirmation');
        });
    </script>
@endpush
