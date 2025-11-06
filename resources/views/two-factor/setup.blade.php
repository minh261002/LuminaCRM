@extends('layouts.master')

@section('title', 'Xác thực 2 lớp')

@push('styles')
@endpush

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
                                <h3 class="card-title">Thiết lập xác thực 2 lớp</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">
                                    <strong>Bước 1:</strong> Quét mã QR bằng ứng dụng Google Authenticator trên điện thoại
                                    của bạn
                                </div>

                                <div class="text-center mb-4">
                                    @if ($qrCodeInline)
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div class="border rounded p-3 bg-white d-inline-block">
                                                <img src="{{ $qrCodeInline }}" alt="QR Code" class="img-fluid"
                                                    style="max-width: 250px; height: auto; display: block;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning mb-3">
                                            <p class="mb-0">Không thể tạo QR code. Vui lòng sử dụng mã thủ công bên dưới.
                                            </p>
                                        </div>
                                    @endif
                                    <p class="text-muted mt-3">
                                        <strong>Hoặc nhập mã thủ công:</strong><br>
                                        <code
                                            class="fs-4 d-inline-block mt-2 p-2 bg-light rounded">{{ $secret }}</code>
                                    </p>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <strong>Bước 2:</strong> Nhập mã xác thực 6 chữ số từ ứng dụng để hoàn tất thiết lập
                                </div>

                                <form action="{{ route('two-factor.verify') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Mã xác thực</label>
                                        <input type="text" class="form-control text-center" name="code"
                                            placeholder="000000" maxlength="6" pattern="[0-9]{6}" required autofocus />
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Xác thực và kích hoạt</button>
                                        <a href="{{ route('two-factor.index') }}" class="btn btn-secondary">Hủy</a>
                                    </div>
                                </form>

                                <hr class="my-4">

                                <div class="mt-4">
                                    <h4 class="mb-3">Hướng dẫn cài đặt</h4>
                                    <ol>
                                        <li>Tải ứng dụng <strong>Google Authenticator</strong> trên điện thoại của bạn:
                                            <ul>
                                                <li><a href="https://apps.apple.com/app/google-authenticator/id388497605"
                                                        target="_blank">iOS (App Store)</a></li>
                                                <li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"
                                                        target="_blank">Android (Google Play)</a></li>
                                            </ul>
                                        </li>
                                        <li>Mở ứng dụng và chọn "Thêm tài khoản"</li>
                                        <li>Quét mã QR ở trên hoặc nhập mã thủ công</li>
                                        <li>Nhập mã 6 chữ số từ ứng dụng vào ô bên trên</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Only allow numbers
            $('input[name="code"]').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endpush
