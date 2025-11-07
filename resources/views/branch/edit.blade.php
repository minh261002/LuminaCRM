@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý chi nhánh'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('branches.update') }}" method="post" class="row">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin chi nhánh
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="code" class="form-label">Mã chi nhánh</label>
                                            <input type="text" name="code" id="code" class="form-control"
                                                value="{{ old('code', $model->code ?? 'CN-' . Str::upper(Str::random(6))) }}">
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Tên chi nhánh</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $model->name ?? null) }}">
                                            @error('name')
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('branches.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
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
                                        {{ old('is_active', $model->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        {{ old('is_active', $model->is_active ?? true) ? 'Hoạt động' : 'Không hoạt động' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
