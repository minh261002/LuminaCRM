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
            <form id="loginForm" action="{{ route('authenticate') }}" class="my-4" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="emailaddress" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password">
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
        $('#loginBtn').click(function(e) {
            e.preventDefault();
            const btn = $(this);
            btn.prop('disabled', true);
            btn.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );

            setTimeout(function() {
                $('#loginForm').submit();
            }, 500);
        });
    </script>
@endpush
