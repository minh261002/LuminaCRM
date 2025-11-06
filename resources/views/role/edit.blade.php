@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin vai trò')

@push('styles')
@endpush


@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý vai trò ?>'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('roles.update', $role->id) }}" method="post" class="row">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $role->id }}">

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin vai trò
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Tiêu đề
                                        </label>

                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ old('title', $role->title) }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Vai trò (ROLE_NAME)
                                        </label>

                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $role->name) }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="guard_name" class="form-label">
                                            Nhóm quyền (GUARD_NAME)
                                        </label>

                                        <select name="guard_name" id="guard_name" class="form-control">
                                            <option value="web"
                                                {{ old('guard_name', $role->guard_name) == 'web' ? 'selected' : '' }}>
                                                Web</option>
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
                        <x-form-button :title="'Thao tác'" :backUrl="route('roles.index')" :backText="'Quay lại'" :submitText="'Lưu thay đổi'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var permissionIdArray = @json($permissionIdArray);

            // 1) Pre-check permissions passed from server
            if (Array.isArray(permissionIdArray) && permissionIdArray.length) {
                permissionIdArray.forEach(function(permissionId) {
                    $('#permissionCheck' + permissionId).prop('checked', true);
                });
            }

            // 2) Initialize module headers and master on load
            updateAllModuleHeaders();
            updateMasterStatus();

            // 3) Master toggle: select/deselect everything
            $('#checkAll').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.module-check-all, .permission-check').prop('checked', isChecked);
            });

            // 4) Module header toggle: affect only its module
            $('.module-check-all').on('change', function() {
                var moduleId = $(this).data('module-id');
                var isChecked = $(this).is(':checked');
                $('.permission-check[data-module-id="' + moduleId + '"]').prop('checked', isChecked);
                updateMasterStatus();
            });

            // 5) Individual permission toggle: update its module header and master
            $('.permission-check').on('change', function() {
                var moduleId = $(this).data('module-id');
                updateModuleHeader(moduleId);
                updateMasterStatus();
            });

            function updateModuleHeader(moduleId) {
                var $perms = $('.permission-check[data-module-id="' + moduleId + '"]');
                var allCheckedInModule = $perms.length > 0 && $perms.length === $perms.filter(':checked').length;
                $('.module-check-all[data-module-id="' + moduleId + '"]').prop('checked', allCheckedInModule);
            }

            function updateAllModuleHeaders() {
                $('.module-check-all').each(function() {
                    var moduleId = $(this).data('module-id');
                    updateModuleHeader(moduleId);
                });
            }

            function updateMasterStatus() {
                var totalModules = $('.module-check-all').length;
                var checkedModules = $('.module-check-all:checked').length;
                var totalPerms = $('.permission-check').length;
                var checkedPerms = $('.permission-check:checked').length;
                var allChecked = (totalModules === checkedModules) && (totalPerms === checkedPerms) && totalPerms >
                    0;
                $('#checkAll').prop('checked', allChecked);
            }
        });
    </script>
@endpush
