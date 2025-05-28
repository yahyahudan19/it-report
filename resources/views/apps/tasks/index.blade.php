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
                                                <h4 class="modal-title" id="myExtraLargeModal">Add Tasks</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" novalidate=""
                                                    method="POST" action="{{ route('task.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                                    <div class="col-md-12 position-relative">
                                                        <label class="form-label" for="taskSelect">Task</label>
                                                        <select class="form-select" id="taskSelect" name="task_id" required>
                                                            <option value="" disabled selected>Select Task</option>
                                                            @foreach ($work_task as $wt)
                                                                <option value="{{ $wt->id }}">{{ $wt->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a Task.</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="taskDate">Task Date Start</label>
                                                        <input class="form-control" id="datetime-local1" type="datetime-local"
                                                            name="task_date_start" required>
                                                        <div class="invalid-feedback">Please provide a valid date and time.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="taskDate">Task Date End</label>
                                                        <input class="form-control" id="datetime-local2" type="datetime-local"
                                                            name="task_date_end" required>
                                                        <div class="invalid-feedback">Please provide a valid date and time.</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="taskStatus">Status</label>
                                                        <select class="form-select" id="taskStatus" name="taskStatus" class="form-control" required>
                                                            <option value="done">Done</option>
                                                            <option value="progress">Progress</option>
                                                            <option value="pending">Pending</option>
                                                        </select>
                                                    </div>
                                                     <div class="col-md-4 position-relative">
                                                        <label class="form-label" for="categorySelect">Category</label>
                                                        <select class="form-select" id="categorySelect" name="category_id" required>
                                                            <option value="" disabled selected>Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a Category.</div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <label class="form-label" for="quantityInput">Quantity</label>
                                                        <input class="form-control" id="quantityInput" type="number" value="1"
                                                            name="quantity" min="1" required>
                                                        <div class="invalid-feedback">Please provide a valid quantity.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="descInput">Description</label>
                                                        <textarea class="form-control" id="descInput" name="desc" placeholder="Describe the desc" rows="3"
                                                            required></textarea>
                                                        <div class="invalid-feedback">Please describe the Description.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="issueInput">Task</label>
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
                                                    
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="otherStaff">Other Staff</label>
                                                        <select id="otherStaff" name="otherStaff[]" class="form-control" multiple>
                                                            @foreach ($other_staff as $s)
                                                            <option value="{{ $s->id }}">{{ $s->user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-6" id="attachmentSwitchContainer" style="display: none;">
                                                        <label class="form-label" for="attachmentAllStaffSwitch">Use Same Attachment for All Staff?</label>
                                                        <div class="form-check form-switch">
                                                            <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            role="switch" 
                                                            id="attachmentAllStaffSwitch" 
                                                            name="attachment_all_staff" 
                                                            value="1" 
                                                            checked
                                                            >
                                                            <label class="form-check-label" for="attachmentAllStaffSwitch">
                                                            Yes, use one attachment for all staff
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-primary" type="submit">Submit form</button>
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
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Task</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $t)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($t->start_time)->locale('id')->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $t->task_description}}</td>
                                                <td>{{ $t->issues }}</td>
                                                <td>{{ $t->category->name }}</td>
                                                <td> {{ $t->quantity }}</td>
                                                <td>
                                                    @if ($t->status === 'done')
                                                        <span class="badge bg-success">Done</span>
                                                    @elseif ($t->status === 'progress')
                                                        <span class="badge bg-warning text-dark">Progress</span>
                                                    @elseif ($t->status === 'pending')
                                                        <span class="badge bg-secondary">Pending</span>
                                                    @else
                                                        <span class="badge bg-light text-dark">{{ ucfirst($t->status) }}</span>
                                                    @endif
                                                </td>
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

    <!-- Script to set the current date and time in the datetime-local input -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const setDateTime = (inputId) => {
                const input = document.getElementById(inputId);
                if (input && !input.value) {
                    const now = new Date();
                    const pad = n => n.toString().padStart(2, '0');
                    const formatted = `${pad(now.getDate())}-${pad(now.getMonth() + 1)}-${now.getFullYear()} ${pad(now.getHours())}:${pad(now.getMinutes())}`;
                    input.value = formatted;
                }
            };

            setDateTime('datetime-local1');
            setDateTime('datetime-local2');
        });
    </script>

    <!-- Script to handle the delete action -->
    <script>
        $(document).ready(function() {
            // Klik tombol Delete
            $(".delete").on("click", function() {
                var taskId = $(this).data("id"); // Ambil ID report yang akan dihapus

                // Menampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This report and its attachments will be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading SweetAlert
                        Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while the report is being deleted.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Lakukan AJAX request untuk menghapus report berdasarkan ID
                        $.ajax({
                            url: '/task/' + taskId,
                            method: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'The report and its attachments have been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- script to initialize Choices.js -->
    <script>
        const otherStaffSelect = document.getElementById('otherStaff');
        const switchContainer = document.getElementById('attachmentSwitchContainer');

        function toggleSwitchVisibility() {
            // Jika ada item yang terpilih (value length > 0), tampilkan switch, kalau kosong sembunyikan
            if (otherStaffSelect.selectedOptions.length > 0) {
            switchContainer.style.display = 'block';
            } else {
            switchContainer.style.display = 'none';
            }
        }

        // Inisialisasi Choices.js
        const choices = new Choices(otherStaffSelect, {
            removeItemButton: true,
            placeholderValue: 'Select staff...',
            searchPlaceholderValue: 'Type to search...',
        });

        // Dengarkan event perubahan pilihan
        otherStaffSelect.addEventListener('change', toggleSwitchVisibility);

        // Jalankan sekali saat load untuk set default visibility
        toggleSwitchVisibility();
    </script>

   

@endsection
