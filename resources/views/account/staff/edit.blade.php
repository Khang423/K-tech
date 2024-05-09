@extends('layout_admin.master')
@section('content')
    <style>
        #image {
            border: 3px dashed #5BBCFF;
            border-radius: 15px;
            background: #daeffe;
            width: 200px;
            height: 200px;
        }
    </style>
    <form action="{{ route('staff.update', $staff) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="simpleinput">Name</label>
            <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $staff->name }}">
            @if($errors->has('name'))
                <span class="text-danger">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Avatar</label>
            <br>
            <div>
                <img src="{{ asset('storage/'.$staff->avatar) }}" id="image">
                <input type="file" name="avatar-new" id="img-file" onchange="chooseFile(this)">
                <input type="hidden" name="avatar" value="{{$staff->avatar}}" id="img-file" onchange="chooseFile(this)">
            </div>
        </div>
        <div class="form-group">
            <label for="example-number">Phone</label>
            <input class="form-control" id="example-number" type="number" name="phone" value="{{ $staff->phone }}"
                   placeholder="Enter your phone">
            @if($errors->has('phone'))
                <span class="text-danger">
                    {{ $errors->first('phone') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="example-email">Email</label>
            <input type="email" id="example-email" name="email" class="form-control" value="{{ $staff->email }}">
            @if($errors->has('email'))
                <span class="text-danger">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="simpleinput">UserName</label>
            <input type="text" id="simpleinput" class="form-control" name="username" value="{{ $staff->username }}">
            @if($errors->has('username'))
                <span class="text-danger">
                    {{ $errors->first('username') }}
                </span>
            @endif
        </div>
        <select class="custom-select mb-3" name="roles_id">
            <option selected disabled> Role</option>
            @foreach($name_role as $i)
                <option value="{{ $i->id }}"
                        @if($i->id === $staff->roles_id)
                            selected
                        @endif>
                    {{ $i->name}}
                </option>
            @endforeach
        </select>
        @if($errors->has('roles_id'))
            <span class="text-danger">
                    {{ $errors->first('roles_id') }}
                </span>
        @endif
        <br>

        <button class="btn btn-success ">Update</button>
    </form>
    <script>
        function chooseFile(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
