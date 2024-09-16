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
                    Are you sure you want to delete this data?
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
            // Ubah action form delete sesuai dengan id_material yang akan dihapus
            var url = '/master/ref-supplier/' + id;
            document.getElementById('deleteForm').action = url;

            // Tampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        }
    </script>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Responsive Table -->
        <div class="card">
            {{-- <h5 class="card-header">Users</h5> --}}
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Daftar Supplier</h5>
                <a href="{{ route('ref-supplier.create') }}" class="btn btn-primary">Tambah Supplier</a>
            </div>
            @include('alert')
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Supplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($supp as $row)
                            <tr>
                                <td>{{ $no++ }}.</td>
                                <td>{{ $row->nama_supplier }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->telepon }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="p-0 btn dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item"
                                                href="{{ route('ref-supplier.edit', $row->id_supplier) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item" onclick="confirmDelete({{ $row->id_supplier }})">
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
@endsection
{{-- if you need some js --}}
@push('scriptjs')
    <script></script>
@endpush
