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

        .btn {
            width: 100px;
            height: 40px;
        }
    </style>
    <form action="{{ route('warehouse.update',$warehouse) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-muted font-weight-normal mt-0" title="Number of Customers">
                            Info
                        </h4>
                        @csrf
                        @method('put')
                        {{--name--}}
                        <div class="form-group">
                            <label>Product</label>
                            <select class="custom-select mb-1 select2" name="product_id" >
                                @foreach($product as $i)
                                    <option value="{{ $i->id }}"
                                            @if($i->id === $warehouse->product_id) selected @endif>
                                        {{ $i->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="custom-select mb-1 select2" name="supplier_id" >
                                @foreach($supplier as $i)
                                    <option value="{{ $i->id }}"
                                            @if($i->id === $warehouse->product_id) selected @endif>
                                        {{ $i->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="stock_quantity" value="{{$warehouse->stock_quantity}}">
                            <span class="error-mail text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{$warehouse->price}}">
                            <span class="error-mail text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <textarea class="form-control" name="name" rows="3">{{$warehouse->name}} </textarea>
                            <span class="error-mail text-danger"></span>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success" id="btn-update" type="button">Update</button>
                            <a class="btn btn-primary" href="{{ route('warehouse.index') }}"> Prev </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
        <script>
            $(document).ready(function () {
                // even click btn create
                $(document).on('click', '#btn-update', function () {
                    let form = $(this).parents('form');
                    let createUrl = form.attr('action');
                    let formData = new FormData(form[0]);

                    $.ajax({
                        url: createUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log("success");
                            location.href = "{{ route('warehouse.index') }}";
                        },
                        error: function (data) {
                            console.log(data);
                            let errorName = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : '';
                            $('.error-name').text(errorName);
                            let errorPhone = data.responseJSON.errors.phone ? data.responseJSON.errors.phone[0] : '';
                            $('.error-phone').text(errorPhone);
                            let errorMail = data.responseJSON.errors.email ? data.responseJSON.errors.email[0] : '';
                            $('.error-mail').text(errorMail);
                            let erroraddress = data.responseJSON.errors.address ? data.responseJSON.errors.address[0] : '';
                            $('.error-address').text(erroraddress);
                        }
                    });
                });


            });


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
    @endpush

@endsection
