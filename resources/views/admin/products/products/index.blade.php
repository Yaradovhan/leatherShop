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
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category</label>
                            <input id="category" class="form-control" name="category" value="{{ request('category') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select id="status" class="selectpicker form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" {{ $value=== request('status') ? ' selected' : ''
                                    }}>{{ $label }}</option>
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

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Updated</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->updated_at }}</td>
                <td><a href="{{ route('product.show', $product) }}" target="_blank">{{ $product->title }}</a></td>
{{--                <td>{{ $product->category->id }} - {{ $product->category->name }}</td>--}}
                <td>Category</td>
                <td>
                    @if ($product->isActive())
                        <span class="badge badge-primary">Active</span>
                    @elseif ($product->isClosed())
                        <span class="badge badge-secondary">Closed</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

{{--    {{ $product->links() }}--}}
@endsection
