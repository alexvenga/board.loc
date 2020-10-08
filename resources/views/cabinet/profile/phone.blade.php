@extends('layouts.app')

@section('content')

    @include('cabinet.partials.nav')

    {!! Form::open()
     ->route('cabinet.profile.phone.verify')
     ->method('put')
     ->autocomplete('off')!!}

    {!! Form::text('token', 'Token from SMS') !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
