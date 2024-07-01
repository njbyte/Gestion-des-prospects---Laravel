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


<form method="GET" action="{{ route('comm.prospects') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" style="padding: 8px; width: 300px;">
        <button type="submit" style="padding: 8px 12px; background-color: #139C49; color: white; border: none; border-radius: 0.25rem;">Search</button>
    </form>
    <a href="{{ route('comm.prospect.export', ['format' => 'txt']) }}" class="btn btn-secondary">Export as Text</a>
    <a href="{{ route('comm.prospect.export', ['format' => 'pdf']) }}" class="btn btn-danger">Export as PDF</a>

    <a href="{{ route('comm.prospect.export', ['format' => 'xlsx']) }}" class="btn btn-success" style="margin-right: 10px;">Export as XLSX</a>
    <a href="{{ route('comm.prospect.export', ['format' => 'csv']) }}" class="btn btn-info">Export as CSV</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                <th onclick="sortTable(0)">>ID</th>
                    <th onclick="sortTable(1)">>Name</th>
                    <th onclick="sortTable(2)">>Email</th>
                    <th onclick="sortTable(3)">>Status</th>
                    <th onclick="sortTable(4)" >>Created At</th>
                    <th onclick="sortTable(5)">>Updated At</th>
                    <th>>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>

                @foreach($prospects as $prospect)
                    <tr>
                        <td>{{ $prospect->id }}</td>
                        <td>{{ $prospect->name }}</td>
                        <td>{{ $prospect->email }}</td>
                        <td>
                        @if ($prospect->status == 0) <!-- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->
                            Nouveau
                        @elseif ($prospect->status == 1)
                            Qualifié
                        @elseif ($prospect->status == 2)
                            Rejeté
                        @elseif ($prospect->status == 3)
                            Converti
                        @else
                            Cloturé
                        @endif

                        </td>
                        <td>{{ $prospect->created_at }}</td>
                        <td>{{ $prospect->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->

                            @if ($prospect->status == 1)
                            <a href="{{ route('comm.prospect.edit', ['prospect' => $prospect->id]) }}" ><svg style="height:30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
    let sortDirection = 1; // 1 for ascending, -1 for descending

    function sortTable(columnIndex) {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        rows.sort((a, b) => {
            const aValue = a.cells[columnIndex].textContent.trim();
            const bValue = b.cells[columnIndex].textContent.trim();

            // You can customize the sorting logic based on your data type (e.g., numeric, string, date)
            const comparison = aValue.localeCompare(bValue) * sortDirection;

            // For numeric sorting:
            // const comparison = (parseFloat(aValue) - parseFloat(bValue)) * sortDirection;

            return comparison;
        });

        // Clear the existing table rows
        table.querySelector('tbody').innerHTML = '';

        // Append the sorted rows back to the table
        rows.forEach(row => table.querySelector('tbody').appendChild(row));

        // Toggle the sort direction for the next click
        sortDirection *= -1;
    }
</script>
</body>
@endsection

@section('profilename')
SaifeddineNajmi
@endsection

@section('role')
Commercial
@endsection
