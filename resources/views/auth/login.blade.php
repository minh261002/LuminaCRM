@extends('layouts.guest')

@section('title', 'Đăng nhập')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Đăng nhập</h2>
            <form action="{{ route('authenticate') }}" method="POST" autocomplete="off" id="loginForm">
                @csrf

                <input type="hidden" name="redirect_url" value="{{ request()->get('redirect') }}">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" id="email"
                        value="{{ old('email') }}" tabIndex="1"/>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">
                        Mật khẩu
                        <span class="form-label-description">
                            <a href="{{ route('password.forgot') }}">Quên mật khẩu</a>
                        </span>
                    </label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" tabindex="2">
                        <button class="btn" type="button" id="showPassword">
                            <i class="ti ti-eye icon me-0"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-label">Lưu thông tin</span>
                    </label>
                </div>
                <div type="submit" class="form-footer">
                    <button type="submit" id="loginBtn" class="btn btn-primary w-100">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isSubmitting = false;

        $('#loginForm').on('submit', function(e) {
            if (isSubmitting) return;
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

            $(this).html(`<i class="ti ti-eye-off icon me-0"></i>`);
        });
    </script>
@endpush
