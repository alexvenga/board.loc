@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    @php /** @var \App\Models\Adverts\Category $category */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-primary mr-1"
           href="{{ route('admin.adverts.categories.edit', $category) }}">
            Edit
        </a>
        <form class="mr-1" method="post" action="{{ route('admin.adverts.categories.destroy', $category) }}">
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
                {{ $category->id }}
            </td>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <td>
                {{ $category->name }}
            </td>
        </tr>
        <tr>
            <th>
                Slug
            </th>
            <td>
                {{ $category->slug }}
            </td>
        </tr>
        <tr>
            <th>
                Parent
            </th>
            <td>
                {!! $category->parent ? $category->parent->name : '&mdash;' !!}
            </td>
        </tr>
        </tbody>
    </table>


@endsection
