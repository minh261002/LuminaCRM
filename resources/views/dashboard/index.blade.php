@extends('layouts.master')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Bảng điều khiển'" :breadcrumbs="[]">
        </x-page-heading>

        {{ auth()->user()->role[0]->permissions }}
    </div>
@endsection
