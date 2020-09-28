@extends('layouts.app')

@section('content')

    @include('cabinet.partials.nav')

    <div class="mb-3 text-right">
        <a href="{{ route('cabinet.profile.edit') }}" class="btn btn-primary">Edit</a>
    </div>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>
                First name
            </th>
            <td>
                {{ $user->name }}
            </td>
        </tr>
        <tr>
            <th>
                Last name
            </th>
            <td>
                {{ $user->last_name }}
            </td>
        </tr>
        <tr>
            <th>
                Email
            </th>
            <td>
                {{ $user->email }}
            </td>
        </tr>
        </tbody>
    </table>

@endsection
