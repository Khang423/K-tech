@extends('layout_admin.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Notification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn chắc chắn muốn xóa sản phẩm này?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"> No, cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn"> Yes, I'm sure</button>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-success mb-2" href="{{ route('product.create') }}">Thêm sản phẩm</a>
            <div class="form-group">
                <select name="" id="select-name"></select>
            </div>
            <table class="table table-hover table-centered" id="table-index" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh </th>
                        <th>Giá</th>
                        <th>Created_at</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <style>
    </style>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            // gọi api select2
            $("#select-name").select2({
                ajax: {
                    url: "{{ route('product.api.name') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                },
                placeholder: 'Search for a name'
            });
            // gọi api datatable

            let table = $('#table-index').DataTable({
                processing: true,
                serverSide: true,
                scrollY: true,
                autoWith: true,
                autoHeight: true,
                dom: 'Blrtip',
                select: true,
                language: {
                    lengthMenu: '_MENU_'
                },
                lengthMenu: [
                    [5, 15, 25, 100, -1],
                    [5, 15, 25, 100, "All"]
                ],
                buttons: [{
                        extend: 'copyHtml5',
                    },
                    {
                        extend: 'csvHtml5',
                    },
                    {
                        extend: 'pdfHtml5',
                    },
                    {
                        extend: 'excelHtml5',
                    },
                    {
                        extend: 'print',
                    },
                    {
                        extend: 'colvis',
                        text: 'Show/Hide'
                    },
                ],
                ajax: "{{ route('product.api') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'outsite_image',
                        targets: 3,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<img src="{{ asset('storage') }}/${data}" style="width: 100px; height:100px;">`;
                        }
                    },
                    //           {data: 'quantity', name: 'quantity'},
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'edit',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<a class="btn btn-success" href="${data}">
                                <i class="uil-edit" style="font-size:20px"></i>
                            </a>`;
                        }
                    },
                    @if (session()->get('role_id') === 1)
                        {
                            data: 'destroy',
                            targets: 7,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return `<form action="${data}" method="post">
                                        @csrf
                            @method('DELETE')
                            <button class="btn-delete btn btn-danger" class="btn_delete" type="button" ">
                            <i class="uil-trash-alt" style="font-size:20px"></i>
                            </button>
                        </form>`;
                            }
                        },
                    @endif
                ]
            });

            $('#select-name').change(function() {
                table.column(0).search(this.value).draw();
            });


            // xử lý event click button delete
            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                let deleteUrl = form.attr('action');
                let confirmDeleteModal = $('#confirmDeleteModal');
                let confirmDeleteBtn = confirmDeleteModal.find('#confirmDeleteBtn');

                confirmDeleteModal.modal('show');
                confirmDeleteBtn.click(function() {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize(),
                        success: function() {
                            console.log("success");
                            table.draw();
                            $('.modal-success').show();
                            $('.error').css({
                                'border': '2px solid black',
                                'background': 'red'
                            });
                            confirmDeleteModal.modal(
                            'hide'); // Ẩn modal sau khi xóa thành công
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        });
    </script>
@endpush
