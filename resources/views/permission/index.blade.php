@extends('layouts.master')

@section('title', 'Quản lý quyền')

@push('styles')
@endpush

@section('content')
    <div class="">
        <x-page-heading :title="'Quản lý quyền'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div>
                        <div class="card-header">
                            <h3 class="card-title">
                                Danh sách quyền
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus fs-4 me-1"></i>
                                    Thêm mới
                                </a>
                            </div>
                        </div>

                        <div class="text-danger" style="padding: 20px 20px 0 20px;">
                            <p>
                                <strong>Lưu ý:</strong>
                                <span>
                                    Đây là phần chỉ dành riêng cho Nhà phát triển. Các Dev sẽ sử dụng slug ( permission_name
                                    )
                                    để lập trình, đóng gói các chức năng để có thể phân quyền. Vui lòng không xóa hoặc điều
                                    chỉnh các Quyền nếu bạn không phải Dev hoặc không biết về nó để tránh bị Lỗi toàn bộ hệ
                                    thống.
                                </span>
                            </p>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            @include('layouts.partials.toggle-column')
                            {{ $dataTable->table(['class' => 'table table-bordered table-striped'], true) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
    <script src="/assets/js/buttons.server-side.js"></script>
@endpush

@push('scripts')
    {{ $dataTable->scripts() }}

    @include('layouts.partials.table', [
        'id_table' => $dataTable->getTableAttribute('id'),
    ])
@endpush
