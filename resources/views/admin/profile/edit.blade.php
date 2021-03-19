@extends('admin.layouts.app')

@section('content')
    <form role="form" action="{{ route('profile.update', $user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">{{__('profil.update.title')}}</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            @if($user->disabled)
                                <span class="badge badge-warning">
                                    {{__('profil.update.disabled')}} <i class="fas fa-user-times"></i>
                                </span>
                            @else
                                <span class="badge badge-primary">
                                    {{__('profil.update.enabled')}} <i class="fas fa-user"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                    <div class="card-body">
                        <x-input
                            name="name"
                            label="{{__('form.input.name')}}"
                            disabled="{{$disabled || (isset($specificRights['name']) && !$specificRights['name'])}}"
                            value="{{ (old('name'))?old('name'): $user->name }}"
                        />
                        <x-input
                            name="email"
                            label="{{__('form.input.email')}}"
                            disabled="{{$disabled || (isset($specificRights['email']) && !$specificRights['email'])}}"
                            value="{{ (old('email'))?old('email'): $user->email }}"
                        />
                        <x-input
                            name="password"
                            label="{{__('form.input.password')}}"
                            type="password"
                            disabled="{{$disabled || (isset($specificRights['password']) && !$specificRights['password'])}}"
                            value=""
                        />
                        <x-input
                            name="password_confirmation"
                            label="{{__('form.input.confirmPassord')}}"
                            type="password"
                            disabled="{{$disabled || (isset($specificRights['password']) && !$specificRights['password'])}}"
                            value=""
                        />
                        <div class="form-group">
                            <label>{{__('form.input.role')}}</label>
                            <select class="select2" name="roles[]"
                                    @if($disabled || (isset($specificRights['roles']) && !$specificRights['roles'])) disabled @endif
                                    multiple="multiple" data-placeholder="{{__('form.input.select')}}"
                                    style="width: 100%;">
                                    @foreach(\App\Role\UserRole::getRoleList() as $rk => $rv)
                                        <option
                                            @if($rk === \App\Role\UserRole::ROLE_SUPERADMIN) disabled @endif
                                            @if($user->hasRole($rk)) selected @endif
                                            value="{{$rk}}">{{$rv}}</option>
                                    @endforeach

                            </select>
                        </div>
                        @if(!$disabled)
                            <button type="submit" class="btn btn-success">{{__('profil.button.submit')}}</button>
                        @endif

                        @if((isset($specificRights['disabled']) && $specificRights['disabled']))
                            <a name="disabled" href="{{route('profile.disabled',$user)}}"
                               class=" btn   @if($user->disabled) btn-primary @else btn-warning @endif">
                                @if($user->disabled)
                                    {{__('profil.button.enabled')}}
                                @else
                                    {{__('profil.button.disabled')}}
                                @endif
                            </a>
                        @endif

                        @if((isset($specificRights['delete']) && $specificRights['delete']))
                            <button type="button" name="delete"  data-toggle="modal" data-target="#modal-delete"
                               class="btn btn-danger">{{__('profil.button.delete')}}</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">{{__('profil.update.subtitle')}}</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{ Gravatar::get($user->email) }}" class="img-circle elevation-2" alt="User Image">
                        <p>{{__('profil.update.updateAvatar')}}: <a target="_blank" href="http://fr.gravatar.com/">Gravatar</a></p>
                        <x-input
                            name="discordTag"
                            label="{{__('form.input.discordTag')}}"
                            disabled="{{$disabled || (isset($specificRights['discordTag']) && !$specificRights['discordTag'])}}"
                            value="{{ (old('discordTag'))?old('discordTag'): $user->discordTag }}"
                        />
                        <x-input
                            name="twitter"
                            label="{{__('form.input.twitter')}}"
                            disabled="{{$disabled || (isset($specificRights['twitter']) && !$specificRights['twitter'])}}"
                            value="{{ (old('twitter'))?old('twitter'): $user->twitter }}"
                        />
                        <x-input
                            name="mtgaTag"
                            label="{{__('form.input.mtgaTag')}}"
                            disabled="{{$disabled || (isset($specificRights['mtgaTag']) && !$specificRights['mtgaTag'])}}"
                            value="{{ (old('mtgaTag'))?old('mtgaTag'): $user->mtgaTag }}"
                        />
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('profil.modal.titleConfirm')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        {{__('profil.modal.text')}}
                    </div>
                    <p>{{__('profil.modal.confirmDelete')}}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('profil.modal.close')}}</button>
                    <a  href="{{route('profile.delete',$user)}}" type="button" class="btn btn-warning">{{__('profil.modal.delete')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('js')
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function () {
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
