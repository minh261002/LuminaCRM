@extends('layouts.master')

@section('title', 'Quản lý module hệ thống')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý module hệ thống'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('roles.store') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin module
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Tiêu đề
                                        </label>

                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ old('title') }}">

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Vai trò (ROLE_NAME)
                                        </label>

                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="guard_name" class="form-label">
                                            Nhóm quyền (GUARD_NAME)
                                        </label>

                                        <select name="guard_name" id="guard_name" class="form-control">
                                            <option value="admin">Admin</option>
                                        </select>

                                        @error('guard_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="permissions" class="form-label">Phân quyền</label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">
                                                Chọn tất cả quyền
                                            </label>
                                        </div>

                                        <div class="row">
                                            @foreach ($modules as $module)
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <div class="card-header pb-0">
                                                            <div class="form-check">
                                                                <input class="form-check-input module-check-all"
                                                                    type="checkbox"
                                                                    id="moduleCheckAll{{ $module['module_name'] }}"
                                                                    data-module-id="{{ $module['module_name'] }}">
                                                                <label class="form-check-label"
                                                                    for="moduleCheckAll{{ $module['module_name'] }}">
                                                                    {{ $module['module_name'] }}
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            @if (isset($module['list']) && is_iterable($module['list']))
                                                                @foreach ($module['list'] as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-check"
                                                                            type="checkbox"
                                                                            id="permissionCheck{{ $permission->id }}"
                                                                            data-module-id="{{ $module['module_name'] }}"
                                                                            name="permissions[]"
                                                                            value="{{ $permission->id }}">
                                                                        <label class="form-check-label"
                                                                            for="permissionCheck{{ $permission->id }}">
                                                                            {{ $permission->title }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <p>No permissions available for this module.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('module.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
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
        $(document).ready(function() {
            $('#checkAll').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.module-check-all, .permission-check').prop('checked', isChecked);
            });

            $('.module-check-all').on('change', function() {
                var moduleId = $(this).data('module-id');
                var isChecked = $(this).is(':checked');
                $('.permission-check[data-module-id="' + moduleId + '"]').prop('checked', isChecked);

                updateCheckAllStatus();
            });

            $('.permission-check').on('change', function() {
                var moduleId = $(this).data('module-id');
                var allCheckedInModule = $('.permission-check[data-module-id="' + moduleId + '"]')
                    .length ===
                    $('.permission-check[data-module-id="' + moduleId + '"]:checked').length;

                $('#moduleCheckAll' + moduleId).prop('checked', allCheckedInModule);

                updateCheckAllStatus();
            });

            function updateCheckAllStatus() {
                var allModulesChecked = $('.module-check-all').length === $('.module-check-all:checked').length;
                var allPermissionsChecked = $('.permission-check').length === $('.permission-check:checked').length;

                $('#checkAll').prop('checked', allModulesChecked && allPermissionsChecked);
            }
        });
    </script>
@endpush
