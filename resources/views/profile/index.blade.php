@extends('layouts.master')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container-fluid">
        <x-page-heading :title="'Cài đặt tài khoản'" :breadcrumbs="$breadcrumbs" />

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            @include('profile.partials.sidebar')
                        </div>

                        <div class="col-12 col-md-9 d-flex flex-column">
                            <div class="card-body">
                                <h3 class="card-title">Thông tin cá nhân</h3>


                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="#" class="btn btn-primary btn-2"> Lưu thay đổi </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
