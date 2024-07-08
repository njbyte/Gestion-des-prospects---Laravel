<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity Logs - PDF Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 6px; /* Adjusted padding */
            text-align: left;
            font-size: 12px; /* Adjusted font size */
        }
        th {
            background-color: #f2f2f2;
        }
        .icon-arrow {
            vertical-align: middle;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h1>Activity Logs</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Log Name <span class="icon-arrow">&UpArrow;</span></th>
                <th>Description <span class="icon-arrow">&UpArrow;</span></th>
                <th>Causer <span class="icon-arrow">&UpArrow;</span></th>
                <th>Target <span class="icon-arrow">&UpArrow;</span></th>
                <th>From <span class="icon-arrow">&UpArrow;</span></th>
                <th>To <span class="icon-arrow">&UpArrow;</span></th>
                <th>Date <span class="icon-arrow">&UpArrow;</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($log->log_name == 0)
                        Admin
                    @elseif ($log->log_name == 1)
                        Qualificateur
                    @elseif ($log->log_name == 2)
                        Commercial
                    @else
                        Unknown Role
                    @endif
                </td>
                <td>{{ $log->description }}</td>
                <td>{{ optional($log->causer)->name ?? 'System' }}</td>
                <td>{{ optional($log->subject)->name ?? 'N/A' }}</td>
                <td>
                    @if ($log->description == "Prospect Update")
                        @if (isset($log->properties['from']))
                            @if ($log->properties['from'] == 0)
                                Nouveau
                            @elseif ($log->properties['from'] == 1)
                                Qualifié
                            @elseif ($log->properties['from'] == 2)
                                Rejeté
                            @elseif ($log->properties['from'] == 3)
                                Converti
                            @else
                                Cloturé
                            @endif
                        @else
                            N/A
                        @endif
                    @else
                        @if (isset($log->properties['old']))
                            @if (is_array($log->properties['old']))
                                @foreach ($log->properties['old'] as $attribute => $value)
                                    @if ($attribute == 'role')
                                        @if ($value == 0)
                                            {{ $attribute }}: Admin
                                        @elseif ($value == 1)
                                            {{ $attribute }}: Qualificateur
                                        @elseif ($value == 2)
                                            {{ $attribute }}: Commercial
                                        @else
                                            {{ $attribute }}: Unknown Role
                                        @endif
                                    @else
                                        {{ $attribute }}: {{ $value }}
                                    @endif
                                    <br>
                                @endforeach
                            @else
                                {{ $log->properties['old'] }}
                            @endif
                        @else
                            N/A
                        @endif
                    @endif
                </td>
                <td>
                    @if ($log->description == "Prospect Update")
                        @if (isset($log->properties['to']))
                            @if ($log->properties['to'] == 0)
                                Nouveau
                            @elseif ($log->properties['to'] == 1)
                                Qualifié
                            @elseif ($log->properties['to'] == 2)
                                Rejeté
                            @elseif ($log->properties['to'] == 3)
                                Converti
                            @else
                                Cloturé
                            @endif
                        @else
                            N/A
                        @endif
                    @else
                        @if (isset($log->properties['new']))
                            @if (is_array($log->properties['new']))
                                @foreach ($log->properties['new'] as $attribute => $value)
                                    @if ($attribute == 'role')
                                        @if ($value == 0)
                                            {{ $attribute }}: Admin
                                        @elseif ($value == 1)
                                            {{ $attribute }}: Qualificateur
                                        @elseif ($value == 2)
                                            {{ $attribute }}: Commercial
                                        @else
                                            {{ $attribute }}: Unknown Role
                                        @endif
                                    @else
                                        {{ $attribute }}: {{ $value }}
                                    @endif
                                    <br>
                                @endforeach
                            @else
                                {{ $log->properties['new'] }}
                            @endif
                        @else
                            N/A
                        @endif
                    @endif
                </td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
