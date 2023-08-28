@extends('backend.auth.layouts.master')
@section('page_title', ' Reset Password')
@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    
    <!-- Email Address -->
    <div>
    
        <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-4" />
    </div>
    <!-- Password -->
    <div class="mt-4">
        <input  id="form3Example3" class="form-control form-control-lg"
        placeholder="Password" type="password" name="password" required autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-4" />
    </div>
    <!-- Confirm Password -->
    <div class="mt-4">
        <input id="form3Example3" class="form-control form-control-lg"
              placeholder="Confirm Password" type="password" name="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-4" />
    </div>

    <div class="flex items-center justify-end mt-4">

        <x-primary-button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
            {{ __('Update Password') }}
        </x-primary-button>
    </div>
</form>
@endsection