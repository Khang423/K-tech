@extends('layout_admin.master')
@push('css')
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <style>
        #image {
            border: 3px dashed #5BBCFF;
            border-radius: 15px;
            background: #daeffe;
            width: 200px;
            height: 200px;
        }

        #div_right {
            margin-left: -50px;
        }

    </style>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- product --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <h4 class="text-muted font-weight-normal text-uppercase mt-0" title="Number of Customers">
                                Thông tin sản phẩm</h4>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <textarea name="name" class="form-control" rows="4"></textarea>
                                <span class="error-name text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Giá </label>
                                <input type="number" name="price" class="form-control">
                                <span class="error-price text-danger"></span>
                            </div>
                            <div class="form-group">
                                <select class="custom-select mb-3" name="category_id">
                                    <option selected disabled hidden>Loại Laptop</option>
                                    @foreach($category as $i)
                                        <option value="{{ $i->id }} ">
                                            {{ $i->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="error-category_id text-danger"></span>
                            </div>

                            <div class="form-group">
                                <select class="custom-select mb-3" name="brand_id">
                                    <option selected disabled hidden>Thương hiệu</option>
                                    @foreach($brand as $i)
                                        <option value="{{ $i->id }} ">
                                            {{ $i->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="error-brand_id text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea id="summernote-basic" name="describe"></textarea>
                                <span class="error-describe text-danger"></span>
                            </div>
                            <div class="form-group mt-2">
                                <label>Ảnh Chính</label>
                                <div>
                                    <img src="{{ asset('image')}}/upload.png" id="image">
                                    <input type="file" name="outsite_image" id="img-file" onchange="chooseFile(this)">
                                </div>
                                <span class="error-outsite_image text-danger"></span>
                            </div>

                            <div class="form-group mt-2">
                                <label>Ảnh phụ</label>
                                <div>
                                    <input type="file" name="image[]" multiple>
                                    <span class="error-image text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            // div right--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <h4 class="text-muted font-weight-normal text-uppercase mt-0" title="Number of Customers">
                                Thông số kĩ thuật
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Card đồ họa</label>
                                        <textarea name="graphic_card" class="form-control" rows="4"
                                        cols="100"></textarea>
                                        <span class="error-graphic_card text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CPU</label>
                                        <textarea name="cpu" class="form-control" rows="4"></textarea>
                                        <span class="error-cpu text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ổ cứng</label>
                                        <textarea name="ssd" class="form-control" rows="4"></textarea>
                                        <span class="error-ssd text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Màn hình cảm ứng</label>
                                        <textarea name="touchscreen" class="form-control" rows="4"></textarea>
                                        <span class="error-touchscreen text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Tấm nền </label>
                                        <textarea name="bg_plate" class="form-control" rows="4"></textarea>
                                        <span class="error-bg_plate text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tấn số quét</label>
                                        <textarea name="scan_frequency" class="form-control" rows="4"></textarea>
                                        <span class="error-scan_frequency text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kích thươc màn hình</label>
                                        <textarea name="screen_size" class="form-control" rows="4"></textarea>
                                        <span class="error-screen_size text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Công nghệ màn hình</label>
                                        <textarea name="screen_tech" class="form-control" rows="4"></textarea>
                                        <span class="error-screen_tech text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Độ phân giải màn hình</label>
                                        <textarea name="screen_resolution" class="form-control" rows="4"></textarea>
                                        <span class="error-screen_resolution text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trọng lượng</label>
                                        <textarea name="weight" class="form-control" rows="4"></textarea>
                                        <span class="error-weight text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kích thước</label>
                                        <textarea name="dimension" class="form-control" rows="4"></textarea>
                                        <span class="error-dimension text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Màu sắc</label>
                                        <textarea name="color" class="form-control" rows="4"></textarea>
                                        <span class="error-color text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chất liệu</label>
                                        <textarea name="material" class="form-control" rows="4"></textarea>
                                        <span class="error-material text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hệ thống làm mát</label>
                                        <textarea name="cooling_system" class="form-control" rows="4"></textarea>
                                        <span class="error-cooling_system text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Wifi</label>
                                        <textarea name="wifi" class="form-control" rows="4"
                                        cols="100"></textarea>
                                        <span class="error-wifi text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>RAM</label>
                                        <textarea name="ram" class="form-control" rows="4"></textarea>
                                        <span class="error-ram text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Loại Ram</label>
                                        <textarea name="ram_type" class="form-control" rows="4"></textarea>
                                        <span class="error-ram_type text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số khe Ram</label>
                                        <textarea name="ram_slot" class="form-control" rows="4"></textarea>
                                        <span class="error-ram_slot text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bàn Phím</label>
                                        <textarea name="keyboard_light" class="form-control" rows="4"></textarea>
                                        <span class="error-keyboard_light text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Webcam</label>
                                        <textarea name="webcam" class="form-control" rows="4"></textarea>
                                        <span class="error-webcam text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hệ điều hành</label>
                                        <textarea name="operating_system" class="form-control" rows="4"></textarea>
                                        <span class="error-operating_system text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bluetooth</label>
                                        <textarea name="bluetooth" class="form-control" rows="4"></textarea>
                                        <span class="error-bluetooth text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hệ điều hành</label>
                                        <textarea name="operating_system" class="form-control" rows="4"></textarea>
                                        <span class="error-operating_system text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Công nghệ âm thanh</label>
                                        <textarea name="audio_tech" class="form-control" rows="4"></textarea>
                                        <span class="error-audio_tech text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bảo mật</label>
                                        <textarea name="security" class="form-control" rows="4"></textarea>
                                        <span class="error-security text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Các kết nối</label>
                                        <textarea name="connectivity" class="form-control" rows="4"></textarea>
                                        <span class="error-connectivity text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pin</label>
                                        <textarea name="battery" class="form-control" rows="4"></textarea>
                                        <span class="error-battery text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày phát hành</label>
                                        <textarea name="release_date" class="form-control" rows="4"></textarea>
                                        <span class="error-release_date text-danger"></span>
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
                <button class="btn btn-success" id="btn-create" type="button">Create</button>
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
                            let errorprice = data.responseJSON.errors.price ? data.responseJSON.errors.price[0] : '';
                            $('.error-price').text(errorprice);
                            let errorcategory = data.responseJSON.errors.category_id ? data.responseJSON.errors.category_id[0] : '';
                            $('.error-category_id').text(errorcategory);
                            let errorbrand = data.responseJSON.errors.brand_id ? data.responseJSON.errors.brand_id[0] : '';
                            $('.error-brand_id').text(errorbrand);
                            let describe = data.responseJSON.errors.describe ? data.responseJSON.errors.describe[0] : '';
                            $('.error-describe').text(describe);
                            let outsite_image = data.responseJSON.errors.outsite_image ? data.responseJSON.errors.outsite_image[0] : '';
                            $('.error-outsite_image').text(outsite_image);
                            let image = data.responseJSON.errors.image ? data.responseJSON.errors.image[0] : '';
                            $('.error-image').text(image);
                            let graphic_card = data.responseJSON.errors.graphic_card ? data.responseJSON.errors.graphic_card[0] : '';
                            $('.error-graphic_card').text(graphic_card);
                            let cpu = data.responseJSON.errors.cpu ? data.responseJSON.errors.cpu[0] : '';
                            $('.error-cpu').text(cpu);
                            let ram = data.responseJSON.errors.ram ? data.responseJSON.errors.ram[0] : '';
                            $('.error-ram').text(ram);
                            let ram_type = data.responseJSON.errors.ram_type ? data.responseJSON.errors.ram_type[0] : '';
                            $('.error-ram_type').text(ram_type);
                            let ram_slot = data.responseJSON.errors.ram_slot ? data.responseJSON.errors.ram_slot[0] : '';
                            $('.error-ram_slot').text(ram_slot);
                            let ssd = data.responseJSON.errors.ssd ? data.responseJSON.errors.ssd[0] : '';
                            $('.error-ssd').text(ssd);
                            let touchscreen = data.responseJSON.errors.touchscreen ? data.responseJSON.errors.touchscreen[0] : '';
                            $('.error-touchscreen').text(touchscreen);
                            let bg_plate = data.responseJSON.errors.bg_plate ? data.responseJSON.errors.bg_plate[0] : '';
                            $('.error-bg_plate').text(bg_plate);
                            let scan_frequency = data.responseJSON.errors.scan_frequency ? data.responseJSON.errors.scan_frequency[0] : '';
                            $('.error-scan_frequency').text(scan_frequency);
                            let screen_size = data.responseJSON.errors.screen_size ? data.responseJSON.errors.screen_size[0] : '';
                            $('.error-screen_size').text(screen_size);
                            let screen_tech = data.responseJSON.errors.screen_tech ? data.responseJSON.errors.screen_tech[0] : '';
                            $('.error-screen_tech').text(screen_tech);
                            let screen_resolution = data.responseJSON.errors.screen_resolution ? data.responseJSON.errors.screen_resolution[0] : '';
                            $('.error-screen_resolution').text(screen_resolution);
                            let keyboard_light = data.responseJSON.errors.keyboard_light ? data.responseJSON.errors.keyboard_light[0] : '';
                            $('.error-keyboard_light').text(keyboard_light);
                            let webcam = data.responseJSON.errors.webcam ? data.responseJSON.errors.webcam[0] : '';
                            $('.error-webcam').text(webcam);
                            let operating_system = data.responseJSON.errors.operating_system ? data.responseJSON.errors.operating_system[0] : '';
                            $('.error-operating_system').text(operating_system);
                            let bluetooth = data.responseJSON.errors.bluetooth ? data.responseJSON.errors.bluetooth[0] : '';
                            $('.error-bluetooth').text(bluetooth);
                            let wifi = data.responseJSON.errors.wifi ? data.responseJSON.errors.wifi[0] : '';
                            $('.error-wifi').text(wifi);
                            let audio_tech = data.responseJSON.errors.audio_tech ? data.responseJSON.errors.audio_tech[0] : '';
                            $('.error-audio_tech').text(audio_tech);
                            let security = data.responseJSON.errors.security ? data.responseJSON.errors.security[0] : '';
                            $('.error-security').text(security);
                            let connectivity = data.responseJSON.errors.connectivity ? data.responseJSON.errors.connectivity[0] : '';
                            $('.error-connectivity').text(connectivity);
                            let weight = data.responseJSON.errors.weight ? data.responseJSON.errors.weight[0] : '';
                            $('.error-weight').text(weight);
                            let battery = data.responseJSON.errors.battery ? data.responseJSON.errors.battery[0] : '';
                            $('.error-battery').text(battery);
                            let cooling_system = data.responseJSON.errors.cooling_system ? data.responseJSON.errors.cooling_system[0] : '';
                            $('.error-cooling_system').text(cooling_system);
                            let color = data.responseJSON.errors.color ? data.responseJSON.errors.color[0] : '';
                            $('.error-color').text(color);
                            let material = data.responseJSON.errors.material ? data.responseJSON.errors.material[0] : '';
                            $('.error-material').text(material);
                            let dimension = data.responseJSON.errors.dimension ? data.responseJSON.errors.dimension[0] : '';
                            $('.error-dimension').text(dimension);
                            let release_date = data.responseJSON.errors.release_date ? data.responseJSON.errors.release_date[0] : '';
                            $('.error-release_date').text(release_date);
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
