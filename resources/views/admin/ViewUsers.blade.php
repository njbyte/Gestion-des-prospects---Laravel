@extends('layouts.SidebarAdmin')

@section('content')
<head>
    <style>
        .container {
            margin-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .actions {
            white-space: nowrap;
        }
        .btn {
            padding: 8px 12px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 0)
                                Admin
                            @elseif ($user->role == 1)
                                Qualificateur
                            @else
                                Coemmercial
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection

@section('profilename')
SaifeddineNajmi
@endsection
