@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    @php /** @var \App\Models\Region[] $regions */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-success mr-1"
           href="{{ route('admin.regions.create') }}">
            Create region
        </a>
    </div>

    @include('admin.regions._list', compact('regions'))


@endsection
