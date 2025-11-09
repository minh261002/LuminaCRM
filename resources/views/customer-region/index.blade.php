@extends('layouts.master')

@section('title', 'Quản lý phân phân vùng địa lý')

@push('styles')
@endpush

@section('content')
    <div class="">
        <x-page-heading :title="'Quản lý phân phân vùng địa lý'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div>
                        <div class="card-header">
                            <h3 class="card-title">
                                Danh sách phân phân vùng địa lý
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('customer-regions.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus fs-4 me-1"></i>
                                    Thêm mới
                                </a>
                            </div>
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

    <script>
        $(document).ready(function() {
            $(document).on('change', '.toggle-customer-region-active', function() {
                var isActive = $(this).is(':checked');
                var id = $(this).data('id');
                var checkbox = $(this);
                var label = checkbox.siblings('.label-customer-region-active');

                if (!id) {
                    console.error('Customer Region ID not found');
                    checkbox.prop('checked', !isActive);
                    return;
                }

                checkbox.prop('disabled', true);

                $.ajax({
                    url: '{{ route('customer-regions.active', ':id') }}'.replace(':id', id),
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            label.text(isActive ? 'Hoạt động' : 'Không hoạt động');
                        } else {
                            checkbox.prop('checked', !isActive);
                            alert('Có lỗi xảy ra khi cập nhật trạng thái');
                        }
                    },
                    error: function(xhr) {
                        checkbox.prop('checked', !isActive);
                        var errorMessage = xhr.responseJSON?.message ||
                            'Có lỗi xảy ra khi cập nhật trạng thái';
                        alert(errorMessage);
                    },
                    complete: function() {
                        checkbox.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
