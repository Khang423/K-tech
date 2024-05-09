@extends('layout_admin.master')
@section('content')
    <form action="{{ route('roles.update', $role) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="simpleinput">Name</label>
            <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $role->name }}">
        </div>
        <button class="btn btn-success ">Update</button>
    </form>
@endsection
