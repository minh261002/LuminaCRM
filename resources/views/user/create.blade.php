@extends('layouts.master')

@section('title', 'Thêm nhân viên mới')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý nhân viên'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('users.store') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin nhân viên
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">Họ và tên</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', $model->name ?? null) }}" placeholder="Họ và tên" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="role_id">Vai trò</label>
                                        <select id="role_id" name="role_id" class="form-control select2">
                                            <option value="">Chọn vai trò</option>
                                            @foreach ($roles as $id => $title)
                                                <option value="{{ $id }}"
                                                    {{ old('role_id', $model->role_id ?? null) == $id ? 'selected' : '' }}>
                                                    {{ $title }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email', $model->email ?? null) }}" placeholder="Email" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="phone">Số điện thoại</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            value="{{ old('phone', $model->phone ?? null) }}" placeholder="Số điện thoại" />
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <x-address-select :province-code="old('province_code', $model->province_code ?? null)" :province-text="$model->province?->name ?? null" :ward-code="old('ward_code', $model->ward_code ?? null)"
                                        :ward-text="$model->ward?->name ?? null" :address="old('address', $model->address ?? null)" :required="false" />
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin định danh cá nhân
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="identity_type">Loại giấy tờ</label>
                                        <input type="text" id="identity_type" name="identity_type" class="form-control"
                                            value="{{ old('identity_type', $model->identity_type ?? null) }}"
                                            placeholder="Loại định danh cá nhân" />
                                        @error('identity_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="identity_number">Số định danh cá nhân</label>
                                        <input type="text" id="identity_number" name="identity_number"
                                            class="form-control"
                                            value="{{ old('identity_number', $model->identity_number ?? null) }}"
                                            placeholder="Số định danh cá nhân" />
                                        @error('identity_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('users.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">
                                    Thông tin khác
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="gender">Giới tính</label>
                                    <div>
                                        @foreach ($genders as $value => $label)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="gender_{{ $value }}" value="{{ $value }}">
                                                <label class="form-check-label"
                                                    for="gender_{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <x-image-upload name="avatar" label="Ảnh đại diện" :multiple="false" accept="image/*" />
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endpush
