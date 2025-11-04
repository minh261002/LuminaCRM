@extends('layouts.master')

@section('title', 'Quản lý module hệ thống')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Quản lý module hệ thống'" :breadcrumbs="[['name' => 'Bảng điều khiểm', 'url' => route('dashboard')], ['name' => 'Quản lý module']]">
        </x-page-heading>
    </div>
@endsection
