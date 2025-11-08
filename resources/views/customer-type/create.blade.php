@extends('layouts.master')

@section('title', 'Quản lý phân khúc khách hàng')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý phân khúc khách hàng'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('customer-types.store') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin phân khúc khách hàng
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="code" class="form-label">Mã phân khúc khách hàng</label>
                                            <input type="text" name="code" id="code" class="form-control"
                                                value="{{ old('code') }}">
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Tên phân khúc khách hàng</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="discount_percentage" class="form-label">Chiết khấu (%)</label>
                                            <input type="text" name="discount_percentage" id="discount_percentage"
                                                class="form-control" value="{{ old('discount_percentage') }}">
                                            @error('discount_percentage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="credit_days" class="form-label">Số ngày tín dụng</label>
                                            <input type="text" name="credit_days" id="credit_days" class="form-control"
                                                value="{{ old('credit_days') }}">
                                            @error('credit_days')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="priority_level" class="form-label">Cấp độ ưu tiên</label>
                                            <input type="text" name="priority_level" id="priority_level"
                                                class="form-control" value="{{ old('priority_level') }}">
                                            @error('priority_level')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('customer-types.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
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
