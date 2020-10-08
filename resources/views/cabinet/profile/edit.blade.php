@extends('layouts.app')

@section('content')

    @include('cabinet.partials.nav')

    {!! Form::open()
     ->route('cabinet.profile.update')
     ->method('put')
     ->autocomplete('off')
     ->fill($user)!!}

    {!! Form::text('name', 'First name') !!}
    {!! Form::text('last_name', 'Last name') !!}
    {!! Form::text('phone', 'Phone') !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
