@extends('layouts.app')

@section('content')
        {{ __('Dashboard') }}

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
    @endif

    {{ __('You are logged in!') }}
@endsection
