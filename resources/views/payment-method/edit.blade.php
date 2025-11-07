@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý phương thức thanh toán'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('payment-methods.update') }}" method="post" class="row">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin phương thức thanh toán
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <x-image-upload name="icon" label="Icon" :initial="$model->icon
                                            ? [
                                                'url' => Storage::url($model->icon),
                                                'path' => $model->icon,
                                            ]
                                            : null" :multiple="false"
                                            accept="image/*" />
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Phương thức thanh toán</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $model->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea name="description" id="description" class="form-control" rows="2">{{ old('description', $model->description) }}</textarea>
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('payment-methods.index')" :backText="'Quay lại'" :submitText="'Lưu thay đổi'"
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
