@extends('layouts.master')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Cài đặt tài khoản'" :breadcrumbs="$breadcrumbs" />

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            @include('profile.partials.sidebar')
                        </div>
                        <form action="{{ route('profile.update-password') }}" method="post"
                            class="col-12 col-md-9 d-flex flex-column" id="changePasswordForm">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h3 class="card-title">Đổi mật khẩu</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="current_password">Mật khẩu hiện tại</label>
                                    <div class="input-group">
                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control" tabindex="1" autocomplete="off">
                                        <button class="btn" type="button" id="showPassword">
                                            <i class="ti ti-eye icon me-0"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control"
                                            tabindex="2" autocomplete="off">
                                        <button class="btn" type="button" id="showPassword">
                                            <i class="ti ti-eye icon me-0"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" tabindex="3" autocomplete="off">
                                        <button class="btn" type="button" id="showPasswordConfirmation">
                                            <i class="ti ti-eye icon me-0"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-2" tabindex="4"
                                        id="changePasswordBtn"> Lưu thay đổi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isSubmitting = false;

        $('#changePasswordForm').on('submit', function(e) {
            if (isSubmitting) return;
            e.preventDefault();

            isSubmitting = true;

            const btn = $('#changePasswordBtn');
            btn.prop('disabled', true)
                .html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>'
                );

            setTimeout(() => {
                $('#changePasswordForm').off('submit');
                this.submit();
            }, 500);
        });

        $('#showPassword').on('click', function() {
            const input = $('#password');
            const isHidden = input.attr('type') === 'password';

            input.attr('type', isHidden ? 'text' : 'password');

            $(this).html(`<i class="ti ti-eye-off icon me-0"></i>`);
        });
        $('#showPasswordConfirmation').on('click', function() {
            const input = $('#password_confirmation');
            const isHidden = input.attr('type') === 'password';

            input.attr('type', isHidden ? 'text' : 'password');

            $(this).html(`<i class="ti ti-eye-off icon me-0"></i>`);
        });
        $('#showCurrentPassword').on('click', function() {
            const input = $('#current_password');
            const isHidden = input.attr('type') === 'password';

            input.attr('type', isHidden ? 'text' : 'password');

            $(this).html(`<i class="ti ti-eye-off icon me-0"></i>`);
        });
    </script>
@endpush
