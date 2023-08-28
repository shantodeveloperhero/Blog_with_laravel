

@extends('backend.auth.layouts.master')
@section('page_title', ' Reset Password')
@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    </div>

    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror

          <div class="text-center text-lg-start mt-4 pt-2">
            <x-primary-button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                {{ __('Reset Password') }}
            </x-primary-button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already Registered? <a href="{{ route('login') }}"
                class="link-danger">Login Here</a></p>
                <p class="small fw-bold mt-2 pt-1 mb-0">Not Registered? <a href="{{ route('register') }}"
                    class="link-danger">Registered Here</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</form>
@endsection