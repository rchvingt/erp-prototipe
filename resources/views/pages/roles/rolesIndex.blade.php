@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">Roles List</h4>

        <p class="mb-6">A role provided access to predefined menus and features so that depending on assigned role an
            administrator can have access to what user needs.</p>
        @include('alert')
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
                                    <a href="{{ route('roles.edit', $row->id) }}"><span>Edit Role</span></a>
                                </div>

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
                                <a href="{{ route('roles.create') }}"
                                    class="mb-4 btn btn-sm btn-primary text-nowrap add-new-role">Tambah Role Baru</a>
                                <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
