@extends('layouts.app')

@section('content')
    @include('admin.users._nav')

    <form action="{{route('admin.users.update', $user)}}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name" class="col-form-label">First Name</label>
            <input type="text" id="first_name" class="form-control{{$errors->has('first_name') ? ' is-invalid' : ''}}" name="first_name"
                   value="{{old('first_name', $user->first_name)}}" required>
            @if($errors->has('first_name'))
                <span class="invalid-feedback"><strong>{{$errors->first('first_name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name</label>
            <input type="text" id="last_name" class="form-control{{$errors->has('last_name') ? ' is-invalid' : ''}}" name="last_name"
                   value="{{old('last_name', $user->last_name)}}" required>
            @if($errors->has('last_name'))
                <span class="invalid-feedback"><strong>{{$errors->first('last_name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input type="email" id="email" class="form-control{{$errors->has('email') ? ' is-invalid' : ''}}"
                   name="email" value="{{old('email', $user->email)}}" required>
            @if($errors->has('email'))
                <span class="invalid-feedback"><strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" id="role" class="form-control{{$errors->has('role') ? ' is-invalid' : ''}}">
                @foreach($roles as $value=>$label)
                    <option value="{{$value}}" {{$value === old('role', $user->role) ? 'selected' : ''}}>{{$label}}
                    </option>
                @endforeach
            </select>
            @if($errors->has('role'))
                <span class="invalid-feedback"><strong>{{$errors->first('role')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
