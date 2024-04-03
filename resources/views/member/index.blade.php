@extends('layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <a class="btn btn-success mb-2" href="{{ route('members.create') }}">
                Add
            </a>
            <div class="form-group">
                <select name="" id="select-name"></select>
            </div>
            <table class="table table-striped" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
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
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.2/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.0/rg-1.5.0/sc-2.4.1/sb-1.7.0/sl-2.0.0/datatables.min.js">
    </script>
    <script>
        $(document).ready(function () {
            $("#select-name").select2({
                ajax: {
                    url: "{{ route('members.api.name') }}",
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

            let table = $('#table-index').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blrtip',
                select: true,
                language: {
                    lengthMenu: '_MENU_'
                },
                lengthMenu: [[1, 5, 15, 25, 100, -1], [1, 5, 15, 25, 100, "All"]],
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
                ajax: "{{ route('members.api') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'roles_id',
                        name: 'roles_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {{--{--}}
                    {{--    data: 'course_name',--}}
                    {{--    name: 'course_name'--}}
                    {{--},--}}

                    {{--{--}}
                    {{--    data: 'edit',--}}
                    {{--    targets: 3,--}}
                    {{--    orderable: false,--}}
                    {{--    searchable: false,--}}
                    {{--    render: function(data) {--}}
                    {{--        return `<a class="btn btn-success" href="${data}">--}}
                    {{--            Edit--}}
                    {{--        </a>`;--}}
                    {{--    }--}}
                    {{--},--}}
                    {{--{--}}
                    {{--    data: 'destroy',--}}
                    {{--    targets: 4,--}}
                    {{--    orderable: false,--}}
                    {{--    searchable: false,--}}
                    {{--    render: function(data, type, row, meta) {--}}
                    {{--        return `<form action="${data}" method="post">--}}
                    {{--            @csrf--}}
                    {{--        @method('DELETE')--}}
                    {{--        <button class="btn-delete btn btn-danger">Delete</button>--}}
                    {{--    </form>`;--}}
                    {{--    }--}}
                    {{--},--}}
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
