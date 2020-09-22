@extends('layouts.app')

@section('content')

    @include('admin.users.partials.nav')

    @php /** @var \App\Models\User $user */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-primary mr-1"
           href="{{ route('admin.users.edit', $user) }}">
            Edit
        </a>
        <form class="mr-1" method="post" action="{{ route('admin.users.verify', $user) }}">
            @csrf
            <button class="btn btn-success" type="submit">Verify</button>
        </form>
        <form class="mr-1" method="post" action="{{ route('admin.users.destroy', $user) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?');">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>
                ID
            </th>
            <td>
                {{ $user->id }}
            </td>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <td>
                {{ $user->name }}
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
        <tr>
            <th>
                Status
            </th>
            <td>
                @if ($user->isWait())
                    <span class="badge badge-secondary">Waiting</span>
                @endif
                @if ($user->isActive())
                    <span class="badge badge-primary">Active</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>
                Role
            </th>
            <td>
                @if ($user->isAdmin())
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>

@endsection
