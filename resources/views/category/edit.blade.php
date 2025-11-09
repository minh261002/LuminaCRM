@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý danh mục sản phẩm'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('categories.update') }}" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin danh mục sản phẩm
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Tên danh mục
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $model->name) }}" placeholder="Nhập tên danh mục sản phẩm"
                                            required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="parent_id" class="form-label">
                                            Danh mục cha
                                        </label>

                                        <select class="form-select select2" name="parent_id" id="parent_id">
                                            <option value="">Chọn danh mục cha</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $model->parent_id ? 'selected' : '' }}>
                                                    {{ generate_text_depth_tree($category->depth) }}
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">
                                                Mô tả
                                            </label>
                                            <textarea name="description" id="description" rows="2" class="form-control"
                                                placeholder="Nhập mô tả danh mục sản phẩm">{{ old('description', $model->description) }}</textarea>
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('categories.index')" :backText="'Quay lại'" :submitText="'Lưu thay đổi'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin khác
                                </h3>
                            </div>

                            <div class="card-body">
                                <x-image-upload name="image" label="Ảnh" :initial="$model->image
                                    ? [
                                        'url' => Storage::url($model->image),
                                        'path' => $model->image,
                                    ]
                                    : null" :multiple="false"
                                    accept="image/*" />
                            </div>
                        </div>


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
