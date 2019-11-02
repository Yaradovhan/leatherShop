@extends('layouts.app')

@section('content')
    @include('admin.products.categories._nav')

    <form method="POST" action="{{ route('admin.products.categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="title" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                   value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
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

        <div class="form-group">
            <label for="parent" class="col-form-label">Parent</label>
            <select id="parent" class="selectpicker form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}"
                    name="parent">
                <option value=""></option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" {{ $parent->id == old('parent') ? ' selected' : '' }}>
                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->name }}
                    </option>
                @endforeach;
            </select>
            @if ($errors->has('parent'))
                <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
