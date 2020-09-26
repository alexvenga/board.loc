@extends('layouts.app')

@section('content')

    @php // TODO: Посмотреть в сторону форм https://laravelcollective.com/docs/6.x/html @endphp

    @include('admin.partials.nav')

    {!! Form::open()
     ->route('admin.regions.update', compact('region'))
     ->method('put')
     ->autocomplete('off')
     ->fill($region)!!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('slug', 'slug') !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
