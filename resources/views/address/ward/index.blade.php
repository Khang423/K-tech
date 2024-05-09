@extends('layout_admin.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
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
                            Are you sure you want to delete this Admintor?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"> No, cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn"> Yes, I'm sure</button>
                        </div>
                    </div>
                </div>
            </div>

            <a class="btn btn-success mb-2" href="{{ route('ward.create') }}">
                Add
            </a>
            <div class="form-group">
                <select name="" id="select-name"></select>
            </div>
            <table class="table table-hover table-centered" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Edit</th>
                    @if(session()->get('role_id')===1)
                        <th>Delete</th>
                    @endif
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            // gọi api select2
            $("#select-name").select2({
                ajax: {
                    url: "{{ route('ward.api.name') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: $.map(data, function (item) {
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
                dom: 'Blrtip',
                select: true,
                language: {
                    lengthMenu: '_MENU_'
                },
                lengthMenu: [[5, 15, 25, 100, -1], [5, 15, 25, 100, "All"]],
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
                ajax: "{{ route('ward.api') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'edit',
                        targets: 9,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<a class="btn btn-success" href="${data}">
                                Edit
                            </a>`;
                        }
                    },
                        @if(session()->get('role_id')===1)
                    {
                        data: 'destroy',
                        targets: 10,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                            @method('DELETE')
                            <button class="btn-delete btn btn-danger">Delete</button>
                        </form>`;
                        }
                    },
                    @endif
                ]
            });

            $('#select-name').change(function () {
                table.column(0).search(this.value).draw();
            });

            $(document).on('click', 'btn-delete', function () {
                let form = $(this).parent('form');
                $ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    success: function () {
                        console.log("success");
                        table.draw();
                    },
                    error: function () {
                        console.log("error");
                    }
                });
            });
        });
    </script>
@endpush
