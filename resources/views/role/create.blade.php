@extends('layout_admin.master')
@section('content')

    <div class="card">
        {{--        <div class="card-header"></div>--}}
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" placeholder="Nhập họ tên của bạn" class="form-control"
                           value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <span class="text-danger">
                    {{ $errors->first('name') }}
                </span>
                    @endif
                    <br>
                    <br>
                    <button class="btn btn-success">Create</button>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Prev </a>
            </form>

        </div>
    </div>

@endsection
