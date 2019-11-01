@extends('layouts.app')

@section('content')
    @include('admin.products.products._nav')

    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf

        <div class="form-group">
            <label for="title" class="col-form-label">Title</label>
            <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                   value="{{ old('title') }}" required>
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="price" class="col-form-label">Price</label>
            <input id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                   name="price" type="number" value="{{ old('price') }}">
            @if ($errors->has('price'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="slug" class="col-form-label">Slug</label>
            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
                   value="{{ old('slug') }}" required>
            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="parent" class="col-form-label">Parent</label>
            <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                <option value=""></option>
{{--                @foreach ($parents as $parent)--}}
{{--                    <option value="{{ $parent->id }}" {{ $parent->id == old('parent') ? ' selected' : '' }}>--}}
{{--                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor--}}
{{--                        {{ $parent->title }}--}}
{{--                    </option>--}}
{{--                @endforeach;--}}
            </select>
            @if ($errors->has('parent'))
                <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="content" class="col-form-label">Content</label>
            <textarea id="summernote" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                      data-image-url="{{ route('admin.ajax.upload.image') }}" name="content" rows="10"
                      required>{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="description" class="col-form-label">Description</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      name="description" rows="3">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
