@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    @php /** @var \App\Models\Region $region */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-primary mr-1"
           href="{{ route('admin.regions.edit', $region) }}">
            Edit
        </a>
        <form class="mr-1" method="post" action="{{ route('admin.regions.destroy', $region) }}">
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
                {{ $region->id }}
            </td>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <td>
                {{ $region->name }}
            </td>
        </tr>
        <tr>
            <th>
                Slug
            </th>
            <td>
                {{ $region->slug }}
            </td>
        </tr>
        <tr>
            <th>

            </th>
            <td>
                <a class="btn btn-success mr-1"
                   href="{{ route('admin.regions.create', ['parent'=>$region->id]) }}">
                    Create region
                </a>
            </td>
        </tr>
        </tbody>
    </table>
    @if ($regions)
        <hr>
        <h2>Children</h2>
        @include('admin.regions._list', compact('regions'))

    @endif


@endsection
