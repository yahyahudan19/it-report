@extends('layouts.template')

@section('title')
    Category
@endsection

@section('plugins-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/select/bootstrap-select.min.css')}}">
    
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Category</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Management</li>
                            <li class="breadcrumb-item active">Category</li>
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
                                <h5>Category</h5>
                                <p class="f-m-light mt-1">Category management helps organize tasks or issues into specific
                                    groups, such as hardware, network, software, SIMRS, and others, for easier tracking and
                                    reporting.</p>
                            </div>
                            <div class="card-header-right-icon">
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg"><i class="fa-solid fa-plus pe-2"></i>Add
                                    Category</button>
                                <!-- Offcanvas Create Category Stats-->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="myExtraLargeModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myExtraLargeModal">Add Category</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" novalidate=""
                                                    method="POST" action="{{ route('category.store') }}">
                                                    @csrf
                                                    <div class="col-12">
                                                        <label class="form-label" for="validationCustom01">Name</label>
                                                        <input class="form-control" id="validationCustom01" type="text"
                                                            placeholder="ur task" required="" name="name">
                                                        <div class="invalid-feedback">Please enter your valid </div>
                                                        <div class="valid-feedback">
                                                            Looks's Good!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label" for="description">Description</label>
                                                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" required
                                                            rows="3"></textarea>
                                                        <div class="invalid-feedback">Please enter a valid description</div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                                        <button class="btn btn-danger" type="button"
                                                            id="ai-joke-btn">Generate Description using AI </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Offcanvas Create Category Ends-->

                                <!-- Offcanvas Edit Category Stats-->
                                <!-- Edit Category Modal -->
                                <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="editCategoryLabel">Edit Category</h4>
                                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body dark-modal">
                                                <form class="row g-3 needs-validation custom-input" id="editCategoryForm"
                                                    novalidate="" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="edit-category-id">
                                                    <div class="col-12">
                                                        <label class="form-label" for="edit-category-name">Name</label>
                                                        <input class="form-control" id="edit-category-name"
                                                            type="text" placeholder="Category name" required
                                                            name="name">
                                                        <div class="invalid-feedback">Please enter a valid name</div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label"
                                                            for="edit-category-description">Description</label>
                                                        <textarea class="form-control" id="edit-category-description" name="description" placeholder="Enter description"
                                                            required rows="3"></textarea>
                                                        <div class="invalid-feedback">Please enter a valid description
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-primary" type="submit">Update
                                                            Category</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Offcanvas Edit Category Ends-->

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display table-striped border" id="basic-6">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $cat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td>{{ $cat->description }}</td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="edit" data-id="{{ $cat->id }}">
                                                            <a href="#!"><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>

                                                        <li class="delete" data-id="{{ $cat->id }}">
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

    <!-- Ajax for editing category -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button click
            document.querySelectorAll('.action .edit').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const catId = this.getAttribute('data-id');
                    fetch(`/category/${catId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Fill form fields
                            document.getElementById('edit-category-id').value = data.id;
                            document.getElementById('edit-category-name').value = data.name;
                            document.getElementById('edit-category-description').value = data
                                .description;
                            // Set form action
                            document.getElementById('editCategoryForm').setAttribute('action',
                                `/category/${data.id}`);
                            // Show modal
                            var editModal = new bootstrap.Modal(document.getElementById(
                                'editCategoryModal'));
                            editModal.show();
                        })
                        .catch(() => {
                            Swal.fire('Error', 'Failed to fetch category data.', 'error');
                        });
                });
            });
        });
    </script>

    <!-- Ajax for deleting category -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.action .delete').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const catId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This category will be deleted permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff0000',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/category/${catId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        _token: '{{ csrf_token() }}'
                                    })
                                })
                                .then(response => {
                                    if (response.ok) {
                                        Swal.fire('Deleted!',
                                                'Category has been deleted.', 'success')
                                            .then(() => {
                                                location.reload();
                                            });
                                    } else {
                                        return response.json().then(data => {
                                            throw new Error(data.message ||
                                                'Failed to delete category.'
                                                );
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error', error.message, 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
@endsection
