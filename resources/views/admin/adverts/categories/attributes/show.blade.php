@extends('layouts.app')

@section('content')

    @include('admin.partials.nav')

    @php /** @var \App\Models\Adverts\Category $category */ @endphp
    @php /** @var \App\Models\Adverts\Attribute $attribute */ @endphp

    <div class="d-flex flex-row justify-content-end mb-3">
        <a class="btn btn-primary mr-1"
           href="{{ route('admin.adverts.categories.attributes.edit', [$category, $attribute]) }}">
            Edit
        </a>
        <form class="mr-1" method="post"
              action="{{ route('admin.adverts.categories.attributes.destroy', [$category, $attribute]) }}">
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
                {{ $attribute->id }}
            </td>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <td>
                {{ $attribute->name }}
            </td>
        </tr>
        <tr>
            <th>
                Type
            </th>
            <td>
                {{ $attribute->type }}
            </td>
        </tr>
        <tr>
            <th>
                Required
            </th>
            <td>
                {{ $attribute->required ? 'Yes' : '' }}
            </td>
        </tr>
        <tr>
            <th>
                Variants
            </th>
            <td>
                {{ implode(', ', $attribute->variants) }}
            </td>
        </tr>
        </tbody>
    </table>

@endsection
