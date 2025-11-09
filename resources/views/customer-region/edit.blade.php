@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý phân khúc khách hàng'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('customer-regions.update') }}" method="post" class="row">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $model->id }}">
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
                                            <label for="code" class="form-label">Mã vùng</label>
                                            <input type="text" name="code" id="code" class="form-control"
                                                value="{{ old('code', $model->code) }}">
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Tên vùng</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $model->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="parent_region_id" class="form-label">Thuộc vùng</label>
                                            <select name="parent_region_id" id="parent_region_id"
                                                class="form-control select2">
                                                <option value="">-- Chọn vùng --</option>
                                                @foreach ($regions as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ old('parent_region_id', $model->parent_region_id) == $id ? 'selected' : '' }}>
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('parent_region_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea name="description" id="description" class="form-control">{{ old('description', $model->description) }}</textarea>
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('customer-types.index')" :backText="'Quay lại'" :submitText="'Lưu thay đổi'"
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
