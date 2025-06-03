@extends('layouts.template')

@section('title')
    Locations
@endsection

@section('plugins-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>


@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Locations</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">App</li>
                            <li class="breadcrumb-item active">Locations</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid datatable-init">
            <div class="row">
                
                <!-- Tabels Buildings Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <div class="w-75">
                                <h5>Buildings</h5>
                                <p class="f-m-light mt-1">Manage Buildings as master data. Add, edit, or remove building records to keep your locations up to date.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Buildings</button>
                                    <!-- Offcanvas Create Report Stats-->
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myExtraLargeModal">Add Buildings</h4>
                                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body dark-modal">
                                                    <form class="row g-3 needs-validation custom-input" novalidate=""
                                                        method="POST" action="{{ route('building.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="taskDate">Name</label>
                                                            <input class="form-control" id="building-name" type="text" name="name" required>
                                                            <div class="invalid-feedback">Please provide a valid Name Buildings.</div>
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
                                            <th>Name</th>
                                            <th>Floor</th>
                                            <th>Room</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($buildings as $bd)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bd->name }}</td>
                                                <td>{{ $bd->floors_count }}</td> {{-- jumlah floors --}}
                                                <td>{{ $bd->rooms_count }}</td>  {{-- jumlah rooms --}}
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="/locations/buildings/{{$bd->id}}">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete" data-id="{{ $bd->id }}">
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
                <!-- Tabels Buildings Ends-->

                <!-- Tabels Floor Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <div class="w-75">
                                <h5>Floors</h5>
                                <p class="f-m-light mt-1">Manage Floors as master data. Add, edit, or remove floor records for each building to keep your locations up to date.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-floor-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Floors</button>
                                    <!-- Offcanvas Create Report Stats-->
                                    <div class="modal fade bd-floor-modal-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myExtraLargeModal">Add Floors</h4>
                                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body dark-modal">
                                                    <form class="row g-3 needs-validation custom-input" novalidate=""
                                                        method="POST" action="{{ route('floor.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="taskDate">Buildings</label>
                                                            <select class="form-select" id="building-id" name="building_id" required>
                                                                <option value="" disabled selected>Select Building</option>
                                                                @foreach($buildings as $building)
                                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid Name Buildings.</div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="taskDate">Floor Number</label>
                                                            <input class="form-control" id="building-floor" type="text" name="floor_number" required>
                                                            <div class="invalid-feedback">Please provide a valid floor Number.</div>
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
                            <div class="table-responsive">
                                <table class="display table-striped border" id="basic-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Buildings</th>
                                            <th>Floor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($floors as $fl)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fl->building->name}}</td>
                                                <td>{{ $fl->floor_number}}</td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="/locations/floors/{{$fl->id}}"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>

                                                        <li class="delete" data-id="{{ $fl->id }}">
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
                <!-- Tabels Floor Ends-->

                <!-- Tabels Room Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <div class="w-75">
                                <h5>Rooms</h5>
                                <p class="f-m-light mt-1">Manage Rooms as master data. Add, edit, or remove room records for each floor to keep your locations up to date.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-room-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Rooms</button>
                                    <!-- Offcanvas Add Rooms Stats-->
                                    <div class="modal fade bd-room-modal-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myExtraLargeModal">Add Rooms</h4>
                                                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body dark-modal">
                                                    <form class="row g-3 needs-validation custom-input" novalidate=""
                                                        method="POST" action="{{ route('room.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="taskDate">Buildings</label>
                                                            <select class="form-select" id="room_building_id" name="building_id" required>
                                                                <option value="" disabled selected>Select Building</option>
                                                                @foreach($buildings as $building)
                                                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid Buildings.</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="taskDate">Floors</label>
                                                            <select class="form-select" id="room_floor_id" name="floor_id" required>
                                                                <option value="" disabled selected>Select Floors</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid Floors.</div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="taskDate">Room Name</label>
                                                            <input class="form-control" id="room-name" type="text" name="name" required>
                                                            <div class="invalid-feedback">Please provide a valid room flux:navmenu.</div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Offcanvas Add Rooms Ends-->

                               
                            </div>
                        </div>
                        <div class="card-body">
                           <div id="gridjs-floor-table"></div>
                        </div>
                    </div>
                </div>
                <!-- Tabels Room Ends-->
                
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


    <!-- Script to handle the delete action -->
    <script>
        $(document).ready(function() {
            // Klik tombol Delete
            $(".delete").on("click", function() {
                var buildingsId = $(this).data("id"); // Ambil ID report yang akan dihapus

                // Menampilkan SweetAlert konfirmasi
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This Buildings and its floor-room will be deleted!',
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
                            text: 'Please wait while the Buildings is being deleted.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Lakukan AJAX request untuk menghapus report berdasarkan ID
                        $.ajax({
                            url: '/locations/building' + buildingsId,
                            method: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'The Buildings and its floor-room have been deleted.',
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
        const buildingSelect = document.getElementById('room_building_id');
        const floorSelect = document.getElementById('room_floor_id');

        const buildingChoices = new Choices(buildingSelect, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
        });

        const floorChoices = new Choices(floorSelect, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
        });

        buildingSelect.addEventListener('change', function () {
            const buildingId = this.value;

            // Clear current floor options
            floorChoices.clearStore();

            // Ambil floor berdasarkan building_id
            fetch(`/get-floors/${buildingId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                const choices = data.map(floor => ({
                    value: floor.id,
                    label: floor.floor_number // gunakan floor_number sebagai label
                }));
                floorChoices.setChoices(choices, 'value', 'label', true);
                }
            })
            .catch(error => {
                console.error('Error fetching floors:', error);
            });
        });
    </script>

    <!-- script to initialize Grid.js for Rooms table -->
    <script>
        const grid = new gridjs.Grid({
        server: {
            url: '/api/rooms',
            then: data => data.data.map((item, index) => [
            index + 1, // Nomor urut dimunculkan di sini
            item.name,
            item.building_name,
            item.floor_number,
            // Kolom Action dengan HTML, akan di-render dengan unsafe: true
            `<ul class="action">
                <li class="edit">
                    <a href="/locations/floors/${item.id}"><i class="fa-regular fa-pen-to-square"></i></a>
                </li>
                <li class="delete" data-id="${item.id}">
                    <a href="#!"><i class="fa-solid fa-trash-can"></i></a>
                </li>
            </ul>`
            ]),
            total: data => data.total,
        },
        pagination: {
            enabled: true,
            limit: 10,
            summary: true,
        },
        search: true,
        sort: true,
        columns: [
            { 
            name: 'No', 
            },
            'Rooms',
            'Buildings',
            'Floor',
            { 
            name: 'Action', 
            sort: false,
            formatter: (cell) => gridjs.html(cell),
            }
        ],
        }).render(document.getElementById('gridjs-floor-table'));
    </script>


@endsection
