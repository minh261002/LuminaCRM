@extends('layouts.guest')

@section('title', 'Đăng nhập')

@section('content')
    <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
        <div class="mb-4 p-0 text-center">
            <a href="#" class="auth-logo">
                <img src="assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
            </a>
        </div>

        <div class="auth-title-section mb-3 text-center">
            <h3 class="text-dark fs-20 fw-medium mb-2">Xin Chào!</h3>
            <p class="text-dark text-capitalize fs-14 mb-0">
                Đăng nhập để tiếp tục.
            </p>
        </div>

        <div class="pt-0">
            <form id="loginForm" action="{{ route('authenticate') }}" class="my-4" method="POST" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                        autocomplete="email" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <a href="{{ route('password.forgot') }}" class="text-muted fs-12">Quên mật khẩu?</a>
                    </div>
                    <div class="input-group">
                        <input id="password" class="form-control" type="password" name="password"
                            autocomplete="current-password" required>
                        <button class="input-group-text" type="button" id="showPassword" aria-label="Hiển thị mật khẩu">
                            <i data-feather="eye" class="noti-icon cursor-pointer"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" id="loginBtn">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isSubmitting = false;

        $('#loginForm').on('submit', function(e) {
            if (isSubmitting) return; // chặn double
            e.preventDefault();

            isSubmitting = true;

            const btn = $('#loginBtn');
            btn.prop('disabled', true)
                .html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>'
                );

            setTimeout(() => {
                $('#loginForm').off('submit');
                this.submit();
            }, 500);
        });

        $('#showPassword').on('click', function() {
            const input = $('#password');
            const isHidden = input.attr('type') === 'password';

            input.attr('type', isHidden ? 'text' : 'password');

            $(this).html(`<i data-feather="${isHidden ? 'eye-off' : 'eye'}" class="noti-icon cursor-pointer"></i>`);
            if (window.feather && typeof feather.replace === 'function') {
                feather.replace();
            }
        });
    </script>
@endpush
