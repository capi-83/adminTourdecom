@extends('admin.layouts.app')

@section('content')
    <form role="form" action="{{ route('profile.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">{{__('profil.add.title')}}</h3>
                    </div>
                    <div class="card-body">
                        <x-input
                            name="name"
                            label="{{__('form.input.name')}}"
                            :disabled=false
                            value="{{ old('name')}}"
                        />
                        <x-input
                            name="email"
                            label="{{__('form.input.email')}}"
                            :disabled=false
                            value="{{ old('email')}}"
                        />
                        <x-input
                            name="password"
                            label="{{__('form.input.password')}}"
                            :disabled=false
                            type="password"
                            value=""
                        />
                        <x-input
                            name="password_confirmation"
                            label="{{__('form.input.confirmPassord')}}"
                            :disabled=false
                            type="password"
                            value=""
                        />
                        <div class="form-group">
                            <label>{{__('form.input.role')}}</label>
                            <select class="select2 @error('roles') is-invalid @enderror" name="roles[]"
                                    multiple="multiple" data-placeholder="{{__('form.input.select')}}"
                                    style="width: 100%;">
                                    @foreach(\App\Role\UserRole::getRoleList() as $rk => $rv)
                                        <option
                                            @if($rk === \App\Role\UserRole::ROLE_SUPERADMIN) disabled @endif
                                            value="{{$rk}}">{{$rv}}</option>
                                    @endforeach

                            </select>
                        </div>
                       <button type="submit" class="btn btn-success">{{__('profil.button.submit')}}</button>
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
