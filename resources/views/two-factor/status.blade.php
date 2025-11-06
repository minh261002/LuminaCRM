@extends('layouts.master')

@section('title', 'Xác thực 2 lớp')

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

                        <div class="col-12 col-md-9 d-flex flex-column">
                            <div class="card-header">
                                <h3 class="card-title">Xác thực 2 lớp</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">
                                        <i class="ti ti-shield-check"></i> Xác thực 2 lớp đã được kích hoạt
                                    </h4>
                                    <p class="mb-0">
                                        Tài khoản của bạn đã được bảo vệ bằng xác thực 2 lớp. Bạn sẽ cần nhập mã từ ứng dụng
                                        Google Authenticator mỗi khi đăng nhập.
                                    </p>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <a href="{{ route('two-factor.show-recovery') }}" class="btn btn-outline-primary">
                                        <i class="ti ti-key"></i> Xem mã khôi phục
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#disableModal">
                                        <i class="ti ti-shield-off"></i> Tắt xác thực 2 lớp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disable Modal -->
    <div class="modal modal-blur fade" id="disableModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tắt xác thực 2 lớp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('two-factor.disable') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            <strong>Lưu ý:</strong> Tắt xác thực 2 lớp sẽ làm giảm tính bảo mật của tài khoản.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nhập mật khẩu để xác nhận</label>
                            <input type="password" class="form-control" name="password" required
                                autocomplete="current-password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Tắt xác thực 2 lớp</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
