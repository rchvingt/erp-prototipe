@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                @include('alert')
                <div class="mb-6 card">
                    <div class="card-header d-flex flex-column justify-content-center">
                        <h5 class="mb-0">Form Tambah Role Baru</h5>
                        <p>Set role permissions</p>
                    </div>
                    <div class="card-body">

                        <!-- Add role form -->
                        <form class="row g-6" method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <input type="hidden" id="method" name="_method" value="POST">

                            <div class="col-12">
                                <label class="form-label" for="name="name"">Role Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter a role name" tabindex="-1" required autofocus />
                            </div>
                            <div class="col-12">
                                <h5 class="mb-6">Role Permissions</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table mb-0 table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium text-heading">Administrator Access <i
                                                        class="bx bx-info-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mb-0 form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkPermissionAll" value="1" />
                                                            <label class="form-check-label" for="checkPermissionAll">
                                                                Select All
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach ($permissions as $group => $groupPermissions)
                                                <tr class="permission-group">
                                                    <td class="text-nowrap fw-medium text-heading">
                                                        <div class="form-check">
                                                            <input type="checkbox"
                                                                id="checkAll{{ str_replace(' ', '-', $group) }}"
                                                                class="form-check-input checkAll"
                                                                data-group="{{ str_replace(' ', '-', $group) }}">
                                                            <label class="form-check-label"
                                                                for="checkAll{{ str_replace(' ', '-', $group) }}">{{ ucfirst($group) }}</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex-row">
                                                            @foreach ($groupPermissions as $permission)
                                                                <div class="mb-0 form-check me-4 me-lg-12">
                                                                    <input type="checkbox" name="permissions[]"
                                                                        class="form-check-input permission-{{ str_replace(' ', '-', $group) }}"
                                                                        value="{{ $permission->id }}">
                                                                    <label
                                                                        class="form-check-label">{{ ucfirst($permission->name) }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="text-left col-12">
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-label-secondary">Batal</a>

                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
            <!--/ class="col-xl" -->
        </div>
        <!--/ class="row" -->
    </div>
@endsection
{{-- if you need some js --}}
@push('scriptjs')
    @include('pages.roles.partials.scripts')
@endpush
