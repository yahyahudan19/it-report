@extends('layouts.template')

@section('title')
  Assessment 
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
                  <h3>Assessment</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item active">Assessment</li>
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
                        <h5>Assessment</h5>
                        <p class="f-m-light mt-1">Assessment, or penilaian, is a process where each individual is assigned tasks and assessed based on their performance and quantity of work completed within a one-year reporting period.</p>
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
                                    
                                    <div class="col-md-12">
                                        <label class="form-label" for="staffSelect">Staff</label>
                                        <select class="form-select" id="staffSelect1" name="staff_id" required>
                                            <option value="" disabled selected>Select staff</option>
                                            @foreach($department_staff as $staff)
                                                <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a staff member.</div>
                                        <div class="valid-feedback">Looks's Good!</div>
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

                          <!-- Offcanvas Edit Assessment Stats-->
                          <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title" id="editModalLabel">Edit Assessment</h4>
                                          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body dark-modal">
                                          <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" id="editForm">
                                              @csrf
                                              <input type="hidden" id="editTaskId" name="id">
                                              <div class="col-12">
                                                  <label class="form-label" for="editTitle">Task</label>
                                                  <input class="form-control" id="editTitle" type="text" placeholder="Task" required="" name="title">
                                              </div>

                                              <div class="col-md-6">
                                                  <label class="form-label" for="editUnit">Unit (Satuan)</label>
                                                  <input class="form-control" id="editUnit" type="text" placeholder="Activity" required="" name="unit">
                                              </div>

                                              <div class="col-md-6">
                                                  <label class="form-label" for="editQuantity">Quantity</label>
                                                  <input class="form-control" id="editQuantity" type="number" min="1" step="1" placeholder="10" required="" name="target_quantity">
                                              </div>
                                                <div class="col-md-12">
                                                    <label class="form-label" for="staffSelect">Staff</label>
                                                    <select class="form-select" id="staffSelect" name="staff_id" required>
                                                        <option value="" disabled selected>Select staff</option>
                                                         @foreach($department_staff as $staff)
                                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please select a staff member.</div>
                                                    <div class="valid-feedback">Looks's Good!</div>
                                                </div>
                                              <div class="col-12">
                                                  <label class="form-label" for="editDescription">Description</label>
                                                  <textarea class="form-control" id="editDescription" placeholder="Enter your description" required="" name="description" style="height: 120px;"></textarea>
                                              </div>

                                              <div class="col-12">
                                                  <button class="btn btn-primary" type="submit">Save Changes</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- Offcanvas Edit Assessment Ends-->
                      </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar">
                      <table class="display table-striped border" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>staff</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($work_task as $wt)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{$wt->title}}</td>
                            <td>{{ \Illuminate\Support\Str::words($wt->description, 7, '...') }}</td>
                              <td>{{$wt->target_quantity}}</td>
                              <td>{{$wt->unit}}</td>
                              <td><span class="badge rounded-pill badge-success">{{$wt->staff->user->name}}</span></td>
                              <td> 
                                <ul class="action"> 
                                  <li class="edit" data-id="{{ $wt->id }}">
                                      <a href="#!"><i class="fa-regular fa-pen-to-square"></i></a>
                                  </li>
                                  
                                  <li class="delete" data-id="{{ $wt->id }}">
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

    <script src="{{ asset('dashboard/assets/js/form-validation-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables1.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom2.js')}}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        let aiClickCount = 0;
        document.getElementById('ai-joke-btn').addEventListener('click', function() {
          aiClickCount++;
          if (aiClickCount === 1) {
            Swal.fire({
              icon: 'info',
              title: 'Loading...',
              text: "AI is generating your description. Please wait a moment!",
              showConfirmButton: false,
              allowOutsideClick: false,
              allowEscapeKey: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });
            setTimeout(() => Swal.close(), 1500);
          } else if (aiClickCount === 2) {
            Swal.fire({
              icon: 'info',
              title: 'Still Loading...',
              text: "Letting AI do the work again? Give it a second, it's thinking hard for you!",
              showConfirmButton: false,
              allowOutsideClick: false,
              allowEscapeKey: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });
            setTimeout(() => Swal.close(), 1500);
          } else {
            Swal.fire({
              icon: 'warning',
              title: 'Give Your Brain a Chance!',
              text: "Don't rely on AI all the time—your brain needs exercise too! 😅",
              confirmButtonText: 'Alright, I get it!'
            });
          }
        });
      });
    </script>
    {{-- Update --}}
    <script>
      $(document).ready(function () {
        let originalEditData = {};

        // Event listener untuk tombol edit di tabel
        $(".edit").on("click", function () {
          var taskId = $(this).data("id"); // Ambil ID dari tombol edit yang diklik

          // AJAX untuk mengambil data task berdasarkan ID
          $.ajax({
            url: '/assessment/' + taskId + '/edit',  // Endpoint untuk mendapatkan data task
            method: 'GET',
            success: function (data) {
              // Simpan data asli untuk pengecekan perubahan
              originalEditData = {
                id: data.id,
                title: data.title,
                unit: data.unit,
                target_quantity: data.target_quantity,
                description: data.description
              };

              // Isi form modal dengan data yang diterima
              $('#editTaskId').val(data.id);
              $('#editTitle').val(data.title);
              $('#editUnit').val(data.unit);
              // $('#editCategory').val(data.category_id); // Uncomment jika ada field kategori di form edit
              $('#editQuantity').val(data.target_quantity);
              $('#editDescription').val(data.description);

              // Pilih staff berdasarkan data.staff_id
                $('#staffSelect').val(data.staff_id);

              // Tampilkan modal edit
              $('#editModal').modal('show');
            },
            error: function (error) {
              console.log(error);
              Swal.fire(
                'Error!',
                'Failed to fetch task data. Please try again.',
                'error'
              );
            }
          });
        });

        // Handle submit form edit
        $('#editForm').on('submit', function (e) {
          e.preventDefault();

          // Ambil data form saat ini
          var currentData = {
            id: $('#editTaskId').val(),
            title: $('#editTitle').val(),
            unit: $('#editUnit').val(),
            // category_id: $('#editCategory').val(), // Uncomment jika ada field kategori di form edit
            target_quantity: $('#editQuantity').val(),
            description: $('#editDescription').val()
          };

          // Cek apakah ada perubahan
          let changed = false;
          for (let key in originalEditData) {
            if (originalEditData[key] != currentData[key]) {
              changed = true;
              break;
            }
          }

          if (!changed) {
            Swal.fire(
              'No Changes',
              'No changes detected. Please modify the data before saving.',
              'info'
            );
            return;
          }

          var formData = $(this).serialize(); // Ambil data form

          $.ajax({
            url: '/assessment/' + $('#editTaskId').val(),  // Endpoint untuk menyimpan perubahan
            method: 'PUT',
            data: formData,
            success: function (data) {
              // Tutup modal
              $('#editModal').modal('hide');

              Swal.fire(
                'Success!',
                'Task updated successfully.',
                'success'
              ).then(() => {
                location.reload(); // reload halaman jika diperlukan
              });
            },
            error: function (error) {
              console.log(error);
              Swal.fire(
                'Error!',
                'Failed to update task. Please try again.',
                'error'
              );
            }
          });
        });
      });
    </script>
    {{-- Delete --}}
    <script>
      $(document).ready(function () {
          // Event listener untuk tombol delete di tabel
          $(".delete").on("click", function () {
              var taskId = $(this).data("id"); // Ambil ID dari tombol delete yang diklik

              // Konfirmasi menggunakan SweetAlert
              Swal.fire({
                  title: 'Are you sure?',
                  text: "This action cannot be undone!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'Cancel'
              }).then((result) => {
                    if (result.isConfirmed) {
                      // Jika user konfirmasi, lakukan AJAX untuk hapus data
                      $.ajax({
                        url: '/assessment/' + taskId,  // Endpoint untuk hapus task
                        method: 'DELETE',
                        data: {
                          _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                          Swal.fire(
                            'Deleted!',
                            'Task deleted successfully.',
                            'success'
                          ).then(() => {
                            location.reload(); // Reload halaman setelah penghapusan
                          });
                        },
                        error: function (error) {
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

    
   
@endsection