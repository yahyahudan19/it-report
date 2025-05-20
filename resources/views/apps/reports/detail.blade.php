@extends('layouts.template')

@section('title')
Details Reports
@endsection

@section('plugins-head')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>
            Detail Report</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">
                <svg class="stroke-icon">
                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                </svg></a></li>
            <li class="breadcrumb-item">Application</li>
            <li class="breadcrumb-item">Report</li>
            <li class="breadcrumb-item active">Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card create-project-form custom-input">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <form class="row g-3 needs-validation" novalidate="" method="POST" enctype="multipart/form-data"
                  action="{{ route('report.update', $report->id) }}">
                  @csrf
                  @method('PUT')
                  <div class="col-md-6">
                    <label class="form-label" for="reporterTypeahead">Reporter</label>
                    <input type="text" class="form-control" id="reporterTypeahead"
                      placeholder="Type to search reporter..." autocomplete="off"
                      required value="{{ old('reporter_name', $report->reporter->user->name) }}">
                    <input type="hidden" name="reporter_id" id="reporterId" value="{{ old('reporter_id', $report->reporter_id) }}">
                    <div class="invalid-feedback">Please select a reporter.</div>
                    <div id="reporterSuggestions"
                      class="list-group position-absolute w-100"
                      style="z-index: 1000; display: none;"></div>
                  </div>

                  <div class="col-md-6 position-relative">
                    <label class="form-label" for="locationTypeahead">Location</label>
                    <input type="text" class="form-control" id="locationTypeahead"
                      placeholder="Type to search location..." autocomplete="off"
                      required value="{{ old('location_name', $report->room->name) }}">
                    <input type="hidden" name="location_id" id="locationId" value="{{ old('location_id', $report->location_id) }}">
                    <div class="invalid-feedback">Please select a location.</div>
                    <div id="locationSuggestions"
                      class="list-group position-absolute w-100"
                      style="z-index: 1000; display: none;"></div>
                  </div>


                  <div class="col-lg-6 col-md-6">
                    <label class="form-label" for="projectType">Priority</label>
                    <select class="form-select" id="projectType" name="priority" required>
                      <option disabled value="">Choose...</option>
                      <option value="critical" @selected($report->priority === 'critical')>Critical</option>
                      <option value="high" @selected($report->priority === 'high')>High</option>
                      <option value="medium" @selected($report->priority === 'medium')>Medium</option>
                      <option value="low" @selected($report->priority === 'low')>Low</option>
                    </select>
                    <div class="invalid-feedback">Please select a Priority</div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <label class="form-label" for="reportDate">Report Date</label>
                    <input class="form-control" id="report_date" type="text"
                      name="report_date" value="{{ old('report_date', $report->report_date) }}" required>
                    <div class="invalid-feedback">Please provide a valid date and time.</div>
                  </div>

                  <div class="col-12">
                    <label class="form-label" for="validationTextarea">Issue</label>
                    <textarea class="form-control" id="validationTextarea" placeholder="Enter Project details" required="" rows="4">{{$report->issue}}</textarea>
                    <div class="invalid-feedback">Please enter your project details.</div>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="formFileMultiple">New Attachment</label>
                    <input class="form-control" id="formFileMultiple" type="file" multiple="" name="attachments[]">
                    <div class="invalid-feedback">Please select your files.</div>
                  </div>
                  <div class="col-6">
                    <label class="form-label" for="formFileMultiple">Attachment</label>
                    <div class="d-flex flex-row flex-wrap gap-3"> <!-- flex-wrap untuk responsif -->
                      @if ($report->attachments->isEmpty())
                          <p>No attachments available.</p>
                      @else
                          @foreach ($report->attachments as $attachment)
                              <div class="attachment-file common-flex" style="min-width: 200px;">
                                  <div class="common-flex align-items-center">
                                    @if ($attachment->file_type == 'image/png' || $attachment->file_type == 'image/jpeg')
                                      <img class="img-fluid" src="{{ asset('dashboard/assets/images/project/files/png.png')}}" alt="png">
                                    @else
                                      <img class="img-fluid" src="{{ asset('dashboard/assets/images/project/files/pdf.png')}}" alt="pdf">
                                    @endif
                                      <div class="d-block"> 
                                          <p class="mb-0">Attachment File</p>
                                          <p class="c-o-light">{{ $attachment->size_kb }} KB</p>
                                      </div>
                                  </div>
                                  <a href="{{ asset('storage/' . $attachment->file_path) }}" download target="_blank">
                                      <i class="fa-solid fa-download f-light"></i>
                                  </a>
                              </div>
                          @endforeach
                      @endif
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label" for="formFileMultiple">Assigned Staff</label>
                    <div class="d-flex flex-row flex-wrap gap-3"> <!-- flex-wrap untuk responsif -->
                      @if ($report->staff->isEmpty())
                        <button class="btn btn-danger position-relative" type="button">No Assigned Staff </button>
                      @else
                          @foreach ($report->staff as $st)
                              <div class="attachment-file common-flex" style="min-width: 250px;">
                                  <div class="common-flex align-items-center">
                                      <img class="img-fluid" src="{{ asset('dashboard/assets/images/avtar/4.jpg')}}" alt="pdf">
                                      <div class="d-block"> 
                                          <p class="mb-0">{{ explode('@', $st->user->email)[0] }}</p>
                                          @if ($st->pivot->status == 'accept')
                                            <span class="badge badge-success">{{$st->pivot->status}} </span>
                                          @else
                                            <span class="badge badge-warning">{{$st->pivot->status}} </span>
                                          @endif
                                            <a href="#" class="badge badge-primary">Detail </a>
                                      </div>
                                  </div>
                                 <a href="#" class="btn-delete-assignment" data-id="{{ $st->pivot->id }}" title="Delete Assignment">
                                    <i class="fa-solid fa-trash-alt f-light"></i>
                                </a>
                              </div>
                          @endforeach
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="card-body visual-button visual-button1 common-flex justify-content-end">
                      <button class="btn btn-primary" type="submit"><i data-feather="alert-triangle"></i> Update</button>
                      <button type="button" data-bs-toggle="modal" data-bs-target=".bd-assign-modal-lg" data-report-id="{{ $report->id }}" data-room-id="{{ $report->room->id }}" href="#" class="btn btn-warning"><i data-feather="alert-triangle"> 
                      </i>Assign</button>
                      <a href="/report" class="btn btn-secondary"><i data-feather="arrow-left-circle"></i>Back</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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
                  <div class="col-md-6">
                    <label class="form-label" for="assignmenStaff">Assign To</label>
                    <select id="assignmenStaff" name="assignmenStaff[]" class="form-control" multiple required>
                      @foreach ($reporter as $s)
                      <option value="{{ $s->id }}">{{ $s->user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="assignmenStatus">Status</label>
                    <select id="assignmenStatus" name="assignmenStatus" class="form-control" required>
                      <option value="accept">accept</option>
                      <option value="handling">handling</option>
                      <option value="done">done</option>
                      <option value="pending">pending</option>
                    </select>
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#report_date", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      time_24hr: true,
      defaultDate: "{{ old('report_date', $report->report_date) }}"
    });
  });
</script>

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

<!-- Script to handle the assign action -->
<script>
  $(document).ready(function() {
    // Ketika tombol assign diklik
    $("button[data-bs-target='.bd-assign-modal-lg']").on("click", function() {
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
</script>

<!-- Script to handle delete assign -->
<script>
  $(document).ready(function() {
      // Klik tombol Delete Assignment
      $(".btn-delete-assignment").on("click", function(e) {
          e.preventDefault();
          var assignmentId = $(this).data("id"); // Ambil ID assignment yang akan dihapus

          Swal.fire({
              title: 'Are you sure?',
              text: 'This assignment will be deleted!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '/assign/' + assignmentId, // Sesuaikan dengan route delete assignment
                      method: 'DELETE',
                      data: {
                          "_token": "{{ csrf_token() }}" // Kirim CSRF token
                      },
                      success: function(data) {
                          Swal.fire(
                              'Deleted!',
                              'The assignment has been deleted.',
                              'success'
                          ).then(() => {
                              location.reload(); // Reload halaman setelah sukses hapus
                          });
                      },
                      error: function(error) {
                          console.error(error);
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