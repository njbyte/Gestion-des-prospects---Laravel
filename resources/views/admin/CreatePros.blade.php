<!-- resources/views/users/create.blade.php -->

@extends('layouts.SidebarAdmin')

@section('content')
<style>
    /* custom.css */

/* Form container */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Form labels */
.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

/* Form input fields */
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 16px;
    font-size: 14px;
}

/* Form select dropdown */
.form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 16px;
    font-size: 14px;
}

/* Form submit button */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Error styles (customize as needed) */
.has-error .form-control {
    border-color: #ff0000;
}

/* Add any other custom styles you'd like! */
.btn-primary {
    display: block;
    margin: 0 auto;
}
</style>
<div class="container mt-5">
        <h1>Create New Prospect</h1>

        <form method="POST" action="{{ route('admin.prospect.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="0">Nouveau</option>
                    <option value="1">Qualifié</option>
                    <option value="2">Rejeté</option>
                    <option value="3">Converti</option>
                    <option value="4">Cloturé</option>

                </select>
            </div>



            <button type="submit" class="btn btn-primary">Create Prospect</button>
        </form>
    </div>
@endsection

@section('profilename')
SaifeddineNajmi
@endsection
