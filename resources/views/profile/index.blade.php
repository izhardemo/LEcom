@extends('layouts.user.app')
@section('title','Profile')
@section('content')
<div class="row">
    <div class="col">
        <x-bootstrap.card>
            <x-slot name="title">
                <h4 class="mb-0 fw-bolder">Profile Information</h4>
            </x-slot>
            <x-slot name="subTitle">
                <small>Update your account's profile information and email address.</small>
            </x-slot>
            <x-slot name="content">
                <hr>
                <div class="mt-1 fs-6 fw-bolder">Photo</div>
                <form action="{{route('user.profile.update',[Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column">
                        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/'.Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" id="wizardPicturePreview" class="img-fluid rounded-circle my-2" style="width:100px;height:100px">
                        <div class="d-flex">
                            <button class="btn btn-secondary btn-sm" type="button" value="" style="width: 250px;position: relative;">
                                <input type="file" name="file" id="wizard-picture" style="cursor: pointer;
                                display: inline-block;
                                height:100%;
                                left: 0;
                                opacity: 0 !important;
                                position: absolute;
                                top: 0;
                                width:100%;">
                                SELECT A NEW PHOTO
                            </button>
                            @if (isset(Auth::user()->profile_photo_path))
                            <button type="submit" class="btn btn-sm btn-outline-secondary ms-1" form="deletephoto">REMOVE PHOTO</button>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="form-label fw-bolder fs-6">Name</label>
                        <input type="text" name="name" value="{{isset(Auth::user()->name) ? ucwords(Auth::user()->name) : ''}}" class="form-control">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <label class="form-label fw-bolder fs-6">Email</label>
                        <input type="email" name="email" value="{{isset(Auth::user()->email) ? Auth::user()->email : ''}}" class="form-control">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <label class="form-label fw-bolder fs-6">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{isset(Auth::user()->phone_number) ? Auth::user()->phone_number : ''}}" class="form-control" minlength="10" maxlength="10">
                        @error('phone_number')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-sm mt-1 fs-6 ms-auto">Save</button>
                    </div>
                </form>
                <form action="{{route('user.profile.removePhoto',[Auth::user()->id,'photo'])}}" method="post" id="deletephoto">
                    @csrf
                </form>
            </x-slot>
        </x-bootstrap.card>
    </div>
</div>
<div class="row">
    <div class="col">
        <x-bootstrap.card>
            <x-slot name="title">
                <h4 class="mb-0 fw-bolder">Update Password</h4>
            </x-slot>
            <x-slot name="subTitle">
                <small>Ensure your account is using a long, random password to stay secure.</small>
            </x-slot>
            <x-slot name="content">
                <hr>
                <form action="{{route('user.profile.password',[Auth::user()->id])}}" method="post">
                    @csrf
                    <div class="mt-1">
                        <label class="form-label fw-bolder fs-6">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <label class="form-label fw-bolder fs-6">New Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <label class="form-label fw-bolder fs-6">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-sm mt-1 fs-6 ms-auto">Save</button>
                    </div>
                </form>
            </x-slot>
        </x-bootstrap.card>
    </div>
</div>
@livewire('profile.logout-other-browser-sessions-form')
@endsection

@push('js')
    <script>
        $(document).ready(function(){
        // Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
                readURL(this);
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush