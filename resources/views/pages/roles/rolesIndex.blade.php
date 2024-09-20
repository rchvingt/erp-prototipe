@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">Roles List</h4>

        <p class="mb-6">A role provided access to predefined menus and features so that depending on assigned role an
            administrator can have access to what user needs.</p>
        <!-- Role cards -->
        <div class="row g-6">
            @forelse ($roles as $row)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-normal text-body">Total {{ $row->users->count() }} users</h6>

                                <ul class="mb-0 list-unstyled d-flex align-items-center avatar-group">
                                    @foreach ($row->users as $user)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar pull-up" aria-label="{{ $user->name }}"
                                            data-bs-original-title="{{ $user->name }}">
                                            <!-- Menampilkan avatar user -->
                                            <img class="rounded-circle"
                                                src="{{ $user->avatar_url ?? asset('assets/img/avatars/5.png') }}"
                                                alt="{{ $user->name }}'s avatar">

                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h5 class="mb-1">{{ $row->name }}</h5>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                        class="role-edit-modal"><span>Edit Role</span></a>
                                </div>
                                <a href="javascript:void(0);"><i class="bx bx-copy bx-md text-muted"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td></td>
                    <td colspan="4">No result found</td>
                </tr>
            @endforelse




            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="mt-4 d-flex align-items-end h-100 justify-content-center mt-sm-0 ps-6">
                                <img src="{{ asset('assets/img/illustrations/lady-with-laptop-light.png') }}"
                                    class="img-fluid" alt="Image" width="120"
                                    data-app-light-img="{{ asset('assets/img/illustrations/lady-with-laptop-light.png') }}"
                                    data-app-dark-img="{{ asset('assets/img/illustrations/lady-with-laptop-dark.png') }}">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="text-center card-body text-sm-end ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="mb-4 btn btn-sm btn-primary text-nowrap add-new-role">Add New Role</button>
                                <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/ Role cards -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="position: absolute;top: 0.5rem;right: 0.5rem;"></button>
                        <div class="mb-6 text-center">
                            <h4 class="mb-2 role-title">Add New Role</h4>
                            <p>Set role permissions</p>
                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-6" onsubmit="return false">
                            <div class="col-12">
                                <label class="form-label" for="modalRoleName">Role Name</label>
                                <input type="text" id="modalRoleName" name="modalRoleName" class="form-control"
                                    placeholder="Enter a role name" tabindex="-1" />
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
                                                        title="Allows a full access to the system"></i></td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mb-0 form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="selectAll" />
                                                            <label class="form-check-label" for="selectAll">
                                                                Select All
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i = 1; @endphp
                                            @foreach ($permissions as $groupName => $permissionGroup)
                                                <tr>
                                                    <td class="text-nowrap fw-medium text-heading">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="{{ $i }}Management"
                                                                value="{{ $groupName }}"
                                                                onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                            <label class="form-check-label"
                                                                for="checkPermission">{{ $groupName }}</label>
                                                        </div>
                                                    </td>
                                                    <td>

                                                        <div class="d-flex-row">
                                                            @foreach ($permissionGroup as $permission)
                                                                <div class="mb-0 form-check me-4 me-lg-12">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="userManagementRead" />
                                                                    <label class="form-check-label"
                                                                        for="userManagementRead">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php  $i++; @endphp
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="text-center col-12">
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- if you need some js --}}
@push('scriptjs')
    <script></script>
@endpush
