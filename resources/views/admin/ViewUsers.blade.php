@extends('layouts.SidebarAdmin')

@section('content')
<head>
    <style>
        .container {
            margin-top: 50px;
            margin-left:20px;
            margin-right:20px;
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
@if(session('success'))
    <div id="flash-message" class="alert alert-success" role="alert" style="opacity: 1; transition: opacity 5s ease-in-out;background-color: #28a745; color: #fff; padding: 10px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    <script>
        // Automatically close the flash message after 5 seconds
        setTimeout(function() {
            document.getElementById('flash-message').style.display = 'none';
        }, 5000);
    </script>
@endif

    <div class="container">
        <h1 class="mb-4">Users</h1>
        <a href="{{ route('admin.users.create') }}"  style="margin-bottom: 20px;margin-left: 87%; display: inline-block; font-weight: 400; color: #fff; text-align: center;
              vertical-align: middle; user-select: none; background-color: #139C49;
              border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem;
              line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out,
              background-color 0.15s ease-in-out, border-color 0.15s ease-in-out,
              box-shadow 0.15s ease-in-out; text-decoration: none; position: relative;
              overflow: hidden;">
    Create New User
</a>

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
                                Commercial
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" style="margin-bottom:20px;display: inline-block; font-weight: 400; color: #fff; text-align: center;
          vertical-align: middle; user-select: none; background-color: #11101D;
          border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem;
          line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out,
          background-color 0.15s ease-in-out, border-color 0.15s ease-in-out,
          box-shadow 0.15s ease-in-out; text-decoration: none; position: relative;
          overflow: hidden;">Edit</a>
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="margin-bottom:20px;display: inline-block; font-weight: 400; color: #fff; text-align: center;
          vertical-align: middle; user-select: none; background-color: #D1485F;
          border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem;
          line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out,
          background-color 0.15s ease-in-out, border-color 0.15s ease-in-out,
          box-shadow 0.15s ease-in-out; text-decoration: none; position: relative;
          overflow: hidden;" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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
