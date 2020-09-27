@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    {!! Form::open()->route('admin.adverts.categories.attributes.store',[$category]) !!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('sort', 'Sort')->type('number') !!}
    {!! Form::select('type', 'type', $types) !!}

    {!! Form::textarea('variants', 'Variants') !!}

    {!! Form::hidden('required', '0') !!}
    {!! Form::checkbox('required', 'Required', '1') !!}

    <br>
    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
