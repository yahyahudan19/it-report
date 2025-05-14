@extends('layouts.template')

@section('title')
  Reports
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
                  <h3>Basic DataTables</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Data Tables</li>
                    <li class="breadcrumb-item active">Basic DataTables</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid datatable-init">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                    <h5>Zero Configuration</h5>
                    <p class="f-m-light mt-1">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>.</p>
                    <p class="f-m-light mt-1">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                      <table class="display table-striped border" id="basic-1">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>25/04/2011</td>
                            <td>$320,800</td>
                            <td> 
                              <ul class="action"> 
                                <li class="edit"> <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a></li>
                                <li class="delete"><a href="#!"><i class="fa-solid fa-trash-can"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                          <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>25/07/2015</td>
                            <td>$170,750</td>
                            <td> 
                              <ul class="action"> 
                                <li class="edit"> <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a></li>
                                <li class="delete"><a href="#!"><i class="fa-solid fa-trash-can"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection

@section('plugins-last')
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables1.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom2.js')}}"></script>
@endsection