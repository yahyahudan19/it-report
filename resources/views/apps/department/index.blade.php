@extends('layouts.template')

@section('title')
  Department & Positions Management
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
                  <h3>Department & Positions Management</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active">Department & Positions</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid datatable-init">
            <div class="row">
              <!-- Tabels Departments Starts-->
              <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                      <div class="w-75">
                        <h5>Department Management</h5>
                        <p class="f-m-light mt-1">Department Management allows you to add, edit, and delete departments in this system.</p>
                      </div>
                      <div class="card-header-right-icon">
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add Departments</button>
                          <!-- Offcanvas Create Department Stats--> 
                          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myExtraLargeModal">Add Departments</h4>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body dark-modal">
                                  <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ route('department.store') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-control" id="name" type="text" placeholder="Enter name" required name="name">
                                        <div class="invalid-feedback">Please enter a valid name.</div>
                                    </div>
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Offcanvas Create Department Ends-->

                      </div>
                    </div>
                    <!-- Department Table -->
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                        <table class="display table-striped border" id="basic-1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($departments as $dept)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dept->name }}</td>
                                <td>{{ $dept->positions->count() }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit" data-id="{{ $dept->id }}">
                                            <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </li>
                                        <li class="delete" data-id="{{ $dept->id }}">
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
              <!-- Tabels Departments Ends-->

              <!-- Tabels Positions Starts-->
              <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                      <div class="w-75">
                        <h5>Positions Management</h5>
                        <p class="f-m-light mt-1">Positions Management allows you to add, edit, and delete porsitions in this system.</p>
                      </div>
                      <div class="card-header-right-icon">
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".bd-positions-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add Positions</button>
                          <!-- Offcanvas Create Positions Stats--> 
                          <div class="modal fade bd-positions-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myExtraLargeModal">Add Positions</h4>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body dark-modal">
                                  <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ route('positions.store') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-control" id="name" type="text" placeholder="Enter name" required name="name">
                                        <div class="invalid-feedback">Please enter a valid name.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="department_id">Department</label>
                                        <select class="form-select" id="department_id" name="department_id" required>
                                            <option value="" disabled selected>Select department</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a department.</div>
                                    </div>
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Offcanvas Create Positions Ends-->

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
                                <th>Departments</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($positions as $pos)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pos->name }}</td>
                                <td>{{ $pos->department->name }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit" data-id="{{ $pos->id }}">
                                            <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </li>
                                        <li class="delete" data-id="{{ $pos->id }}">
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
    
@endsection