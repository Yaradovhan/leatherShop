@extends('layouts.app')

@section('content')
    @include('admin.products.products._nav')

    <form method="POST" action="{{ route('admin.products.products.create') }}">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="title" class="col-form-label">Title</label>
                <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                       value="{{ old('title') }}" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="slug" class="col-form-label">Slug</label>
                <div class="input-group mb-2">
                    <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}"
                           name="slug"
                           value="{{ old('slug') }}" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="createSlugBtn">Create slug</button>
                    </div>
                </div>
                @if ($errors->has('slug'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
                @endif
            </div>
            <div class="form-group col-md-2">
                <label for="category" class="col-form-label">Category</label>
                <select id="category"
                        class="selectpicker form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                        name="category">
                    <option value=""></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('parent') ? ' selected' : '' }}>
                            @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                            {{ $category->name }}
                        </option>
                    @endforeach;
                </select>
                @if ($errors->has('category'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('category') }}</strong></span>
                @endif
            </div>
            <div class="form-group col-md-2">
                <label for="price" class="col-form-label">Price</label>
                <input id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                       name="price" type="number" value="{{ old('price') }}">
                @if ($errors->has('price'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-form-label">Description</label>
            <textarea id="summernote" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      data-image-url="{{ route('admin.ajax.upload.image') }}" name="description" rows="10"
                      required>{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
