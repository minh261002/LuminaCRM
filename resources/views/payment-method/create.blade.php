@extends('layouts.master')

@section('title', 'Quản lý phương thức thanh toán')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý phương thức thanh toán'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('payment-methods.store') }}" method="post" class="row" enctype="multipart/form-data">
                    @csrf
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
                                        <x-image-upload :label="'Icon'" :name="'icon'" :value="old('icon')" />
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Phương thức thanh toán</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea name="description" id="description" class="form-control" rows="2">{{ old('description') }}</textarea>
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('payment-methods.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
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
