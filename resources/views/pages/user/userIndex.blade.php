@extends('layouts.home')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            // Ubah action form delete sesuai dengan id user yang akan dihapus
            var url = '/user/' + id;
            document.getElementById('deleteForm').action = url;

            // Tampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        }
    </script>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Responsive Table -->
        @include('alert')
        <div class="card">
            <div class="card-datatable table-responsive">
                <div class="table-responsive text-nowrap">
                    <table class="table datatables-user border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>USER</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @forelse ($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>

                                    <td>


                                        @if ($row->roles->isNotEmpty())
                                            @foreach ($row->roles as $role)
                                                <span class="text-truncate d-flex align-items-center text-heading"><i
                                                        class="bx bx-user text-success me-2"></i>{{ $role->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="p-0 btn dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route('user.edit', $row->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item text-danger"
                                                    onclick="confirmDelete({{ $row->id }})">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td colspan="4">No result found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
{{-- if you need some js --}}
@push('scriptjs')
    <script>
        $(document).ready(function() {
            $('.datatables-user').dataTable({
                dom: '<"card-header flex-column flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-end pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    paginate: {
                        next: '<i class="bx bx-chevron-right bx-18px"></i>',
                        previous: '<i class="bx bx-chevron-left bx-18px"></i>'
                    }
                },
                buttons: [{
                    extend: "collection",
                    className: "btn btn-secondary dropdown-toggle me-4",
                    text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [{
                        extend: "print",
                        text: '<i class="bx bx-printer me-1" ></i>Print',
                        className: "dropdown-item",
                        customize: function(e) {
                            $(e.document.body).css("color", config.colors.headingColor)
                                .css("border-color", config.colors.borderColor).css(
                                    "background-color", config.colors.bodyBg), $(e
                                    .document.body).find("table").addClass("compact")
                                .css("color", "inherit").css("border-color", "inherit")
                                .css("background-color", "inherit")
                        }
                    }, {
                        extend: "csv",
                        text: '<i class="bx bx-file me-1" ></i>Csv',
                        className: "dropdown-item",

                    }, {
                        extend: "excel",
                        text: '<i class="bx bxs-file-export me-1"></i>Excel',
                        className: "dropdown-item",

                    }, {
                        extend: "pdf",
                        text: '<i class="bx bxs-file-pdf me-1"></i>Pdf',
                        className: "dropdown-item",

                    }, {
                        extend: "copy",
                        text: '<i class="bx bx-copy me-1" ></i>Copy',
                        className: "dropdown-item",

                    }]
                }, {
                    text: '<i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah User Baru</span>',
                    className: "create-new btn btn-primary",
                    action: function(e, dt, button, config) {
                        window.location = '{{ route('user.create') }}';
                    }
                }],

            }), $("div.head-label").html('<h5 class="mb-0 card-title">Users</h5>'), $(
                ".dt-buttons > .btn-group > button");

        });
    </script>
@endpush
