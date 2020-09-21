@extends('layouts.app')

@section('content')

    @php // TODO: Посмотреть в сторону форм https://laravelcollective.com/docs/6.x/html @endphp

    @include('admin.users.partials.nav')

    {!! Form::open()
     ->route('admin.users.update', compact('user'))
     ->method('put')
     ->autocomplete('off')
     ->fill($user)!!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('email', 'Email') !!}

    {!! Form::select('status', 'Status')->options($statuses) !!}


    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
