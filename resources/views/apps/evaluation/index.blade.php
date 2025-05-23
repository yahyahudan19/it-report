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
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add Assessment</button>
                          <!-- Offcanvas Create Assessment Stats--> 
                          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myExtraLargeModal">Add Assessment</h4>
                                  <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body dark-modal">
                                  <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ route('assessment.store') }}">
                                    @csrf
                                    <div class="col-12">
                                      <label class="form-label" for="validationCustom01">Task</label>
                                      <input class="form-control" id="validationCustom01" type="text" placeholder="ur task" required="" name="title">
                                      <div class="invalid-feedback">Please enter your valid </div>
                                      <div class="valid-feedback">
                                        Looks's Good!</div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                      <label class="form-label" for="validationCustom03">Unit (Satuan)</label>
                                      <input class="form-control" id="validationCustom03" type="text" placeholder="Activity" required="" name="unit" >
                                      <div class="invalid-feedback">Please provide a valid Unit.</div>
                                      <div class="valid-feedback">
                                      Looks's Good!</div>
                                    </div>

                                    <div class="col-md-6">
                                      <label class="form-label" for="validationCustom05">Quantity</label>
                                      <input class="form-control" id="validationCustom05" type="number" min="1" step="1" placeholder="10" required="" name="target_quantity" pattern="\d+">
                                      <div class="invalid-feedback">Please provide a valid quantity (numbers only).</div>
                                      <div class="valid-feedback">
                                      Looks's Good!</div>
                                    </div>
                                    <div class="col-12"> 
                                      <label class="form-label" for="validationTextarea">Description</label>
                                      <textarea class="form-control" id="validationTextarea" placeholder="Enter your desctiption" required="" name="description"></textarea>
                                      <div class="invalid-feedback">Please enter a description in the textarea.</div>
                                    </div>
                                    
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Submit form</button>
                                      <button class="btn btn-danger" type="button" id="ai-joke-btn">Generate Description using AI </button>
                                     
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Offcanvas Create Assessment Ends-->
                          
                      </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                      <table class="display table-striped border" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Achievement</th>
                            <th>Difference</th>
                            <th>Precentage</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($work_tasks as $wt)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $wt->title }}</td>
                            <td>{{ $wt->target_quantity }}</td>
                            <td>{{ $wt->achievement }}</td>
                            <td>{{ $wt->shortfall }}</td>
                            <td>{{ $wt->percentage }}%</td>
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