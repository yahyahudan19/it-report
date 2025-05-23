@extends('layouts.template')

@section('title')
  My Evaluation
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
                  <h3>Evaluation</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item active">Evaluation</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid datatable-init">
            <div class="row">
              <!-- Tabels  Starts-->
              <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                      <div class="w-75">
                        <h5>Evaluation</h5>
                        <p class="f-m-light mt-1">Evaluation is the process of assigning and assessing tasks based on performance and the quantity of work completed within a one-year reporting period.</p>
                      </div>
                      <div class="card-header-right-icon">
                        {{-- <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add Assessment</button>
                           --}}
                      </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                      <table class="display table-striped border" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Staff</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Achievement</th>
                            <th>Difference</th>
                            <th>Precentage</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($work_tasks->sortBy('staff.user.name') as $wt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $wt->staff->user->name }}</td>
                                <td>{{ $wt->title }}</td>
                                <td>{{ $wt->target_quantity }}</td>
                                <td>{{ $wt->achievement }}</td>
                                <td>{{ $wt->shortfall }}</td>
                                <td>
                                    @php
                                        $percent = $wt->percentage;
                                        if ($percent < 50) {
                                            $badge = 'danger';
                                        } elseif ($percent < 75) {
                                            $badge = 'warning';
                                        } elseif ($percent >= 80) {
                                            $badge = 'success';
                                        } else {
                                            $badge = 'secondary';
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $percent }}%</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Tabels  Ends-->
              
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