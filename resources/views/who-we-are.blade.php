@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <h1>{{__('who-we-are.title')}}</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p>{{__('who-we-are.description')}}</p>
            </div>
            <div class="col-12">
                <p>{{__('who-we-are.description2')}}</p>
            </div>
            <div class="col-12">
                <ul>
                @foreach($programs as $program)
                    <li>{{__('who-we-are.programs.' . $program)}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
