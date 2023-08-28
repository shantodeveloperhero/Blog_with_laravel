

@extends('backend.auth.layouts.master')
@section('page_title', ' Register')
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <!-- Name -->
    <div>
        <input type="name" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter Your Name" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-4" />
    </div> <br>
    <!-- Email Address -->
    <div>
    
        <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="email" :value="old('email')" required autofocus autocomplete="username" />
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
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
@endsection