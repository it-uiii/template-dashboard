{{-- @dd($categorys); --}}
@extends('layout.main')
@section('container')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
<div class="card">
    <div class="card-header">
        <div class="card-title">
            @can('category-create')
                <a class="btn btn-primary" href="/category/create">Create New</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    @can('category-edit')
                    <a class="btn btn-warning" href="/category/{{ $category->id }}/edit"><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('category-delete')
                    <form action="/category/{{ $category->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this category?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>  
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $categories->links() }}
    </div>
</div>
@endsection