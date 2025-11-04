@extends('layouts.guest')

@section('title', 'Quên mật khẩu')

@section('content')
    <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
        <div class="mb-4 p-0 text-center">
            <a href="#" class="auth-logo">
                <img src="assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
            </a>
        </div>

        <div class="auth-title-section mb-3 text-center">
            <h3 class="text-dark fs-20 fw-medium mb-2">Quên mật khẩu?</h3>
            <p class="text-dark text-capitalize fs-14 mb-0">
                Vui lòng nhập email của bạn. Chúng tôi sẽ gửi liên kết đặt lại mật khẩu đến email của bạn.
            </p>
        </div>

        <div class="pt-0">
            <form id="sendMailForm" action="{{ route('password.email') }}" class="my-4" method="POST" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                        autocomplete="email" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" id="loginBtn">
                                Xác thực Email
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <a href="{{ route('login') }}" class="text-center">
                Quay lại đăng nhập
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isSubmitting = false;

        $('#sendMailForm').on('submit', function(e) {
            if (isSubmitting) return;
            e.preventDefault();

            isSubmitting = true;

            const btn = $('#loginBtn');
            btn.prop('disabled', true)
                .html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>'
                );

            setTimeout(() => {
                $('#sendMailForm').off('submit');
                this.submit();
            }, 500);
        });
    </script>
@endpush
