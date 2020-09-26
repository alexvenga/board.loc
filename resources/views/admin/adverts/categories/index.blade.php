@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    @php /** @var \App\Models\Adverts\Category[] $categories */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-success mr-1"
           href="{{ route('admin.adverts.categories.create') }}">
            Create category
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Slug
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.adverts.categories.show', $category) }}">{{ $category->name }}</a>
                </td>
                <td>
                    {{ $category->slug }}
                </td>
                <td>
                    <form class="d-inline-block mr-1" method="post" action="{{ route('admin.adverts.categories.first', $category) }}">
                        @csrf
                        @method('POST')
                        <button class="btn btn-sm btn-outline-primary" type="submit"><span class="fa fa-angle-double-up"></span></button>
                    </form>
                    <form class="d-inline-block mr-1" method="post" action="{{ route('admin.adverts.categories.up', $category) }}">
                        @csrf
                        @method('POST')
                        <button class="btn btn-sm btn-outline-primary" type="submit"><span class="fa fa-angle-up"></span></button>
                    </form>
                    <form class="d-inline-block mr-1" method="post" action="{{ route('admin.adverts.categories.down', $category) }}">
                        @csrf
                        @method('POST')
                        <button class="btn btn-sm btn-outline-primary" type="submit"><span class="fa fa-angle-down"></span></button>
                    </form>
                    <form class="d-inline-block mr-1" method="post" action="{{ route('admin.adverts.categories.last', $category) }}">
                        @csrf
                        @method('POST')
                        <button class="btn btn-sm btn-outline-primary" type="submit"><span class="fa fa-angle-double-down"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
