@extends('layouts.template')

@section('title')
  Staff Management
@endsection

@section('plugins-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/dataTables.bootstrap5.css')}}">
@endsection

@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Staff Management</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active">Staff</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid datatable-init">
            <div class="row">

              <!-- Tabels Staff Starts-->
              <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                      <div class="w-75">
                        <h5>Staff Management</h5>
                        <p class="f-m-light mt-1">Staff Management allows you to add, edit, and delete staff in this system.</p>
                      </div>
                      <div class="card-header-right-icon">
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".bd-staff-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add Staff</button>
                           <!-- Offcanvas Create Staff Stats--> 
                          <div class="modal fade bd-staff-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myExtraLargeModal">Add Staff</h4>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body dark-modal">
                                  <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-control" id="name" type="text" placeholder="Enter name" required name="name">
                                        <div class="invalid-feedback">Please enter a valid name.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" placeholder="Enter username" required name="username">
                                        <div class="invalid-feedback" id="username-feedback">Please enter a valid username.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" id="password" type="password" placeholder="Enter password" required name="password">
                                        <div class="invalid-feedback">Please enter a password.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="username">Whatsapp</label>
                                        <input class="form-control" id="whatsapp" type="text" placeholder="Enter whatsapp" required name="whatsapp_number">
                                        <div class="invalid-feedback" id="whatsapp-feedback">Please enter a valid whatsapp.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="role">Role</label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="" selected disabled>Select role</option>
                                            <option value="staff">Staff</option>
                                            <option value="kepala">Kepala</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a role.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="department">Department</label>
                                        <select class="form-select" id="department" name="department_id" required disabled>
                                            <option value="{{auth()->user()->staff->department_id}}" selected disabled>{{auth()->user()->staff->department->name}}</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a department.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="position">Position</label>
                                        <select class="form-select" id="position" name="position_id" required>
                                            <option value="" selected disabled>Select position</option>
                                            @foreach($positions as $position)
                                              <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a position.</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="room">Room</label>
                                        <select class="form-select" id="room" name="room_id" required disabled>
                                            <option value="{{auth()->user()->staff->room_id}}" selected disabled>{{auth()->user()->staff->room->name}}</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a room.</div>
                                    </div>
                                    
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Offcanvas Create Users Ends-->

                          <!-- Offcanvas Edit Users Stats-->
                          <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="editModalLabel">Edit User</h4>
                                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body dark-modal">
                                        <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" id="editForm">
                                            @csrf
                                            @method('PUT') <!-- Menandakan update method -->
                                            <input type="hidden" id="editUserId" name="user_id">

                                            <div class="col-md-6">
                                                <label class="form-label" for="name">Name</label>
                                                <input class="form-control" id="editName" type="text" placeholder="Enter name" required name="name">
                                                <div class="invalid-feedback">Please enter a valid name.</div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="username">Username</label>
                                                <input class="form-control" id="editUsername" type="text" placeholder="Enter username" required name="username">
                                                <div class="invalid-feedback" id="username-feedback">Please enter a valid username.</div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label" for="password">Password</label>
                                                <input class="form-control" id="editPassword" type="password" placeholder="Enter password" name="password">
                                                <div class="invalid-feedback">Please enter a password.</div>
                                            </div>
                                              <div class="col-md-4">
                                                <label class="form-label" for="username">Whatsapp</label>
                                                <input class="form-control" id="editWhatsapp" type="text" placeholder="Enter whatsapp" required name="whatsapp_number">
                                                <div class="invalid-feedback" id="whatsapp-feedback">Please enter a valid whatsapp.</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="role">Role</label>
                                                <select class="form-select" id="editRole" name="role" required>
                                                    <option value="" selected disabled>Select role</option>
                                                    <option value="staff">Staff</option>
                                                    <option value="kepala">Kepala</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a role.</div>
                                            </div>

                                           <div class="col-md-4">
                                              <label class="form-label" for="department">Department</label>
                                              <select class="form-select" id="editDepartment" name="department_id" required disabled>
                                                  <option value="{{auth()->user()->staff->department_id}}" selected disabled>{{auth()->user()->staff->department->name}}</option>
                                              </select>
                                              <div class="invalid-feedback">Please select a department.</div>
                                          </div>

                                             <div class="col-md-4">
                                                <label class="form-label" for="position">Position</label>
                                                <select class="form-select" id="editPosition" name="position_id" required>
                                                    <option value="" selected disabled>Select position</option>
                                                    @foreach($positions as $position)
                                                      <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Please select a position.</div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label" for="room">Room</label>
                                                <select class="form-select" id="editRoom" name="room_id" required disabled>
                                                    <option value="{{auth()->user()->staff->room_id}}" selected disabled>{{auth()->user()->staff->room->name}}</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a room.</div>
                                            </div>

                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <!-- Offcanvas Edit Users Ends-->

                      </div>
                    </div>
                    <!-- Positions Table -->
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                        <table class="display table-striped border" id="basic-2">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Positions</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($staff as $st)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $st->user && $st->user->name ? $st->user->name : 'data not found' }}</td>
                                <td>{{ $st->user->email }}</td>
                                <td>{{ $st->position->name }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit" data-id="{{ $st->user->id }}">
                                            <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </li>
                                        <li class="delete" data-id="{{ $st->user->id }}">
                                            <a href="#!"><i class="fa-solid fa-trash-can"></i></a>
                                        </li>
                                    </ul>
                                </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
              </div>
              <!-- Tabels Positions Ends-->
              
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection

@section('plugins-last')

    <script src="{{ asset('dashboard/assets/js/form-validation-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables1.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom2.js')}}"></script>
    
    <!-- AJAX untuk memeriksa ketersediaan username -->
    <script>
        $(document).ready(function () {
            $('#username').on('blur', function () {
                var username = $(this).val();
                if (username) {
                    $.ajax({
                        url: '{{ route("users.checkUsername") }}',
                        method: 'GET',
                        data: { username: username },
                        success: function (response) {
                            if (response.exists) {
                                $('#username')[0].setCustomValidity('Username already exists');
                                $('#username-feedback').text('Username already exists.');
                            } else {
                                $('#username')[0].setCustomValidity('');
                                $('#username-feedback').text('Please enter a valid username.');
                            }
                        },
                        error: function () {
                            $('#username')[0].setCustomValidity('Error checking username');
                            $('#username-feedback').text('Error checking username.');
                        }
                    });
                } else {
                    $('#username')[0].setCustomValidity('');
                    $('#username-feedback').text('Please enter a valid username.');
                }
            });
        });
    </script>
    <!-- AJAX untuk mengisi form edit dan delete -->
    <script>
        $(document).ready(function () {
            // Klik tombol Edit
            $(".edit").on("click", function () {
            var userId = $(this).data("id"); // Ambil ID user yang akan diedit

            // Lakukan AJAX request untuk mendapatkan data user berdasarkan ID
            $.ajax({
                url: '/users/' + userId + '/edit',  // Ganti dengan endpoint yang sesuai
                method: 'GET',
                success: function (data) {
                // Isi form modal dengan data user yang diterima
                $('#editUserId').val(data.user.id);
                $('#editName').val(data.user.name);
                $('#editUsername').val(data.user.username);
                $('#editRole').val(data.user.role);
                $('#editDepartment').val(data.user.staff.department_id);
                $('#editWhatsapp').val(data.user.staff.whatsapp_number);
                $('#editRoom').val(data.user.staff.room_id);

                // Update dropdown position berdasarkan department yang dipilih
                var departmentId = data.user.staff.department_id;
                updatePositionDropdown(departmentId, data.user.staff.position_id);

                // Tampilkan modal edit
                $('#editModal').modal('show');
                },
                  error: function (error) {
                  Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                }
            });
            });

            // Fungsi untuk memperbarui dropdown posisi berdasarkan department
            function updatePositionDropdown(departmentId, selectedPositionId) {
            $.ajax({
                url: '/get-positions/' + departmentId,
                method: 'GET',
                success: function (data) {
                var positionSelect = $('#editPosition');
                positionSelect.empty();
                positionSelect.append('<option value="" selected disabled>Select position</option>');

                $.each(data.positions, function(index, position) {
                    positionSelect.append('<option value="' + position.id + '" ' + (position.id == selectedPositionId ? 'selected' : '') + '>' + position.name + '</option>');
                });
                },
                error: function () {
                Swal.fire('Error', 'Unable to load positions.', 'error');
                }
            });
            }

            // Submit form edit user
            $('#editForm').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '/users/' + $('#editUserId').val(),
                    method: 'PUT',
                    data: formData,
                    success: function (data) {
                    $('#editModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User updated successfully',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                    },
                    error: function (xhr) {
                      let errorMsg = 'Something went wrong. Please try again.';
                      if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                      } else if (xhr.responseText) {
                        errorMsg = xhr.responseText;
                      }
                      Swal.fire('Error', errorMsg, 'error');
                    }
                });
            });

            // Klik tombol Delete
            $(".delete").on("click", function () {
            var userId = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: '/users/' + userId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'User deleted successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                    },
                    error: function (xhr) {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire('Error', errorMsg, 'error');
                    }
                });
                }
            });
            });
        });
    </script>
    
@endsection