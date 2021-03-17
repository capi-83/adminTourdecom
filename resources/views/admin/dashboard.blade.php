@extends('admin.layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <a class="text-gray-dark" href="{{ route('profile.index') }}">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('dashboard.member')}}</span>
                        <span class="info-box-number">{{$totalUsers}}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <a class="text-gray-dark" href="{{ route('profile.index') }}">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-shield"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('dashboard.adminMember')}}</span>
                        <span class="info-box-number">{{$admins}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <a class="text-gray-dark" href="{{ route('profile.index') }}">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-times"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('dashboard.disabledMember')}}</span>
                        <span class="info-box-number">{{$disabledUsers}}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <a class="text-gray-dark" href="{{ route('profile.index') }}">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                        <span class="info-box-text">{{__('dashboard.enabledMember')}}</span>
                        <span class="info-box-number">{{$enabledUsers}}</span>
                </div>
            </div>
            </a>
        </div>
    </div>

@endsection
