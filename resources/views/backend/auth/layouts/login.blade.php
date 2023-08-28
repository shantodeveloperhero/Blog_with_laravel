

@extends('backend.auth.layouts.master')
@section('page_title', ' login')
@section('content')
{!! Form::open([]) !!}
{!! Form::label('email', 'Email') !!}
{!! Form::email('email', null, ['class'=>'form-control form-control-sm']) !!}
{!! Form::label('password', 'Password',['class'=>'mt-2']) !!}
{!! Form::password('password', ['class'=>'form-control form-control-sm']) !!}
{!! Form::button('login', ['type'=>'submit', 'class'=>'btn btn-outline-info mt-2']) !!}
{!! Form::close() !!}
@endsection