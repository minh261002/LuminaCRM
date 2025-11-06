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
                                <div class="alert alert-warning mb-4" role="alert">
                                    <h4 class="alert-heading mb-2">
                                        <i class="ti ti-alert-triangle me-2"></i>Lưu trữ các mã này ở nơi an toàn!
                                    </h4>
                                    <p class="mb-0">
                                        Các mã khôi phục này có thể được sử dụng để đăng nhập vào tài khoản của bạn nếu bạn
                                        mất quyền truy cập vào thiết bị xác thực. Mỗi mã chỉ có thể sử dụng một lần.
                                    </p>
                                </div>

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

                                <div class="alert alert-info mb-0" role="alert">
                                    <i class="ti ti-info-circle me-2"></i>
                                    <strong>Lưu ý:</strong> Bạn sẽ chỉ thấy các mã này một lần. Hãy lưu chúng ở nơi an toàn.
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('two-factor.index') }}" class="btn btn-primary">Đã lưu, tiếp tục</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
