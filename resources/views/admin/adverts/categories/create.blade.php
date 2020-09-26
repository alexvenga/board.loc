@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    {!! Form::open()->route('admin.adverts.categories.store') !!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('slug', 'Slug') !!}

    {!! Form::select('parent_id', 'Parent category')->options($parents->prepend('Choose parent category', null)) !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
