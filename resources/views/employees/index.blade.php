@extends('layouts.app')

@section('title', 'Employees')
@section('meta_description', 'Crud operation with col Id, firstname, lastname, company, email, phone')

@section('content')

<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">


<!-- Title -->
<h1>Employees</h1>

<!-- Button for adding employees -->
<div class="justify-content-end d-flex">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg> Add
    </button>
</div>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Company</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->firstname }}</td>
            <td>{{ $employee->lastname }}</td>
            <td>{{ $employee->company->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
           
            <td>
                <button class="btn btn-success btn-custom" data-bs-toggle="modal" data-bs-target="#editEmployeeModal{{ $employee->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
                <button class="btn btn-danger btn-custom" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal{{ $employee->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg> Delete
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="pagination-custom">{{ $employees->links() }}</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Employee Creation Form -->
                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>

                    <!-- Company -->

                    <div class="mb-3">
                        <label for="company_id" class="form-label">Company</label>
                        <div class="input-group">
                            <select class="form-select" id="company_id" name="company_id" required>
                                <option value="" disabled selected>Select a Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if(old('company_id') == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- Other Fields (Add as needed) -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit and Delete Employee Modals (Loop through each employee) -->
@foreach($employees as $employee)
<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel{{ $employee->id }}">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit your employee form here for employee with ID {{ $employee->id }} -->
                <form method="POST" action="{{ route('employees.update', ['employee' => $employee->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="edit-firstname{{ $employee->id }}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit-firstname{{ $employee->id }}" name="firstname" value="{{ $employee->firstname }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="edit-lastname{{ $employee->id }}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit-lastname{{ $employee->id }}" name="lastname" value="{{ $employee->lastname }}" required>
                    </div>

                    <!-- Company -->
                    <div class="mb-3">
                        <label for="edit-company_id{{ $employee->id }}" class="form-label">Company</label>
                        <div class="input-group">
                            <select class="form-select" id="edit-company_id{{ $employee->id }}" name="company_id" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($employee->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="edit-email{{ $employee->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email{{ $employee->id }}" name="email" value="{{ $employee->email }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="edit-phone{{ $employee->id }}" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="edit-phone{{ $employee->id }}" name="phone" value="{{ $employee->phone }}" required>
                    </div>

                    <!-- Other Fields (Add as needed) -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Employee Modal -->
<div class="modal fade" id="deleteEmployeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEmployeeModalLabel{{ $employee->id }}">Delete Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the employee "{{ $employee->firstname }} {{ $employee->lastname }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
