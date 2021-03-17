@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('notification.users.title')}}</h3>
                    @if($userNotifications->count())
                        <div class="card-tools">
                            <a href="{{route('notifications.clear','users')}}">
                            <span class="badge badge-danger">
                                {{__('notification.users.clearAll')}} <i class="fas fa-trash"></i>
                            </span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{{__('notification.table.date')}}</th>
                            <th>{{__('notification.table.type')}}</th>
                            <th>{{__('notification.table.user')}}</th>
                            <th>{{__('notification.table.by')}}</th>
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
