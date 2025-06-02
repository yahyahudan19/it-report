@extends('layouts.template')

@section('title')
    Reports
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
                        <h3>Reports</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">App</li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid datatable-init">
            <div class="row">
                 <div class="col-12">
                    <div class="card">
                        <form method="GET" action="{{ route('handling.index') }}">
                            <div class="card-body">
                                <div class="row g-3 custom-input">
                                <div class="col-xl col-md-6"> 
                                    <label class="form-label" for="datetime-local">Start Date: </label>
                                    <div class="input-group flatpicker-calender">
                                    <input class="form-control" id="datetime-local" placeholder="dd/mm/yyyy" name="start_date" value="{{ request('start_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl col-md-6"> 
                                    <label class="form-label" for="datetime-local3">End Date : </label>
                                    <div class="input-group flatpicker-calender">
                                    <input class="form-control" id="datetime-local3" placeholder="dd/mm/yyyy" name="end_date" value="{{ request('end_date') }}" required>
                                    </div>
                                </div>
                               <div class="col-xl col-md-6">
                                    <label class="form-label">Status Handling</label>
                                    <select class="form-select" name="status" id="statusSelect">
                                        <option value="all" {{ request('priority') == 'all' ? 'selected' : '' }}>All</option>
                                        <option value="accept" {{ request('status') == 'accept' ? 'selected' : '' }}>Accept</option>
                                        <option value="handling" {{ request('status') == 'handling' ? 'selected' : '' }}>Handling</option>
                                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                                    <div class="col-xl col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary f-w-500 w-100" type="submit">Filter</button>
                                    </div>
                                    <div class="col-xl col-md-2 d-flex align-items-end">
                                        <a href="{{ route('handling.index') }}" class="btn btn-secondary f-w-500 w-100">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tabels  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <div class="w-100">
                                <h5>Handling</h5>
                                <p class="f-m-light mt-1">Handling reports ensures that issues are addressed promptly and
                                    effectively, improving operational efficiency and accountability.</p>
                            </div>
                            <div class="card-header-right-icon">
                                {{-- <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Reports</button> --}}

                                <!-- Offcanvas Handling Report Stats-->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModal">Set Status</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" novalidate=""
                                                    method="POST" action="{{ route('handling.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="col-md-4">
                                                        <label class="form-label" for="statusSelect">Status</label>
                                                        <select class="form-select" id="statusSelect" name="status"
                                                            required>
                                                            <option value="" disabled selected>Select Status
                                                            </option>
                                                            <option value="accept">Accept</option>
                                                            <option value="handling">Handling</option>
                                                            <option value="done">Done</option>
                                                            <option value="pending">Pending</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a priority.</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="handlingTime">Handling Time</label>
                                                        <input class="form-control" id="datetime-local1" type="date"
                                                            name="handling_time" required
                                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                        <div class="invalid-feedback">Please provide a valid date and time.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="quantityInput">Quantity</label>
                                                        <input class="form-control" id="quantityInput" type="number"
                                                            name="quantity" min="1" required>
                                                        <div class="invalid-feedback">Please provide a valid quantity.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="actionInput">Action Taken</label>
                                                        <textarea class="form-control" id="actionInput" name="accion_taken" placeholder="Describe action taken" rows="3"
                                                            required></textarea>
                                                        <div class="invalid-feedback">Please describe action taken.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="attachmentInput">Attachment</label>
                                                        <input class="form-control" id="formFile" type="file"
                                                            name="attachment" accept=".jpg, .jpeg, .png, .pdf" required>
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
                                <!-- Offcanvas Handling Report Ends-->

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display table-striped border" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Action Taken</th>
                                            <th>Handling Time</th>
                                            <th>Priority</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($handling as $hand)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($hand->report->report_date)->locale('id')->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $hand->room->name }}</td>
                                                <td>
                                                    @if ($hand->action_taken)
                                                        {{ $hand->action_taken }}
                                                    @else
                                                        <span class="badge bg-warning text-dark">No Action taken</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($hand->handling_time)
                                                        {{ \Carbon\Carbon::parse($hand->handling_time)->locale('id')->translatedFormat('d F Y H:i') }}
                                                    @else
                                                        <span class="badge bg-warning text-dark">No Time</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($hand->report->priority === 'critical')
                                                        <span class="badge bg-danger">Critical</span>
                                                    @elseif ($hand->report->priority === 'high')
                                                        <span class="badge bg-warning text-dark">High</span>
                                                    @elseif ($hand->report->priority === 'medium')
                                                        <span class="badge bg-info text-dark">Medium</span>
                                                    @elseif ($hand->report->priority === 'low')
                                                        <span class="badge bg-success">Low</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($hand->status === 'accept')
                                                        <span class="btn btn-pill btn-xs btn-primary">Accept</span>
                                                    @elseif ($hand->status === 'handling')
                                                        <span class="btn btn-pill btn-xs btn-dark">Handling</span>
                                                    @elseif ($hand->status === 'done')
                                                        <span class="btn btn-pill btn-xs btn-success">Done</span>
                                                    @elseif ($hand->status === 'pending')
                                                        <span class="btn btn-pill btn-xs btn-secondary">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="/handling/detail/{{ $hand->id }}"><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>

                                                        <li class="delete" data-id="{{ $hand->id }}">
                                                            <a href="#!" class="btn-delete btn-da"><i class="fa-solid fa-trash-can"></i></a>
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

    <script>
        $(document).ready(function() {
            $(".delete").on("click", function() {
                var handlingId = $(this).data("id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This handling data will be deleted permanently!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/handling/' + handlingId, // sesuai route delete
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE' // menggunakan method DELETE
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'The handling data has been deleted.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMsg = 'Something went wrong. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                } else if (xhr.responseText) {
                                    errorMsg = xhr.responseText;
                                }
                                Swal.fire(
                                    'Error!',
                                    errorMsg,
                                    'error'
                                );
                            }
                        });
                    }
                });
                
            });
        });
    </script>
    

@endsection
