@extends('layouts.SidebarAdmin')

@section('content')
<style>
    #main.flexbox-col.unique {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
    margin: 0;
}

#main.flexbox-col.unique .container {
    max-width: 600px;
    width: 100%;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

#main.flexbox-col.unique h1 {
    color: #333333;
    font-size: 24px;
    margin-bottom: 20px;
}

#main.flexbox-col.unique .form-group {
    margin-bottom: 15px;
    text-align: left;
}

#main.flexbox-col.unique .form-label {
    font-weight: 600;
    color: #555555;
    margin-bottom: 5px;
    display: block;
}

#main.flexbox-col.unique .form-control {
    border: 1px solid #cccccc;
    border-radius: 4px;
    padding: 10px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
}

#main.flexbox-col.unique .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

#main.flexbox-col.unique .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

#main.flexbox-col.unique .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

#main.flexbox-col.unique .mt-3 {
    margin-top: 1rem;
}

#main.flexbox-col.unique .mt-5 {
    margin-top: 3rem;
}

#main.flexbox-col.unique .mb-3,
#main.flexbox-col.unique .mb-4 {
    margin-bottom: 1rem;
}

#main.flexbox-col.unique .mb-4 {
    margin-bottom: 1.5rem;
}

</style>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit User</h1>
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Qualificateur</option>
                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Commercial</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</body>
@endsection

@section('profilename')
SaifeddineNajmi
@endsection
