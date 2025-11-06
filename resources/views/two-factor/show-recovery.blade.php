@extends('layouts.master')

@section('title', 'Mã khôi phục')

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
                                <h3 class="card-title">Mã khôi phục</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-4" role="alert">
                                    <i class="ti ti-info-circle me-2"></i>
                                    <p class="mb-0">
                                        Các mã khôi phục này có thể được sử dụng để đăng nhập vào tài khoản của bạn nếu bạn
                                        mất quyền truy cập vào thiết bị xác thực. Mỗi mã chỉ có thể sử dụng một lần.
                                    </p>
                                </div>

                                @if (count($recoveryCodes) > 0)
                                    <div class="bg-dark text-white p-4 rounded-3 mb-4"
                                        style="background-color: #1e1e2e !important;">
                                        <div class="row g-3">
                                            @foreach ($recoveryCodes as $code)
                                                <div class="col-6 col-md-3">
                                                    <div class="bg-white rounded-3 p-3 text-center shadow-sm">
                                                        <code class="text-dark fs-5 fw-bold"
                                                            style="font-family: 'Courier New', monospace; letter-spacing: 3px; color: #1e1e2e !important;">{{ $code }}</code>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning mb-4" role="alert">
                                        <i class="ti ti-alert-triangle me-2"></i>
                                        Bạn không còn mã khôi phục nào. Hãy tạo mã mới.
                                    </div>
                                @endif

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#regenerateModal">
                                        <i class="ti ti-refresh me-1"></i> Tạo mã mới
                                    </button>
                                    <a href="{{ route('two-factor.index') }}" class="btn btn-secondary">
                                        <i class="ti ti-arrow-left me-1"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Regenerate Modal -->
    <div class="modal modal-blur fade" id="regenerateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo mã khôi phục mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('two-factor.regenerate-recovery') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            <strong>Lưu ý:</strong> Tạo mã mới sẽ vô hiệu hóa tất cả các mã khôi phục cũ.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nhập mật khẩu để xác nhận</label>
                            <input type="password" class="form-control" name="password" required
                                autocomplete="current-password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Tạo mã mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
