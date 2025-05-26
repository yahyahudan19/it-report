@extends('layouts.template')

@section('title')
    Tasks
@endsection

@section('plugins-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Task</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">App</li>
                            <li class="breadcrumb-item active">Tasks</li>
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
                                <h5>Tasks</h5>
                                <p class="f-m-light mt-1">Tasks allow staff and management to track, manage, and assess various assignments efficiently throughout the year.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Tasks</button>
                                <!-- Offcanvas Create Report Stats-->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModal">Add Reports</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" novalidate=""
                                                    method="POST" action="{{ route('report.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="reporterTypeahead">Reporter</label>
                                                        <input type="text" class="form-control" id="reporterTypeahead"
                                                            placeholder="Type to search reporter..." autocomplete="off"
                                                            required>
                                                        <input type="hidden" name="reporter_id" id="reporterId">
                                                        <div class="invalid-feedback">Please select a reporter.</div>
                                                        <div id="reporterSuggestions"
                                                            class="list-group position-absolute w-100"
                                                            style="z-index: 1000; display: none;"></div>
                                                    </div>

                                                    <div class="col-md-6 position-relative">
                                                        <label class="form-label" for="locationTypeahead">Location</label>
                                                        <input type="text" class="form-control" id="locationTypeahead"
                                                            placeholder="Type to search location..." autocomplete="off"
                                                            required>
                                                        <input type="hidden" name="location_id" id="locationId">
                                                        <div class="invalid-feedback">Please select a location.</div>
                                                        <div id="locationSuggestions"
                                                            class="list-group position-absolute w-100"
                                                            style="z-index: 1000; display: none;"></div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="reportDate">Report Date</label>
                                                        <input class="form-control" id="datetime-local1" type="datetime-local"
                                                            name="report_date" required>
                                                        <div class="invalid-feedback">Please provide a valid date and time.</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="prioritySelect">Priority</label>
                                                        <select class="form-select" id="prioritySelect" name="priority"
                                                            required>
                                                            <option value="" disabled selected>Select Priority
                                                            </option>
                                                            <option value="critical">Critical</option>
                                                            <option value="high">High</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="low">Low</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a priority.</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label" for="issueInput">Issue</label>
                                                        <textarea class="form-control" id="issueInput" name="issue" placeholder="Describe the issue" rows="3"
                                                            required></textarea>
                                                        <div class="invalid-feedback">Please describe the issue.</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label" for="attachmentInput">Attachment</label>
                                                        <input class="form-control" id="formFile" type="file"
                                                            name="attachment" accept=".jpg, .jpeg, .png, .pdf">
                                                        <div class="invalid-feedback">Please upload.</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="attachmentInput">Notifications</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="flexSwitchCheckChecked" name="notification" type="checkbox" role="switch" checked="">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Send Notification to Reporter ?</label>
                                                        </div>
                                                        <div class="invalid-feedback">Please upload.</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="attachmentInput">Generative AI</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="flexSwitchCheckChecked" name="ai_check" type="checkbox" role="switch">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Add Generative Ai ?</label>
                                                        </div>
                                                        <div class="invalid-feedback">Please upload.</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-primary" type="submit">Submit
                                                            form</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Offcanvas Create Report Ends-->
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display table-striped border" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Description</th>
                                            <th>Issue</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $t)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $t->task_description}}</td>
                                                <td>{{ $t->issues }}</td>
                                                <td>{{ $t->category->name }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($t->start_time)->locale('id')->translatedFormat('d F Y') }}
                                                </td>
                                                <td> {{ $t->quantity }}</td>
                                                <td> {{ $t->status }}</td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="/task/detail/{{$t->id}}"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>

                                                        <li class="delete" data-id="{{ $t->id }}">
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
                <!-- Tabels  Ends-->
                
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@section('plugins-last')
    <script src="{{ asset('dashboard/assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables1.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flat-pickr/custom-flatpickr.js') }}"></script>


@endsection
