@extends('layouts.app')

@section('content')

    @php // TODO: Посмотреть в сторону форм https://laravelcollective.com/docs/6.x/html @endphp

    @include('admin.partials.nav')

    {!! Form::open()
     ->route('admin.users.update', compact('user'))
     ->method('put')
     ->autocomplete('off')
     ->fill($user)!!}

    {!! Form::text('name', 'Name') !!}
    {!! Form::text('email', 'Email') !!}

    {!! Form::select('role', 'Role')->options($roles) !!}


    {!! Form::submit("Save") !!}

    {!! Form::close() !!}

@endsection
