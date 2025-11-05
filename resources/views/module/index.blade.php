@php
    $breadcrumbs = [['name' => 'Bảng điều khiểm', 'url' => route('dashboard')], ['name' => 'Quản lý module']];

    $columns = [
        ['label' => 'Tên module', 'data' => 'name'],
        ['label' => 'Mô tả', 'data' => 'description'],
        ['label' => 'Trạng thái', 'data' => 'status'],
        ['label' => 'Hành động', 'data' => 'action', 'width' => '100px'],
    ];
@endphp

@extends('layouts.master')

@section('title', 'Quản lý module hệ thống')

@section('content')
    <div class="">
        <x-page-heading :title="'Quản lý module hệ thống'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <x-card-table :title="'Danh sách module'" :headers="$columns">
                    <x-slot:actions>
                        <a href="{{ route(name: 'module.create') }}"
                            class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                            <i data-feather="plus" class="icon"></i>
                            Thêm mới
                        </a>
                    </x-slot:actions>
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->description }}</td>
                            <td>
                                @if ($module->status == 'in_progress')
                                    <span class="badge bg-warning">In Progress</span>
                                @else
                                    <span class="badge bg-success">Completed</span>
                                @endif
                            </td>
                            <td class="d-flex align-items-center gap-2">
                                <a href="{{ route('module.edit', ['id' => $module->id]) }}"
                                    class="btn btn-primary btn-sm d-flex align-items-center gap-2">
                                    <i data-feather="edit" width="20" height="20"></i>
                                </a>
                                <a href="{{ route('module.delete', ['id' => $module->id]) }}"
                                    class="btn btn-danger btn-sm d-flex align-items-center gap-2">
                                    <i data-feather="trash" width="20" height="20"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </x-card-table>
            </div>
        </div>
    </div>
@endsection
