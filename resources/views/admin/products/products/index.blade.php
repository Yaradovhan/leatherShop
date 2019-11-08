@extends('layouts.app')

@section('content')
    @include('admin.products.products._nav')

    <div class="card mb-3">
        <div class="card-header">Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Title</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category</label>
                            <select id="category"
                                    class="selectpicker form-control {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                    name="category">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ $category->id == request('category') ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                                        {{ $category->name }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select id="status" class="selectpicker form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" {{ $value=== request('status') ? ' selected' : ''
                                    }}>{{ $label }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br/>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="?" class="btn btn-outline-secondary">Clear</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <button class="btn btn-success mb-3" id="newPageBtn"
            data-new-page="{{route('admin.products.products.create.form')}}"><i class="fa fa-plus"></i>&#8287;Add new
        product
    </button>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Updated</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th class="d-flex justify-content-end">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->updated_at }}</td>
                <td><a href="{{ route('product.show', $product) }}" target="_blank">{{ $product->title }}</a></td>
                <td>
                    @foreach($product->category as $category)
                        <div class="badge badge-dark">{{$category->name}}</div>
                    @endforeach
                </td>
                <td>
                    @if ($product->isActive())
                        <span class="badge badge-primary">Active</span>
                    @elseif ($product->isClosed())
                        <span class="badge badge-secondary">Closed</span>
                    @endif
                </td>
                <td class="d-flex justify-content-end" data-id="{{$product->id}}"
                    data-url="{{route('admin.products.products.set.status', $product)}}">
                    <button class="btn btn-sm btn-outline-info mr-1 changeStatusBtn" data-id="{{$product->id}}">Change the status
                    </button>
                    <a href="{{route('admin.products.products.editForm', $product)}}"
                       class="btn btn-sm btn-warning mr-1">Edit</a>
                    <form action="{{route('admin.products.products.destroy', $product)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{--    {{ $product->links() }}--}}
@endsection
