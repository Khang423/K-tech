@extends('layout.master')
@section('content')
    <form action="{{ route('courses.update', $i->id) }}" method="post">
        @csrf
        @method('put')
        Name
        <input type="text" name="name" value="{{ $i->name }}">
        @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
        @endif
        <br>
        <button>
            Update
        </button>
    </form>
@endsection
