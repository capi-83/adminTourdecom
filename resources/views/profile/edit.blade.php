@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('profile.update', $user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Mes infos</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            @if($user->disabled)
                                <span class="badge badge-warning">
                                    Fiche inactive <i class="fas fa-user-times"></i>
                                </span>
                            @else
                                <span class="badge badge-primary">
                                    Fiche active <i class="fas fa-user"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Pseudo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   @if($disabled || (isset($specificRights['name']) && !$specificRights['name']))
                                        disabled
                                   @endif
                                   value="{{ (old('name'))?old('name'): $user->name }}" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   @if($disabled || (isset($specificRights['email']) && !$specificRights['email'])) disabled @endif
                                   id="email" name="email" value="{{ (old('email'))?old('email'): $user->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password ">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Password"
                                   @if($disabled || (isset($specificRights['password']) && !$specificRights['password'])) disabled @endif>
                            @error('Password')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="confirm-password" name="password_confirmation" placeholder="Password"
                                   @if($disabled || (isset($specificRights['password']) && !$specificRights['password'])) disabled @endif>
                        </div>
                        <div class="form-group">
                            <label>Rôles:</label>
                            <select class="select2" name="roles[]"
                                    @if($disabled || (isset($specificRights['roles']) && !$specificRights['roles'])) disabled @endif
                                    multiple="multiple" data-placeholder="Select a role"
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        @endif

                        @if((isset($specificRights['disabled']) && $specificRights['disabled']))
                            <a name="disabled" href="{{route('profile.disabled',$user)}}"
                               class=" btn   @if($user->disabled) btn-primary @else btn-warning @endif">
                                @if($user->disabled)
                                    Activer
                                @else
                                    Desactiver
                                @endif
                            </a>
                        @endif

                        @if((isset($specificRights['delete']) && $specificRights['delete']))
                            <a name="delete" href="{{route('profile.delete',$user)}}"
                               class="btn btn-danger">Delete</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Ma fiche</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{ Gravatar::get($user->email) }}" class="img-circle elevation-2" alt="User Image">
                        <p>Modifier votre avatar: <a target="_blank" href="http://fr.gravatar.com/">Gravatar</a></p>
                        <div class="form-group">
                            <label for="discordTag">Discord</label>
                            <input type="text" class="form-control @error('discordTag') is-invalid @enderror"
                                   @if($disabled || (isset($specificRights['discordTag']) && !$specificRights['discordTag'])) disabled @endif
                                   value="{{ (old('discordTag'))?old('discordTag'): $user->discordTag }}"
                                   id="discordTag" name="discordTag">
                            @error('discordTag')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                   @if($disabled || (isset($specificRights['twitter']) && !$specificRights['twitter'])) disabled @endif
                                   id="twitter" name="twitter" value="{{ (old('twitter'))?old('twitter'): $user->twitter }}">
                            @error('twitter')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mtgaTag ">Mtga</label>
                            <input type="text" class="form-control  @error('mtgaTag') is-invalid @enderror"
                                   id="mtgaTag" name="mtgaTag" value="{{ (old('mtgaTag'))?old('mtgaTag'): $user->mtgaTag }}"
                                   @if($disabled || (isset($specificRights['mtgaTag']) && !$specificRights['mtgaTag'])) disabled @endif>
                            @error('mtgaTag')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
