@extends('layouts.starlight')
@php
    use App\Models\Category;
    use App\Models\User;
@endphp
@section('content')
<!-- ########## START: Navbar PANEL ########## -->
@include('layouts.nav')
<!-- ########## START: Navbar PANEL ########## -->
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ ('/') }}">Dashboard</a>
    {{-- <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a> --}}
    <span class="breadcrumb-item active">Users List</span>
    </nav>
    <div class="sl-pagebody">

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header bg-success text-center"><h4>{{ __('Sub Category List') }}</h4></div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $key => $subcategory)
                                    <tr>
                                        <th scope="row"> {{$subcategories->firstItem()+$key}}</th>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ Category::find($subcategory->category_id)->category_name }}</td>
                                        <td>{{ $subcategory->created_at->format('d,m,Y h:i:s A')}}</td>
                                        <td class="d-flex">
                                            <a href="{{ url('subcategory/delete') }}/{{ $subcategory->id }}" class="btn btn-warning">Delete</a>
                                            <a href="#" class="btn btn-primary ">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="5"><h5>No data to show</h5></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center mx-auto">
                            <p> {{ $subcategories->links() }}</p>
                        </div>
                    </div>
                    {{-- <div class="card-footer bg-success text-center">
                        <h5>Total Sub Category: {{ $subcategory::count() }}</h5>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header bg-success text-center"><h4>{{ __('Add Sub Category') }}</h4></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error_status'))
                            <div class="alert alert-danger">
                                {{ session('error_status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('subcategory/insert') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Category Name</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-Select One-</option>
                                    @foreach ($categories as $category)
                                    <option {{ ( old('category_id') == $category->id) ? "Selected" : "" }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subcategory_name">Sub Category Name</label>
                                <input type="text" name="subcategory_name" class="form-control" id="subcategory_name" value="{{ old('subcategory_name') }}">
                                @error('subcategory_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success m-auto">Add Sub Category</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-center"><h4>{{ __('Trashed Sub category') }}</h4></div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deleted_subcategories as $key => $deleted_subcategory)
                                    <tr>
                                        <th scope="row"> {{$loop->index + $key}}</th>
                                        <td>{{ $deleted_subcategory->subcategory_name }}</td>
                                        <td>{{ Category::find($deleted_subcategory->category_id)->category_name }}</td>
                                        <td>{{ $deleted_subcategory->created_at->format('d,m,Y h:i:s A')}}</td>
                                        <td class="d-flex">
                                            <a href="{{ url('subcategory/restore') }}/{{ $deleted_subcategory->id }}" class="btn btn-success">Restore</a>
                                            <a href="{{ url('subcategory/restore') }}/{{ $deleted_subcategory->id }}" class="btn btn-danger">P.Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="5"><h5>No data to show</h5></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center mx-auto">
                            <p> {{ $deleted_subcategories->links() }}</p>
                        </div>
                    </div>
                    {{-- <div class="card-footer bg-success text-center">
                        <h5>Total Sub Category: {{ $subcategory::count() }}</h5>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>

    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
