@extends('layouts.template')

@section('title')
  Reports
@endsection

@section('plugins-head')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/select/bootstrap-select.min.css')}}">
@endsection

@section('content')
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Reports</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Apps</li>
                    <li class="breadcrumb-item active">Reports</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid main-tasks">
            <div class="email-wrap bookmark-wrap">
              <div class="row main-bookmark">
                <div class="col-xxl-2 box-col-6">
                  <div class="md-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="#!">Reports filter</a>
                    <div class="md-sidebar-aside job-left-aside">
                      <div class="email-left-aside">
                        <div class="card">
                          <div class="card-body custom-scrollbar">
                            <div class="email-app-sidebar left-bookmark task-sidebar">
                              <div class="common-flex align-items-center">
                                <div class="media-size-email"><img class="rounded-circle" src="{{ asset('dashboard/assets/images/user/user.png')}}" alt=""></div>
                                <div class="flex-grow-1">
                                  <h6>{{ auth()->user()->name }}</h6>
                                  <p>{{ auth()->user()->email }}</p>
                                </div>
                              </div>
                              <ul class="nav main-menu" role="tablist">
                                <li class="nav-item">
                                  <button class="badge-light-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="me-2" data-feather="check-circle"></i> New Report</button>
                                </li>
                                <li> 
                                  <form class="row g-3 needs-validation" novalidate="">
                                    <div class="col-12">
                                      <label class="form-label">Reports Status</label>
                                      <select class="form-select" aria-label="task status">
                                        <option value="1" selected>Pending</option>
                                        <option value="2">In Progress</option>
                                        <option value="3">On Hold</option>
                                        <option value="4">Completed</option>
                                      </select>
                                      <div class="valid-feedback">Looks good!</div>
                                      <div class="invalid-feedback">Please select your Reports status.</div>
                                    </div>
                                    <div class="col-12"> 
                                      <label class="form-label">Reports Importance</label>
                                      <select class="form-select" aria-label="task importance">
                                        <option value="1" selected>Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">High</option>
                                      </select>
                                      <div class="valid-feedback">Looks good!</div>
                                      <div class="invalid-feedback">Please select your Reports importance.</div>
                                    </div>
                                    <div class="col-12"> 
                                      <label class="form-label" for="validationTextarea">Reports Due Date</label>
                                      <input class="datepicker-here form-control" type="text" data-language="en" placeholder="Date">
                                    </div>
                                  </form>
                                </li>
                                <li> 
                                  <div class="row task-stats gap-3">
                                    <div class="col-12">
                                      <div class="common-align justify-content-start">
                                        <div class="bg-primary"><i class="fa-solid fa-list-check"></i></div>
                                        <div> <span class="c-o-light">Today's Reports</span>
                                          <h4>20</h4>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="common-align justify-content-start">
                                        <div class="bg-primary"><i class="fa-solid fa-hourglass-half"></i></div>
                                        <div> <span class="c-o-light">Incomplete Reports</span>
                                          <h4>45</h4>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-10 col-md-12 box-col-12">
                  <div class="card heading-space">
                    <div class="card-header card-no-border">
                      <div class="header-top">
                        <h5>Reports</h5>
                      </div>
                    </div>
                    <div class="card-body px-0 pt-0 common-task-table">
                      <div class="table-responsive custom-scrollbar">
                        <table class="table" id="main-task-table">
                          <thead> 
                            <tr>
                              <th> </th>
                              <th>Reporter</th>
                              <th>Issue</th>
                              <th>Date</th>
                              <th>Assign To</th>
                              <th>Priority</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <tr> 
                              <td></td>
                              <td>Rhesal - IT</td>
                              <td><span>Laptop ERM Tidak bisa tersambung ke jaringan</span></td>
                              <td>14 Mei 2024 - 15:00</td>
                              <td> 
                                <ul class="common-f-start">
                                  <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Yahya Hudan"> 
                                    <div class="common-circle bg-lighter-info">Y</div>
                                  </li>
                                </ul>
                              </td>
                              <td> 
                                <button class="btn badge-light-warning">Medium</button>
                              </td>
                              <td> 
                                <button class="btn btn-danger" type="button">Delete</button>
                                <button class="btn btn-warning" type="button">Details</button>
                                <button class="btn btn-primary" type="button">Assign</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New task modal                                       -->
            <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content custom-input">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                      <div class="row">
                        <div class="mb-3 col-md-12">
                          <label class="form-label" for="task-title">Task Name</label>
                          <input class="form-control" id="task-title" type="text" required="" autocomplete="off" placeholder="Enter your task name">
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please enter a task name.</div>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label class="form-label" for="validationTextarea">Task Details</label>
                          <textarea class="form-control" id="validationTextarea" placeholder="Enter your task details..." autocomplete="off" required="">  </textarea>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please enter a description.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="validationTextarea">Task Due Date</label>
                          <input class="datepicker-here form-control" type="text" data-language="en" placeholder="Date" required>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select a task due date.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="validationTextarea">Task Due Time</label>
                          <select class="form-control">
                            <option>7:00 am</option>
                            <option>7:30 am</option>
                            <option>8:00 am</option>
                            <option>8:30 am</option>
                            <option>9:00 am</option>
                            <option>9:30 am</option>
                            <option>10:00 am</option>
                            <option>10:30 am</option>
                            <option>11:00 am</option>
                            <option>11:30 am</option>
                            <option>12:00 pm</option>
                            <option>12:30 pm</option>
                            <option>1:00 pm</option>
                            <option>2:00 pm</option>
                            <option>3:00 pm</option>
                            <option>4:00 pm</option>
                            <option>5:00 pm</option>
                            <option>6:00 pm</option>
                          </select>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select a task due date.</div>
                        </div>
                        <div class="mb-3 col-12">
                          <label class="form-label">Assign To</label>
                          <select class="selectpicker search-picker" multiple="" aria-label="assign to" data-live-search="true" required>
                            <option value="1">Gabriela Wright</option>
                            <option value="2">Chase Russo</option>
                            <option value="3">Ryland House</option>
                            <option value="4">Fabian Leonard</option>
                            <option value="5">Layne Hayden</option>
                            <option value="6">Clare Truong</option>
                            <option value="7">Shiloh Turner</option>
                            <option value="8">Miller Dickerson</option>
                            <option value="9">Jaylee Rios</option>
                            <option value="10">Anna Sandoval</option>
                            <option value="11">Gracie Ryan</option>
                            <option value="12">Zayne Olson</option>
                          </select>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select your assign user.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="validationSelectStatus">Task Status</label>
                          <select class="form-select" id="validationSelectStatus" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Pending</option>
                            <option value="2">In Progress</option>
                            <option value="3">On Hold</option>
                            <option value="4">Completed</option>
                          </select>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select your task status.</div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="validationSelectImportance">Task Importance</label>
                          <select class="form-select" id="validationSelectImportance" required>
                            <option value="" disabled selected>Select Importance</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                          </select>
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select your task importance.</div>
                        </div>
                        <div class="col-12">
                          <label class="form-label" for="formFileMultiple">Attach Files</label>
                          <input class="form-control" id="formFileMultiple" type="file" multiple="" required="">
                          <div class="valid-feedback">Looks good!</div>
                          <div class="invalid-feedback">Please select your files.</div>
                        </div>
                      </div>
                      <input id="index_var" type="hidden" value="6">
                      <button class="btn btn-secondary me-2" id="Bookmark" onclick="submitBookMark()" type="submit">Save</button>
                      <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection

@section('plugins-last')
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.select.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/select.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/form-validation-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/tooltip-init.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/select/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/trash_popup.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/common-check.js')}}"></script>
@endsection