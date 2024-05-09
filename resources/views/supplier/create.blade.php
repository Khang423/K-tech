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
    <form action="{{ route('supplier.store') }}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-weight-normal mt-0" title="Number of Customers">
                            Supplier Info</h3>
                        @csrf
                        {{--name--}}
                        <div class="form-group">
                            <label>Name</label>
                            <textarea name="name" class="form-control"></textarea>
                            <span class="error-name text-danger"></span>
                        </div>
                        {{--phone--}}
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" placeholder="Enter your phone number" class="form-control">
                            <span class="error-phone text-danger"></span>
                        </div>
                        {{-- email--}}
                        <div class="form-group">
                            <label>Email</label>
                            <textarea name="email" class="form-control"></textarea>
                            <span class="error-mail text-danger"></span>
                        </div>
                        {{--address--}}
                        <div class="form-group">
                            <label for="simpleinput">Address</label>
                            <textarea name="address" class="form-control"></textarea>
                            <span class="error-address text-danger"></span>
                        </div>
                        {{--city--}}
                        <div class="form-group">
                            <select name="city_id" class="form-control select2" data-toggle="select2" id="city"
                                    required>
                                <option disabled selected hidden>--Tỉnh/Thành Phố--</option>
                                @foreach($city_name as $i)
                                    <option value="{{$i->id}}">
                                        {{$i->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{--district--}}
                        <div class="form-group">
                            <select name="district_id" class="district form-control select2" data-toggle="select2"
                                    required>
                                <option disabled selected hidden>--Quận/Huyện--</option>
                            </select>
                        </div>
                        {{--ward--}}
                        <div class="form-group">
                            <select name="wards_id" class="form-control select2" data-toggle="select2" id="ward"
                                    required>
                                <option disabled selected hidden>--Xã/Phường--</option>
                            </select>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success" id="btn-create" type="button">Create</button>
                            <a class="btn btn-primary" href="{{ route('supplier.index') }}"> Prev </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
        <script>
            $(document).ready(function () {
                // event select district
                $('#city').change(function () {
                    let city_id = $(this).val();
                    $.ajax({
                        url: '{{ route('districts.loadDistrict') }}',
                        type: "POST",
                        data: {city_id: city_id, _token: '{{ csrf_token() }}'},
                        success: function (data) {
                            console.log('success');
                            $('.district').empty();
                            $.each(data, function (index, item) {
                                if (index === 0) {
                                    $('.district').append(
                                        $('<option>', {
                                            text: '--Quận/Huyện--'
                                        })
                                    );
                                }
                                $('.district').append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                            $(".district option:first").attr("disabled", "true").attr("selected", "true");
                        },
                        error: function (data) {
                            console.log('error');
                        },

                    });
                });
                // event select ward
                $('.district').change(function () {
                    let district_id = $(this).val();
                    $.ajax({
                        url: '{{ route('ward.loadWard') }}',
                        type: "POST",
                        data: {district_id: district_id, _token: '{{ csrf_token() }}'},
                        success: function (data) {
                            console.log('success');
                            $('#ward').empty();
                            $.each(data, function (index, item) {
                                if (index === 0) {
                                    $('#ward').append(
                                        $('<option>', {
                                            text: '--Xã/Phường--'
                                        })
                                    );
                                }
                                $('#ward').append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.name
                                    })
                                );
                            });
                            $("#ward option:first").attr("disabled", "true").attr("selected", "true");
                        },
                        error: function (data) {
                            console.log('error');
                        },

                    });
                });
                // even click btn create
                $(document).on('click', '#btn-create', function () {
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
                            location.href = "{{ route('supplier.index') }}";
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
