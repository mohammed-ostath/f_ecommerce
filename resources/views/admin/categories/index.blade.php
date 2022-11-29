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
            <th>Parent</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>

        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name_en }}</td>
                <td>
                    @php
                        $src = asset('uploads/categories/'.$category->image);
                        if ($category->image == 'no-image.png') {
                            $src = asset('uploads/no-image.png');
                        }
                    @endphp

                    <img width="100" src="{{ $src  }}" alt=""></td>
                <td>{{ $category->parent->name_en ? $category->parent->name_en : "Main Category" }}</td>
                <td>{{ $category->created_at->format('d-m-Y') }}</td>
                <td>{{ $category->updated_at->diffForHumans() }}</td>
                <td>
                    @if ($category->id != 1)
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}"><i
                        class="fas fa-edit"></i></a>
                <form class="d-inline" action="POST" method="{{ route('admin.categories.destroy', $category->id) }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure??')">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endif

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

@section('scripts')
    <script>
        setTimeout(() => {
            $('.alert').fadeOut()
        }, 3000);
    </script>
@stop
