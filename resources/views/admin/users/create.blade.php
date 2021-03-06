@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    {!! Form::open()->route('admin.users.store') !!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('email', 'Email') !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
