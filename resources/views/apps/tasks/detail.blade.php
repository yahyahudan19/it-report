@extends('layouts.template')

@section('title')
    Detail Task
@endsection

@section('plugins-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/photoswipe.css')}}">
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Details Task</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">App</li>
                            <li class="breadcrumb-item">Tasks</li>
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
                                    action="{{ route('task.update', $task->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-6">
                                        <label class="form-label" for="staffTask">Staff</label>
                                        <input type="text" class="form-control" id="staffTask" value="{{ $task->staff->user->name }}" readonly> 
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label" for="taskAssessment">Task Assessment</label>
                                        <select class="form-select" id="taskAssessment" name="task_id" required>
                                        <option disabled value="">Choose...</option>
                                        @foreach($task_asses as $t)
                                            <option value="{{ $t->id }}" @selected(old('task_id', $task->task_id) == $t->id)>
                                            {{ $t->title }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a task assessment.</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="taskCategory">Category</label>
                                        <select class="form-select" id="taskCategory" name="category_id" required>
                                        <option disabled value="">Choose...</option>
                                        @foreach($category as $c)
                                            <option value="{{ $c->id }}" @selected(old('category_id', $task->category_id) == $c->id)>
                                            {{ $c->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a task assessment.</div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="statusTask">Status</label>
                                        <select class="form-select" id="statusTask" name="status" required>
                                        <option disabled value="">Choose...</option>
                                        <option value="done" @selected($task->status === 'done')>Done</option>
                                        <option value="progress" @selected($task->status === 'progress')>Progress</option>
                                        <option value="pending" @selected($task->status === 'pending')>Pending</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Status</div>
                                    </div>
                                    <div class="col-lg-2">   
                                        <label class="form-label" for="taskQuantity">Quantity</label>
                                        <input type="number" class="form-control" id="taskQuantity" name="quantity" value="{{ old('quantity', $task->quantity) }}" required>
                                        <div class="invalid-feedback">Please enter the quantity.</div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <label class="form-label" for="startTask">Start Time</label>
                                        <input class="form-control" id="start_time" type="text" value="" name="start_time" required>
                                        <div class="invalid-feedback">Please provide a valid date and time.</div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <label class="form-label" for="endTask">End Time</label>
                                        <input class="form-control" id="end_time" type="text" value="" name="end_time" required>
                                        <div class="invalid-feedback">Please provide a valid date and time.</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="descriptionTask">Description</label>
                                        <textarea class="form-control" id="descriptionTask" name="desc" rows="4">{{$task->task_description}}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="issuesTask">Task</label>
                                        <textarea class="form-control" id="issuesTask" rows="4" name="issue">{{$task->issues}}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="formFileMultiple">New Attachment</label>
                                        <input class="form-control" id="formFileMultiple" type="file" multiple="" name="attachments[]">
                                        <div class="invalid-feedback">Please select your files.</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="formFileMultiple">Attachment</label>
                                        <div class="d-flex flex-row flex-wrap gap-4">
                                            @if($task->attachments && count($task->attachments) > 0)
                                                @foreach($task->attachments as $attachment)
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
                                                <span class="badge bg-secondary">No attachments available for this Task.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="imageAttachment">Attachment Preview</label>
                                        <div class="d-flex flex-row flex-wrap gap-4">
                                            @if($task->attachments && count($task->attachments) > 0)
                                                @foreach($task->attachments as $attachment)
                                                    @if ($attachment->file_type == 'image/png' || $attachment->file_type == 'image/jpeg')
                                                        <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope="">
                                                            <a href="{{ asset('storage/' . $attachment->file_path) }}" itemprop="contentUrl" data-size="1600x950">
                                                                <img class="img-thumbnail" src="{{ asset('storage/' . $attachment->file_path) }}" itemprop="thumbnail" alt="Image description">
                                                            </a>
                                                        </figure>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">No image attachments available for this Task.</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card-body visual-button visual-button1 common-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit"><i data-feather="alert-triangle"></i> Update</button>
                                            <a href="/task/my" class="btn btn-secondary"><i data-feather="arrow-left-circle"></i>Back</a>
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
    <script src="{{ asset('dashboard/assets/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flat-pickr/custom-flatpickr.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/photoswipe/photoswipe.js')}}"></script>

   
    <!-- Flatpickr JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#start_time", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                time_24hr: true,
                defaultDate: "{{ old('start_time', $task->start_time) }}"
            });

            flatpickr("#end_time", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                time_24hr: true,
                defaultDate: "{{ old('end_time', $task->end_time) }}"
            });
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
