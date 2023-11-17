@extends('layouts.app')

@section('title', 'Companies')
@section('meta_description', 'View and manage companies in your application')

@section('content')

<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">

<!-- Title -->
<h1>Companies</h1>

<!-- Button for adding companies -->
<div class="justify-content-end d-flex">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
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
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Logo</th>
            <th scope="col">Website</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>@if($company->logo)
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" width="100" height="100">
                @else
                    No Logo
                @endif</td>
            <td>{{ $company->website }}</td>
           
            <td>
                <button class="btn btn-success btn-custom" data-bs-toggle="modal" data-bs-target="#editCompanyModal{{ $company->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg> Edit
                </button>
                <button class="btn btn-danger btn-custom" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal{{ $company->id }}">
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
<div class="pagination-custom">{{ $companies->links() }}</div>

<!-- Add Company Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompanyModalLabel">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Company Creation Form -->
                <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Logo -->
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo (minimum 100x100)</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                    </div>

                    <!-- Website -->
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" id="website" name="website" required>
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

<!-- Edit and Delete Company Modals (Loop through each company) -->
@foreach($companies as $company)
<!-- Edit Company Modal -->
<div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCompanyModalLabel{{ $company->id }}">Edit Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit your company form here for company with ID {{ $company->id }} -->
                <form method="POST" action="{{ route('companies.update', ['company' => $company->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="edit-name{{ $company->id }}" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name{{ $company->id }}" name="name" value="{{ $company->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="edit-email{{ $company->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email{{ $company->id }}" name="email" value="{{ $company->email }}" required>
                    </div>

                    <!-- Logo -->
                    <div class="mb-3">
                        <label for="edit-logo{{ $company->id }}" class="form-label">Logo (minimum 100x100)</label>
                        <input type="file" class="form-control" id="edit-logo{{ $company->id }}" name="logo" accept="image/*">
                    </div>

                    <!-- Website -->
                    <div class="mb-3">
                        <label for="edit-website{{ $company->id }}" class="form-label">Website</label>
                        <input type="text" class="form-control" id="edit-website{{ $company->id }}" name="website" value="{{ $company->website }}" required>
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

<!-- Delete Company Modal -->
<div class="modal fade" id="deleteCompanyModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCompanyModalLabel{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCompanyModalLabel{{ $company->id }}">Delete Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the company "{{ $company->name }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="POST">
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
