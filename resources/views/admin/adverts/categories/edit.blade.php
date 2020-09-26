@extends('layouts.app')

@section('content')

    @php // TODO: Посмотреть в сторону форм https://laravelcollective.com/docs/6.x/html @endphp

    @include('admin.partials.nav')

    {!! Form::open()
     ->route('admin.adverts.categories.update', compact('category'))
     ->method('put')
     ->autocomplete('off')
     ->fill($category)!!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('slug', 'Slug') !!}

    {!! Form::select('parent_id', 'Parent category')->options($parents->prepend('Choose parent category', '')) !!}

    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
