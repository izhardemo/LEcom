@extends('layouts.guest')

@section('title', 'Privacy Policy')

@section('content')
<div class="d-flex justify-content-center pt-4">
    <div class="d-flex flex-column align-items-center pt-sm-0">
        <x-authentication-card-logo />
        <div class="w-100 mt-1 p-5 bg-white shadow-md overflow-hidden rounded">
            {!! $policy !!}
        </div>
    </div>
</div>
@endsection