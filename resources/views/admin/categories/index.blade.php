@extends('admin.master')
@section('title', 'All Category | ' . env('APP_NAME'))
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">All Category</h1>
@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('msg') }}
    </div>
@endif
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>

        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name_en }}</td>
                <td><img src="{{ asset('uploads/categories/' . $category->image) }}" alt=""></td>
                <td>{{ $category->Created_At }}</td>
                <td>{{ $category->Updated_At }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}"><i
                            class="fas fa-edit"></i></a>
                    <form action="POST" method="{{ route('admin.categories.destroy',$category->id) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn -primary btn-sm" onclick="return confirm('Are You Sure??')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6">No Data</td>
            </tr>
        @endforelse
    </table>

    {{ $categories->links() }}
@stop
