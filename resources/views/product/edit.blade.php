@extends('layout_admin.master')
@push('css')
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <style>
        #image {
            border: 3px dashed #5BBCFF;
            border-radius: 5px;
            background: #daeffe;
            width: 250px;
            height: 200px;
        }

    </style>
    <form action="{{ route('product.update',$product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            {{-- product --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <h4 class="text-muted font-weight-normal mt-0" title="Number of Customers">Product</h4>
                            <div class="form-group">
                                <label>Name</label>
                                <textarea name="name" class="form-control" rows="3">{{$product->name}}</textarea>
                                <span class="error-name text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" value="{{$product->price}}">
                                <span class="error-mail text-danger"></span>
                            </div>
                            <div class="form-group">
                                <select class="custom-select mb-2 mt-2" name="category_id">
                                    <option selected disabled>Category</option>
                                    @foreach($category as $i)
                                        <option value="{{ $i->id }}"
                                                @if($i->id === $product->category_id) selected @endif>
                                            {{$i->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="custom-select mb-3" name="brand_id">
                                    <option selected disabled>Brand</option>
                                    @foreach($brand as $i)
                                        <option value="{{ $i->id }}"
                                                @if($i->id === $product->brand_id) selected @endif>
                                            {{ $i->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Describe </label>
                                <textarea id="summernote-basic" name="describe">
                                            {{ $productDetail->describe }}
                                </textarea>

                            </div>
                            <div class="form-group mt-2">
                                <label>Outsite Image</label>
                                <div>
                                    <img src="{{ asset('storage/'.$product->outsite_image)}}" id="image">
                                    <input type="file" name="outsite_image_new" id="img-file" onchange="chooseFile(this)">
                                    <input type="hidden" name="outsite_image" value="{{$product->outsite_image}}" onchange="chooseFile(this)">
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>Image</label>
                                <div>
                                    @foreach($image as $i)
                                        <img src="{{ asset('storage/'.$i->image) }}" id="image">
                                        <input type="hidden" value="{{ $i->image }}" name="image[]" readonly>
                                        <input type="hidden" value="{{ $i->id }}" name="id[]" readonly>
                                        <input type="file" name="image_new[]" multiple>
                                    @endforeach
                                        <input type="file" name="outsite_image_new" id="img-file" onchange="chooseFile(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <h4 class="text-muted font-weight-normal mt-0" title="Number of Customers">
                                Specification</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <div class="form-group">
                                                    <label>Graphic card</label>
                                                    <textarea name="graphic_card" class="form-control" rows="3">
                                                            {{ $productDetail->graphic_card }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>SSD</label>
                                                    <textarea name="ssd" class="form-control" rows="3">
                                                                {{ $productDetail->ssd }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>TouchScreen</label>
                                                    <textarea name="touchscreen" class="form-control" rows=3">
                                                                {{ $productDetail->touchscreen }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Background Plate</label>
                                                    <textarea name="bg_plate" class="form-control" rows="3">
                                                                {{ $productDetail->bg_plate }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Scanning frequency</label>
                                                    <textarea name="scan_frequency" class="form-control" rows="3">
                                                                {{ $productDetail->scan_frequency }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Screen size</label>
                                                    <textarea name="screen_size" class="form-control" rows="3">

                                                                {{ $productDetail->screen_size }}

                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Screen Technolory</label>
                                                    <textarea name="screen_tech" class="form-control" rows="3">
                                                                {{ $productDetail->screen_tech }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Screen resolution</label>
                                                    <textarea name="screen_resolution" class="form-control" rows="3">
                                                                {{ $productDetail->screen_resolution }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight</label>
                                                    <textarea name="weight" class="form-control" rows="3">
                                                                {{ $productDetail->weight }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dimension</label>
                                                    <textarea name="dimension" class="form-control" rows="3">
                                                                {{ $productDetail->dimension }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Color</label>
                                                    <textarea name="color" class="form-control" rows="3">
                                                                {{ $productDetail->color }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Material</label>
                                                    <textarea name="material" class="form-control" rows="3">
                                                                {{ $productDetail->material }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Release </label>
                                                    <textarea name="release_date" class="form-control" rows="3">
                                                                {{ $productDetail->release_date }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-left">
                                                <div class="form-group">
                                                    <label>CPU</label>
                                                    <textarea name="cpu" class="form-control" rows="3">
                                                                {{$productDetail->cpu }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>RAM</label>
                                                    <textarea name="ram" class="form-control" rows="3">
                                                                {{$productDetail->ram }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ram type</label>
                                                    <textarea name="ram_type" class="form-control" rows="3">
                                                                {{$productDetail->ram_type }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ram slot</label>
                                                    <textarea name="ram_slot" class="form-control" rows="3">
                                                                {{$productDetail->ram_slot }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keyboard light</label>
                                                    <textarea name="keyboard_light" class="form-control"
                                                              rows="3">
                                                                {{$productDetail->keyboard_light }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Webcam</label>
                                                    <textarea name="webcam" class="form-control" rows="3">
                                                                {{$productDetail->webcam }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Operating system</label>
                                                    <textarea name="operating_system" class="form-control" rows="3">
                                                                {{$productDetail->operating_system }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bluetooth</label>
                                                    <textarea name="bluetooth" class="form-control" rows="3">
                                                                {{$productDetail->bluetooth }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Wifi</label>
                                                    <textarea name="wifi" class="form-control" rows="3">
                                                                {{$productDetail->wifi }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Audio technolory</label>
                                                    <textarea name="audio_tech" class="form-control" rows="3">
                                                                {{$productDetail->audio_tech }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Security</label>
                                                    <textarea name="security" class="form-control" rows="3">
                                                                {{$productDetail->security }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Connectivity</label>
                                                    <textarea name="connectivity" class="form-control" rows="4">
                                                                {{$productDetail->connectivity }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Battery</label>
                                                    <textarea name="battery" class="form-control" rows="3">
                                                                {{$productDetail->battery }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cooling system</label>
                                                    <textarea name="cooling_system" class="form-control" rows="3">
                                                                {{ $productDetail->cooling_system }}
                                                    </textarea>
                                                    <span class="error-name text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success" id="btn-create" type="button">Update</button>
                <a class="btn btn-primary" href="{{ route('product.index') }}"> Prev </a>
            </div>
        </div>
    </form>
    @push('js')
        <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/demo.summernote.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(document).on('click', '#btn-create', function () {
                    let form = $(this).parents('form');
                    let createUrl = form.attr('action');
                    let formData = new FormData(form[0]);
                    $.ajax({
                        url: createUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: formData, "_token": "{{ csrf_token() }}",
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log("success");
                            location.href = "{{ route('product.index') }}";
                        },
                        error: function (data) {
                            console.log(data);
                            let errorName = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : '';
                            $('.error-name').text(errorName);
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
