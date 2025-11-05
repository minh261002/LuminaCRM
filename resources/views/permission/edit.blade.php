@extends('layouts.master')

@section('title', 'Quản lý quyền')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý quyền'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('permissions.update', $permission->id) }}" method="post" class="row">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $permission->id }}">

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin quyền
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Tiêu đề
                                        </label>

                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ $permission->title }}">

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Nhóm quyền (GUARD_NAME)
                                        </label>

                                        <select name="guard_name" id="guard_name" class="form-control">
                                            <option value="admin">Admin</option>
                                        </select>

                                        @error('guard_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="name" class="form-label">
                                            Quyền (PERMISSION_NAME)
                                        </label>

                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $permission->name }}">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="module_id" class="form-label">
                                            Thuộc module
                                        </label>

                                        <select name="module_id" id="module_id" class="form-control select2">
                                            <option value="">Chọn module</option>
                                            @foreach ($modules as $module)
                                                <option value="{{ $module->id }}"
                                                    {{ $permission->module_id == $module->id ? 'selected' : '' }}>
                                                    {{ $module->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('module_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('module.index')" :backText="'Quay lại'" :submitText="'Lưu thay đổi'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />
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
