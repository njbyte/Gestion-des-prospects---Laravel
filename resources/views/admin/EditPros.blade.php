@extends('layouts.navbar')

@section('content')
<style>
/* custom.css */

/* Form container */
.container {
    max-width: 600px;
    margin: 5px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    -webkit-border-top-left-radius: 55px;
-webkit-border-bottom-right-radius: 55px;
-moz-border-radius-topleft: 55px;
-moz-border-radius-bottomright: 55px;
border-top-left-radius: 55px;
border-bottom-right-radius: 55px;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 16px;
    font-size: 14px;
}

.form-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="%23808080" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12"><path d="M11.8 3.2a.75.75 0 0 0-1.06 0L6 8.94 1.26 4.2a.75.75 0 1 0-1.06 1.06l5 5a.75.75 0 0 0 1.06 0l5-5a.75.75 0 0 0 0-1.06" fill-rule="evenodd"></path></svg>');
    background-repeat: no-repeat;
    background-position-x: calc(100% - 10px);
    background-position-y: 50%;
    padding-right: 30px;
}

.btn-primary {
    background-color: #FF9800;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #4CAF50;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.has-error .form-control {
    border-color: #ff0000;
}

/* Ensure the form is hidden initially */
.hidden {
    display: none;
}

/* Overlay effect for the background */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999; /* Higher than other elements */
    display: none;
}

/* Style for the form container to be centered */
.form-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;

    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Higher than the overlay */
    width: 90%; /* Adjust as needed */
    max-width: 500px;
}

/* To blur the background when the form is active */
body.blur {
    filter: blur(50px);
    overflow: hidden; /* Prevent scrolling */
}
/* Add any other custom styles you'd like! */

</style>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Prospect</h1>
        <form method="POST" action="{{ route('admin.prospect.update', $prospect->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $prospect->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $prospect->email }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="0" {{ $prospect->status == 0 ? 'selected' : '' }}>Nouveau</option>
                    <option value="1" {{ $prospect->status == 1 ? 'selected' : '' }}>Qualifié</option>
                    <option value="2" {{ $prospect->status == 2 ? 'selected' : '' }}>Rejeté</option>
                    <option value="3" {{ $prospect->status == 3 ? 'selected' : '' }}>Converti</option>
                    <option value="4" {{ $prospect->status == 4 ? 'selected' : '' }}>Cloturé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Prospect</button>
            <button type="button" id="cancelButton" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</body>
<script type="text/javascript">
        function openForm() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('form-container').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('form-container').style.display = 'none';
            document.body.style.overflow = 'auto'; // Allow scrolling
        }

        document.getElementById('cancelButton').addEventListener('click', function() {
            window.history.back();
        });

        // Assuming you have a button or some trigger to open the form
        // Example: document.getElementById('editButton').addEventListener('click', openForm);
    </script>
@endsection

@section('profilename')
{{ $userName }}
@endsection

@section('role')
Admin
@endsection
