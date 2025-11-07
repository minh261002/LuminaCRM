@extends('layouts.guest')

@section('title', 'Quên mật khẩu')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Quên mật khẩu</h2>
            <p class="text-center mb-4">Vui lòng nhập email của bạn. Chúng tôi sẽ gửi liên kết đặt lại mật khẩu đến email của
                bạn.</p>
            <form action="{{ route('password.email') }}" method="POST" autocomplete="off" id="sendMailForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" id="email"
                        value="{{ old('email') }}" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div type="submit" class="form-footer">
                    <button type="submit" id="sendMailBtn" class="btn btn-primary w-100">Xác thực email</button>
                </div>
            </form>
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

            const btn = $('#sendMailBtn');
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
