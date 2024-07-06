<!-- resources/views/activity/logs.blade.php -->

@extends('layouts.navbar')

@section('content')

<style>
    /* Table container styling */
    .container {
        margin-top: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Table header styling */
    .table thead th {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 10px;
    }

    /* Table row styling */
    .table tbody tr {
        transition: background-color 0.3s;
    }

    /* Table row hover effect */
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Table cell styling */
    .table tbody td {
        padding: 10px;
        text-align: center;
        border-top: 1px solid #dee2e6;
    }

    /* Table number column styling */
    .table tbody td:first-child {
        font-weight: bold;
    }

    /* Table description and changes column styling */
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(6) {
        text-align: left;
    }

    /* Table date column styling */
    .table tbody td:last-child {
        font-style: italic;
    }
</style>

<div class="container">
    <h1>Activity Logs</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Log Name</th>
                <th>Description</th>
                <th>Causer</th>
                <th>Targeted</th>
                <th>Changes</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->log_name }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ optional($log->causer)->name ?? 'System' }}</td>
                <td>{{ optional($log->subject)->name ?? 'N/A' }}</td>
                <td>
                    @if(isset($log->changes['attributes']))
                        @foreach ($log->changes['attributes'] as $attribute => $value)
                            @if($attribute === 'status' && is_array($value))
                                @if(array_key_exists('old', $value) && array_key_exists('new', $value))
                                    Old status: {{ $value['old'] }}<br>
                                    New status: {{ $value['new'] }}<br>
                                @else
                                    {{ $attribute }}: {{ implode(' -> ', $value) }}<br>
                                @endif
                            @else
                                {{ $attribute }}: {{ is_array($value) ? implode(' -> ', $value) : $value }}<br>
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
