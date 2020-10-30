@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins</h3>
                </div>
                <div class="card-body">
                    <table id="admins" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>discordTag</th>
                            <th>twitter</th>
                            <th>mtgaTag</th>
                            <th>rôles</th>
                            <th>disabled</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $user)
                                <tr data-href="{{ route('profile.edit',$user) }}"  class="@if($user->disabled) bg-gradient-danger @endif">
                                    <td>{{$user->name}}</td>
                                    <td><a target="_blank" href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    <td>{{$user->discordTag}}</td>
                                    <td><a target="_blank" href="https://twitter.com/{{$user->twitter}}">{{$user->twitter}}</a></td>
                                    <td>{{$user->mtgaTag}}</td>
                                    <td>
                                        @foreach($user->roles as $r)
                                            {{\App\Role\UserRole::getHumanRole($r)}}
                                            @if( ! $loop->last)
                                                |
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <span style="display:none;">{{$user->disabled}}</span>
                                        @if($user->disabled)
                                            <i class="fas fa-user-times"></i>
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>discordTag</th>
                            <th>twitter</th>
                            <th>mtgaTag</th>
                            <th>rôles</th>
                            <th>disabled</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr data-href="{{ route('profile.edit',$user) }}" class="@if($user->disabled) tdc-bg-danger @endif">
                                <td>{{$user->name}}</td>
                                <td><a target="_blank" href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                <td>{{$user->discordTag}}</td>
                                <td><a target="_blank" href="https://twitter.com/{{$user->twitter}}">{{$user->twitter}}</a></td>
                                <td>{{$user->mtgaTag}}</td>
                                <td>
                                    @foreach($user->roles as $r)
                                        {{\App\Role\UserRole::getHumanRole($r)}}
                                    @endforeach
                                </td>
                                <td>
                                    <span style="display:none;">{{$user->disabled}}</span>
                                    @if($user->disabled)
                                        <i class="fas fa-user-times"></i>
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>discordTag</th>
                            <th>twitter</th>
                            <th>mtgaTag</th>
                            <th>rôles</th>
                            <th>disabled</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection


@section('js')
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $(`#admins`).DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[5, "desc"]],
                "processing": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });

            $(`#users`).DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 50,
                "order": [[0, "desc"]],
                "processing": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
            $('#admins').on('click', 'tbody tr', function() {
                window.location.href = $(this).data('href');
            });

            $('#users').on('click', 'tbody tr', function() {
                window.location.href = $(this).data('href');
            });
            $('tr').css('cursor','pointer');
        })
    </script>
@endsection
