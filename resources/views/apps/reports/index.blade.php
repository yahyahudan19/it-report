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
                        <form method="GET" action="{{ route('report.index') }}">
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
                                    <label class="form-label">Report Priority</label>
                                    <select class="form-select" name="priority" id="prioritySelect">
                                        <option value="all" {{ request('priority') == 'all' ? 'selected' : '' }}>All</option>
                                        <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>Critical</option>
                                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    </select>
                                </div>
                                    <div class="col-xl col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary f-w-500 w-100" type="submit">Filter</button>
                                    </div>
                                    <div class="col-xl col-md-2 d-flex align-items-end">
                                        <a href="{{ route('report.index') }}" class="btn btn-secondary f-w-500 w-100">Clear</a>
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
                            <div class="w-75">
                                <h5>Reports</h5>
                                <p class="f-m-light mt-1">Reports allow staff and management to track, manage, and assess
                                    various work data efficiently throughout the year.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Reports
                                </button>
                                <button class="btn btn-success" type="button"><i class="fa-solid fa-file-excel pe-2"></i>
                                    Export
                                </button>
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
                                
                                <!-- Offcanvas Assign Report Stats-->
                                <div class="modal fade bd-assign-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModal">Handle Report ?</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" novalidate="" method="POST"
                                                    action="{{ route('report.assign') }}">
                                                    @csrf
                                                    <!-- Hidden fields for report_id and room_id -->
                                                    <input type="hidden" name="report_id" id="report_id">
                                                    <input type="hidden" name="room_id" id="room_id">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="assignmenStaff">Assign To</label>
                                                        <select id="assignmenStaff" name="assignmenStaff[]" class="form-control" multiple required>
                                                            @foreach ($reporter as $s)
                                                                <option value="{{ $s->id }}">{{ $s->user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="assignmenStatus">Status</label>
                                                        <select id="assignmenStatus" name="assignmenStatus" class="form-control" required>
                                                            <option value="accept">accept</option>
                                                            <option value="handling">handling</option>
                                                            <option value="pending">pending</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="assignmenCategory">Category</label>
                                                        <select id="assignmenCategory" name="assignmenCategory" class="form-control" required>
                                                        <option value="" disabled selected>Select Category</option>
                                                        @foreach ($category as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="assignmenSubCategory">Sub Category</label>
                                                        <select id="assignmenSubCategory" name="assignmenSubCategory" class="form-control" required>
                                                            <option value="" disabled selected>Select Sub Category</option>
                                                        </select>
                                                    </div>
                                                     <div class="col-6">
                                                        <label class="form-label" for="attachmentInput">Notifications Staff :</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="flexSwitchCheckChecked" name="notification_staff" type="checkbox" role="switch" checked="">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Send Notification to Staff ?</label>
                                                        </div>
                                                        <div class="invalid-feedback">Please switch.</div>
                                                    </div>
                                                     <div class="col-6">
                                                        <label class="form-label" for="attachmentInput">Notifications Reporter :</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="flexSwitchCheckChecked" name="notification_reporter" type="checkbox" role="switch" checked="">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Send Notification to Reporter ?</label>
                                                        </div>
                                                        <div class="invalid-feedback">Please switch.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Offcanvas Assign Report Ends-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display table-striped border" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Location</th>
                                            <th>Issue</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Priority</th>
                                            <th>Assigne</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($report as $rep)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rep->room->name }}</td>
                                                <td>{{ $rep->issue }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($rep->report_date)->locale('id')->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($rep->report_date)->translatedFormat('H:i') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $priorityClass =
                                                            [
                                                                'critical' => 'badge bg-danger',
                                                                'high' => 'badge bg-warning text-white',
                                                                'medium' => 'badge bg-info text-white',
                                                                'low' => 'badge bg-success',
                                                            ][$rep->priority] ?? 'badge bg-secondary';
                                                    @endphp
                                                    <span class="{{ $priorityClass }}">
                                                        {{ ucfirst($rep->priority) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled mb-0">
                                                        @if ($rep->staff->isEmpty() || $rep->staff->first()?->pivot === null)
                                                            <li>
                                                                <button class="btn btn-xs btn-outline-danger px-3 py-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-assign-modal-lg"
                                                                    data-report-id="{{ $rep->id }}"
                                                                    data-room-id="{{ $rep->room->id }}">
                                                                    No assignee available
                                                                </button>
                                                            </li>
                                                        @else
                                                            @foreach ($rep->staff as $staffMember)
                                                                @php
                                                                    $status = $staffMember->pivot->status ?? null;
                                                                    $statusColors = [
                                                                        'accept' => 'bg-info text-white',
                                                                        'handling' => 'bg-warning text-white',
                                                                        'done' => 'bg-success',
                                                                        'pending' => 'bg-secondary',
                                                                    ];
                                                                    $badgeClass =
                                                                        $statusColors[$status] ?? 'bg-light text-white';
                                                                @endphp
                                                                <li class="mb-1" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" data-bs-title="">
                                                                    <span class="badge {{ $badgeClass }} px-3 py-2">
                                                                        {{ $staffMember->user->username }} -
                                                                        {{ ucfirst($status) }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                             <li>
                                                                <button class="btn btn-xs btn-outline-warning px-3 py-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-assign-modal-lg"
                                                                    data-report-id="{{ $rep->id }}"
                                                                    data-room-id="{{ $rep->room->id }}">
                                                                    Assign to Group
                                                                </button>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="/reports/detail/{{$rep->id}}"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>

                                                        <li class="delete" data-id="{{ $rep->id }}">
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

    <!-- Script to handle the reporter typeahead -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('reporterTypeahead');
            const suggestions = document.getElementById('reporterSuggestions');
            const reporterIdInput = document.getElementById('reporterId');
            let debounceTimeout = null;

            input.addEventListener('input', function() {
                const query = this.value.trim();
                reporterIdInput.value = '';
                if (debounceTimeout) clearTimeout(debounceTimeout);
                if (query.length < 2) {
                    suggestions.style.display = 'none';
                    suggestions.innerHTML = '';
                    return;
                }
                debounceTimeout = setTimeout(() => {
                    fetch(`/reporters/search?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            suggestions.innerHTML = '';
                            if (data.length === 0) {
                                suggestions.style.display = 'none';
                                return;
                            }
                            data.forEach(rep => {
                                const item = document.createElement('button');
                                item.type = 'button';
                                item.className =
                                    'list-group-item list-group-item-action';
                                item.textContent = rep.user.name;
                                item.onclick = function() {
                                    input.value = rep.user.name;
                                    reporterIdInput.value = rep.id;
                                    suggestions.style.display = 'none';
                                    suggestions.innerHTML = '';
                                };
                                suggestions.appendChild(item);
                            });
                            suggestions.style.display = 'block';
                        });
                }, 300);
            });

            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !suggestions.contains(e.target)) {
                    suggestions.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Script to handle the location typeahead -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationInput = document.getElementById('locationTypeahead');
            const locationSuggestions = document.getElementById('locationSuggestions');
            const locationIdInput = document.getElementById('locationId');
            let locationDebounceTimeout = null;

            locationInput.addEventListener('input', function() {
                const query = this.value.trim();
                locationIdInput.value = '';
                if (locationDebounceTimeout) clearTimeout(locationDebounceTimeout);
                if (query.length < 2) {
                    locationSuggestions.style.display = 'none';
                    locationSuggestions.innerHTML = '';
                    return;
                }
                locationDebounceTimeout = setTimeout(() => {
                    fetch(`/locations/search?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            locationSuggestions.innerHTML = '';
                            if (data.length === 0) {
                                locationSuggestions.style.display = 'none';
                                return;
                            }
                            data.forEach(loc => {
                                const item = document.createElement('button');
                                item.type = 'button';
                                item.className =
                                    'list-group-item list-group-item-action';
                                item.textContent = loc.name;
                                item.onclick = function() {
                                    locationInput.value = loc.name;
                                    locationIdInput.value = loc.id;
                                    locationSuggestions.style.display = 'none';
                                    locationSuggestions.innerHTML = '';
                                };
                                locationSuggestions.appendChild(item);
                            });
                            locationSuggestions.style.display = 'block';
                        });
                }, 300);
            });

            document.addEventListener('click', function(e) {
                if (!locationInput.contains(e.target) && !locationSuggestions.contains(e.target)) {
                    locationSuggestions.style.display = 'none';
                }
            });
        });
    </script>
    
    <!-- Script to handle the delete action -->
    <script>
        $(document).ready(function() {
            // Klik tombol Delete
            $(".delete").on("click", function() {
                var reportId = $(this).data("id"); // Ambil ID report yang akan dihapus

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
                        // Lakukan AJAX request untuk menghapus report berdasarkan ID
                        $.ajax({
                            url: '/reports/' +
                            reportId, // Ganti dengan URL untuk route delete
                            method: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}" // Pastikan untuk mengirimkan CSRF token
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'The report and its attachments have been deleted.',
                                    'success'
                                );
                                location.reload(); // reload halaman jika diperlukan
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

    <!-- Script to handle the assign action -->
    <script>

        $(document).ready(function () {
            // Ketika tombol assign diklik
            $("button[data-bs-target='.bd-assign-modal-lg']").on("click", function () {
                // Ambil data dari tombol
                var reportId = $(this).data("report-id");
                var roomId = $(this).data("room-id");

                // Set data ke dalam input hidden di dalam modal
                $("#report_id").val(reportId);
                $("#room_id").val(roomId);
            });
        });

        const element = document.getElementById('assignmenStaff');
        const choices = new Choices(element, {
            removeItemButton: true,
            placeholderValue: 'Select staff...',
            searchPlaceholderValue: 'Type to search...',
        });

        const assignmenStatus = document.getElementById('assignmenStatus');
        new Choices(assignmenStatus, {
            searchEnabled: false, // Nonaktifkan pencarian jika sedikit opsi
            itemSelectText: '',
            shouldSort: false,
        });

        // const assignmenCategory = document.getElementById('assignmenCategory');
        // new Choices(assignmenCategory, {
        //     searchEnabled: false, // Nonaktifkan pencarian jika sedikit opsi
        //     itemSelectText: '',
        //     shouldSort: false,
        // });
        // const assignmenSubCategory = document.getElementById('assignmenSubCategory');
        // new Choices(assignmenSubCategory, {
        //     searchEnabled: false, // Nonaktifkan pencarian jika sedikit opsi
        //     itemSelectText: '',
        //     shouldSort: false,
        // });
    </script>
    <!-- Script to handle dynamic sub-category selection based on category -->
    <script>
        const allSubCategories = @json($subCategory); // ambil semua sub kategori dari controller

        const assignmenCategory = document.getElementById('assignmenCategory');
        const assignmenSubCategory = document.getElementById('assignmenSubCategory');

        const categoryChoices = new Choices(assignmenCategory, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
        });

        const subCategoryChoices = new Choices(assignmenSubCategory, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
        });

        assignmenCategory.addEventListener('change', function () {
            const selectedCategoryId = this.value;

            // Filter sub kategori berdasarkan main_category_id
            const filtered = allSubCategories.filter(sub => sub.main_category_id === selectedCategoryId);

            // Kosongkan dan isi ulang pilihan sub category
            subCategoryChoices.clearStore();
            subCategoryChoices.setChoices(
                filtered.map(sub => ({
                    value: sub.id,
                    label: sub.name,
                    selected: false,
                    disabled: false
                })),
                'value',
                'label',
                false
            );
        });
    </script>
    <!-- Script to set the current date and time in the datetime-local input -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById('datetime-local1');
            if (input && !input.value) {
            const now = new Date();
            const pad = n => n.toString().padStart(2, '0');
            const formatted = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}`;
            input.value = formatted;
        }
        });
    </script>

@endsection
