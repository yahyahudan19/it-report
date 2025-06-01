@extends('layouts.template')

@section('title')
Details Handling
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
            Detail Handling</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">
                <svg class="stroke-icon">
                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                </svg></a></li>
            <li class="breadcrumb-item">Application</li>
            <li class="breadcrumb-item">Handlling</li>
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
                  action="{{ route('handling.update', $handling->id) }}">
                  @csrf
                  @method('PUT')
                  <div class="col-md-4">
                    <label class="form-label" for="reporterHandling">Reporter</label>
                    <input type="text" class="form-control" id="reporterHandling" value="{{ $handling->report->reporter->user->name }}" readonly> 
                    <div class="invalid-feedback">Please select a reporter.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label" for="priorityHandling">Priority</label>
                    <input type="text" class="form-control" id="priorityHandling" value="{{ $handling->report->priority }}" readonly> 
                  </div>
                  <div class="col-md-4">
                    <label class="form-label" for="locationHandling">Location</label>
                    <input type="text" class="form-control" id="locationHandling" value="{{ $handling->report->room->name }}" readonly> 
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="validationTextarea">Issue</label>
                    <textarea class="form-control" id="validationTextarea" rows="4" readonly>{{$handling->report->issue}}</textarea>
                  </div>

                  <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="projectType">Status</label>
                    <select class="form-select" id="projectType" name="status" required>
                      <option disabled value="">Choose...</option>
                      <option value="handling" @selected($handling->status === 'handling')>Handling</option>
                      <option value="done" @selected($handling->status === 'done')>Done</option>
                      <option value="pending" @selected($handling->status === 'pending')>Pending</option>
                    </select>
                    <div class="invalid-feedback">Please select a Status</div>
                  </div>
                  <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="taskQuantity">Quantity</label>
                    <input type="number" class="form-control" id="taskQuantity" name="quantity" value="{{ old('quantity', $handling->quantity) }}" required>
                    <div class="invalid-feedback">Please enter the quantity.</div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                      <label class="form-label" for="handlingDate">Handling Time</label>
                      <input class="form-control" id="handling_time" type="text"
                          value=""
                          name="handling_time" required>
                      <div class="invalid-feedback">Please provide a valid date and time.</div>
                  </div>

                  <div class="col-lg-5 col-md-6">
                    <label class="form-label" for="taskAssessment">Task Assessment</label>
                    <select class="form-select" id="taskAssessment" name="task_id" required>
                      <option disabled value="">Choose...</option>
                      @foreach($task as $t)
                        <option value="{{ $t->id }}" @selected(old('task_id', $handling->task_id) == $t->id)>
                          {{ $t->title }}
                        </option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a task assessment.</div>
                  </div>

                  <div class="col-12">
                    <label class="form-label" for="validationTextarea">Action Taken</label>
                    <textarea class="form-control" id="validationTextarea" name="action_taken" required="" rows="4">{{$handling->action_taken}}</textarea>
                    <div class="invalid-feedback">Please enter your project details.</div>
                  </div>
                  <div class="col-12">
                      <label class="form-label" for="formFileMultiple">New Attachment</label>
                      <input class="form-control" id="formFileMultiple" type="file" multiple="" name="attachments[]">
                      <div class="invalid-feedback">Please select your files.</div>
                  </div>
                  <div class="col-12">
                      <label class="form-label" for="attachmentInput">Notifications Reporter :</label>
                      <div class="form-check form-switch">
                          <input class="form-check-input" id="flexSwitchCheckChecked" name="notification_reporter" type="checkbox" role="switch" {{ $handling->status === 'done' ? '' : 'checked' }}>
                          <label class="form-check-label" for="flexSwitchCheckChecked">Send Notification to Reporter ?</label>
                      </div>
                      <div class="invalid-feedback">Please upload.</div>
                  </div>
                 <div class="col-6">
                      <label class="form-label" for="formFileMultiple">Attachment</label>
                      <div class="d-flex flex-row flex-wrap gap-3">
                          @if($handling->attachments && count($handling->attachments) > 0)
                            @foreach($handling->attachments as $attachment)
                              <div class="attachment-file common-flex" style="min-width: 250px;">
                                <div class="common-flex align-items-center">
                                  @if ($attachment->file_type == 'image/png' || $attachment->file_type == 'image/jpeg')
                                    <img class="img-fluid" src="{{ asset('dashboard/assets/images/project/files/png.png')}}" alt="png">
                                  @else
                                    <img class="img-fluid" src="{{ asset('dashboard/assets/images/project/files/pdf.png')}}" alt="pdf">
                                  @endif
                                  <div class="d-block">
                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" download target="_blank" class="mb-0">Attachment File {{ $loop->iteration }}</a>
                                    <p class="c-o-light">{{ $attachment->size_kb }} KB</p>
                                  </div>
                                </div>
                               <a href="javascript:void(0);" 
                                    class="delete-attachment" 
                                    data-id="{{ $attachment->id }}" 
                                    data-url="{{ route('task.attachment.destroy', $attachment->id) }}">
                                    <i class="fa-solid fa-trash-alt f-light"></i>
                                </a>
                              </div>
                            @endforeach
                            @else
                            <span class="badge bg-secondary">No attachments available for this handling.</span>
                          @endif
                      </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="card-body visual-button visual-button1 common-flex justify-content-end">
                      <button class="btn btn-primary" type="submit"><i data-feather="alert-triangle"></i> Update</button>
                      <a href="/handling" class="btn btn-secondary"><i data-feather="arrow-left-circle"></i>Back</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
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

<!-- Flatpickr JS -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#handling_time", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      time_24hr: true,
      defaultDate: "{{ old('handling_time', $handling->handling_time) }}"
    });
  });
</script>

<!-- time set to device time -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Set input value to device time (local time) in format YYYY-MM-DD HH:mm
    const input = document.getElementById('handling_time');
      if (input && !input.value) {
          const now = new Date();
          const pad = n => n.toString().padStart(2, '0');
          const formatted = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}`;
          input.value = formatted;
      }
    });
</script>

<!-- JS for delete confirmation -->
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          document.querySelectorAll('.delete-attachment').forEach(function (button) {
              button.addEventListener('click', function () {
                  const url = this.dataset.url;

                  Swal.fire({
                      title: 'Are you sure you want to delete this file?',
                      text: "This action cannot be undone!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonText: 'Yes, delete!',
                      cancelButtonText: 'Cancel'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          $.ajax({
                              url: url,
                              type: 'DELETE',
                              data: {
                                  "_token": "{{ csrf_token() }}"
                              },
                              success: function(data) {
                                  Swal.fire('Terhapus!', data.message, 'success')
                                      .then(() => {
                                          location.reload();
                                      });
                              },
                              error: function() {
                                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
                              }
                          });
                      }
                  });
              });
          });
      });
  </script>


@endsection