@extends('layouts.app')

@section('content')

    @include('admin.users.partials.nav')

    @php /** @var \App\Models\User[] $users */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-success mr-1"
           href="{{ route('admin.users.create') }}">
            Create user
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Status
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a>
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    @if ($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                    @if ($user->isActive())
                        <span class="badge badge-primary">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

@endsection
