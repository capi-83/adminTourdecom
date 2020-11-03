@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Utilisateurs</h3>
                    @if($userNotifications->count())
                        <div class="card-tools">
                            <a href="{{route('notifications.clear','users')}}">
                            <span class="badge badge-danger">
                                clear all <i class="fas fa-trash"></i>
                            </span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Utilisateur</th>
                            <th>Par</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userNotifications as $notif)
                        <tr>
                            <td>{{$notif->created_at->format('d/m/Y h:i:s')}}</td>
                            <td><span class="badge bg-{{$notif->data['badge']}}">{{$notif->data['method']}}</span></td>
                            <td>{{$notif->data['profil']['name']}} - {{$notif->data['profil']['email']}}</td>
                            <td>{{$notif->data['fromUser']['name']}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection


@section('js')
@endsection
