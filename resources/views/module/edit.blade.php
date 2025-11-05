@extends('layouts.master')

@section('title', 'Quản lý module hệ thống')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý module hệ thống'" :breadcrumbs="$breadcrumbs">
        </x-page-heading>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('module.update', $module->id) }}" method="post" class="row">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $module->id }}">

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin module
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Tên module</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $module->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="status" class="form-label">Trạng thái</label>
                                            <select name="status" id="status" class="form-select">
                                                @foreach ($status as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $module->status->value == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control">{{ $module->description }}</textarea>
                                        @error('description')
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
