@extends('layouts.master')

@section('title', 'Thêm nhân viên mới')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý nhân viên'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('permissions.store') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin nhân viên
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12 form-group mb-3">
                                    @include('components.pick-address', [
                                        'label' => 'Địa chỉ cụ thể',
                                        'name' => 'address',
                                        'value' => old('address'),
                                    ])
                                    <input type="hidden" name="lat" value="{{ old('lat') }}">
                                    <input type="hidden" name="lng" value="{{ old('lng') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin định danh cá nhân
                                </h3>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-form-button :title="'Thao tác'" :backUrl="route('users.index')" :backText="'Quay lại'" :submitText="'Thêm mới'"
                            :backIcon="'ti ti-arrow-left'" :submitIcon="'ti ti-device-floppy'" :showBack="true" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.modal-pick-address')
    @include('components.google-map-script')
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endpush
