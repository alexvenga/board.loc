@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    {!! Form::open()->route('admin.regions.store',['parent'=>$parent ? $parent->id : null]) !!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('slug', 'Slug') !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
