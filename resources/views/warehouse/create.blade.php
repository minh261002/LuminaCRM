@extends('layouts.master')

@section('title', 'Quản lý kho hàng')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý kho hàng'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('warehouses.store') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin kho hàng
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="code" class="form-label">Mã kho hàng</label>
                                            <input type="text" name="code" id="code" class="form-control"
                                                value="{{ old('code', 'WH-' . Str::upper(Str::random(6))) }}">
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Tên kho hàng</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Thuộc chi nhánh</label>
                                            <select name="branch_id" id="branch_id" class="form-select select2">
                                                <option value="">-- Chọn chi nhánh --</option>
                                                @foreach ($branches as $branch)
                                                    <option
                                                        value="{{ $branch->id }}"{{ old('branch_id') == $branch->id ? ' selected' : '' }}>
                                                        {{ $branch->code }} - {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <x-address-select :province-code="old('province_code', $model->province_code ?? null)" :province-text="$model->province?->name ?? null" :ward-code="old('ward_code', $model->ward_code ?? null)"
                                        :ward-text="$model->ward?->name ?? null" :address="old('address', $model->address ?? null)" :required="false" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('warehouses.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Trạng thái
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Kích hoạt</label>
                                </div>
                            </div>
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
