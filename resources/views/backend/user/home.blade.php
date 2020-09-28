@extends('backend.layouts.user_master')
@section('title', 'Dashboard')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    <h1 style="color: #786c7f; font-weight: 500"> DASHBOARD </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <a style="text-decoration: none;" href="/user/change_password">
                <div class="card-body bg-amy-crisp text-white text-center">
                    <i class="fa fa-lock fa-4x mb-2"></i>
                    <h6>Change Password</h6>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a style="text-decoration: none;" href="/user_login/logout">
                <div class="card-body bg-grow-early text-white text-center">
                    <i class="fa fa-sign-out-alt fa-4x mb-2"></i>
                    <h6>logout</h6>
                </div>
            </a>
        </div>
    </div>

    <style>
        .card-body {
            border-radius: 5px;
        }

        h6 {
            font-weight: 600;
            list-style: none;
        }
    </style>
@endsection
