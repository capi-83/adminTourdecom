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
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header with-border">
                    <h3 class="card-title">{{__('dashboard.articles.title')}}</h3>
                </div>
                <div class="card-body">
                    <center>
                        <canvas id="articles" width="400" height="400"></canvas>
                    </center>
                </div>
            </div>
        </div>
        <div class="'col-md-6">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="far fa-comment"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{__('dashboard.comments')}}</span>
                    <span class="info-box-number">{{$comments}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/adminlte/plugins/chart.js/chart.min.css">
@endsection

@section('js')
    <script src="/adminlte/plugins/chart.js/chart.min.js"></script>
    <script>
        $(function () {
            let ctx = document.getElementById("articles");
            let articles = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach($articlesStats as $statkey => $statVal)
                            "{{$statkey}}"
                            @if(!$loop->last) , @endif
                        @endforeach
                    ],
                    datasets: [{
                        label: "{{__('dashboard.articles.published')}}",
                        backgroundColor: "#caf270",
                        data: [
                            @foreach($articlesStats as $statkey => $statVal)
                                {{$statVal["published"]}}
                            @if(!$loop->last) , @endif
                            @endforeach
                        ],
                    }, {
                        label: "{{__('dashboard.articles.workInProgress')}}",
                        backgroundColor: "#45c490",
                        data: [
                            @foreach($articlesStats as $statkey => $statVal)
                            {{$statVal["workInProgress"]}}
                            @if(!$loop->last) , @endif
                            @endforeach
                        ],
                    }, {
                        label: "{{__('dashboard.articles.waitingForValidation')}}",
                        backgroundColor: "#008d93",
                        data: [
                            @foreach($articlesStats as $statkey => $statVal)
                            {{$statVal["waitingForValidation"]}}
                            @if(!$loop->last) , @endif
                            @endforeach
                        ],
                    }, {
                        label: "{{__('dashboard.articles.disabled')}}",
                        backgroundColor: "#2e5468",
                        data: [
                            @foreach($articlesStats as $statkey => $statVal)
                            {{$statVal["disabled"]}}
                            @if(!$loop->last) , @endif
                            @endforeach
                        ],
                    }],
                },
                options: {
                    tooltips: {
                        displayColors: true,
                        callbacks:{
                            mode: 'x',
                        },
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { position: 'bottom' },
                }
            });
        })
    </script>
@endsection
