@extends('layouts.navbar')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert | Export html Table to CSV & EXCEL File</title>

<link rel="stylesheet" href="{{ asset('css/qualifVP.css') }}">
<style>
    .alert {
            position: fixed;
            top:20px;
            right: 30px;
            transform: translateX(-50%);
            z-index: 1000;
            opacity: 1;
            transition: opacity 5s ease-in-out, visibility 5s ease-in-out;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            visibility: visible;
            border: 1px solid #1e7e34;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 16px;
    line-height: 1.5;
        }

        .alert.hide {
            opacity: 0;
            visibility: hidden;
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
    <main class="table" id="customers_table">

        <section class="table__header">


            <h1>Prospects</h1>

            <div class="input-group">

                <input type="search" placeholder="Search Data...">
                <img src="{{ asset('images/search.png') }}" alt="">

            </div>


            <div class="export__file">


<label for="export-file" title="Export File" style="display: inline-block;">
  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/>
  </svg>
</label>

                <input type="checkbox" id="export-file">
                <div class="export__file-options">

                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" id="toPDF" class="btn btn-danger">
                            <img src="{{ asset('images/pdf.png') }}" alt="PDF Icon">
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('qualif.prospect.export', ['format' => 'txt']) }}">
                                <img src="{{ asset('images/json.png') }}" alt="JSON Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('qualif.prospect.export', ['format' => 'csv']) }}">
                                <img src="{{ asset('images/csv.png') }}" alt="CSV Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('qualif.prospect.export', ['format' => 'xlsx']) }}">
                                <img src="{{ asset('images/excel.png') }}" alt="Excel Icon">
                            </a>
                        </button>
                    </label>
                </div>
            </div>

        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Created At <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Updated At <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($prospects as $prospect)
                    <tr>
                        <td>{{ $prospect->id }}</td>
                        <td>{{ $prospect->name }}</td>
                        <td>{{ $prospect->email }}</td>
                        <td>
                        <p class="
                        @if ($prospect->status== 0)
                        status nouveau
                        @elseif ($prospect->status == 1) status qualifie
                        @elseif ($prospect->status == 2) status rejete
                        @elseif ($prospect->status == 3) status converti
                        @else status cloture
                        @endif">

                        @if ($prospect->status == 0)
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
                        </p>
                        </td>
                        <td>{{ $prospect->created_at }}</td>
                        <td>{{ $prospect->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('qualif.prospect.edit', ['prospect' => $prospect->id]) }}" style="margin-right: 10px; display: inline-block;">
    <svg style="height:20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/>
    </svg>
</a>






                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>

        </section>

    </main>

    <script>
         document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('.input-group input');
        const tableRows = document.querySelectorAll('tbody tr');

        // Add event listener to search input
        searchInput.addEventListener('input', searchTable);

        function searchTable() {
            const searchTerm = searchInput.value.trim().toLowerCase();

            tableRows.forEach((row, i) => {
                let rowData = row.textContent.toLowerCase();
                let shouldShow = rowData.includes(searchTerm);

                if (shouldShow) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });

            // Reset background colors and apply alternating colors to visible rows
            let visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
            visibleRows.forEach((visibleRow, i) => {
                visibleRow.style.backgroundColor = i % 2 === 0 ? 'transparent' : '#0000000b';
            });
        }
    });
// 2. Sorting | Ordering data of HTML table


    document.addEventListener('DOMContentLoaded', function () {
        const tableHeadings = document.querySelectorAll('thead th');
        const tableRows = document.querySelectorAll('tbody tr');

        let sortAsc = true;

        tableHeadings.forEach((head, i) => {
            head.addEventListener('click', () => {
                // Remove 'active' class from all headings
                tableHeadings.forEach(head => head.classList.remove('active'));

                // Add 'active' class to clicked heading
                head.classList.add('active');

                // Remove 'active' class from all cells
                document.querySelectorAll('td').forEach(td => td.classList.remove('active'));

                // Add 'active' class to cells in the sorted column
                tableRows.forEach(row => {
                    row.querySelectorAll('td')[i].classList.add('active');
                });

                // Toggle 'asc' class and update sorting order
                head.classList.toggle('asc', sortAsc);
                sortAsc = !sortAsc;

                // Perform sorting based on column index and sort order
                sortTable(i, sortAsc);
            });
        });

        function sortTable(column, sortAsc) {
            // Convert NodeList to Array and sort rows based on column content
            const rowsArray = Array.from(tableRows);
            rowsArray.sort((a, b) => {
                let firstRow = a.querySelectorAll('td')[column].textContent.trim().toLowerCase();
                let secondRow = b.querySelectorAll('td')[column].textContent.trim().toLowerCase();

                return sortAsc ? (firstRow > secondRow ? 1 : -1) : (firstRow < secondRow ? 1 : -1);
            });

            // Remove current rows from table
            tableRows.forEach(row => row.parentNode.removeChild(row));

            // Append sorted rows back to the table
            rowsArray.forEach(row => document.querySelector('tbody').appendChild(row));
        }
    });



// 3. Converting HTML table to PDF

document.addEventListener('DOMContentLoaded', function () {
    const pdfBtn = document.querySelector('#toPDF');
    const customersTable = document.querySelector('#customers_table');

    const toPDF = function (element) {
        // Clone the table and exclude actions column and header
        const clonedTable = element.cloneNode(true);

        // Remove actions column from table body
        const actionsColumn = clonedTable.querySelectorAll('.actions');
        actionsColumn.forEach(col => {
            col.parentNode.removeChild(col); // Remove each actions column
        });

        // remove the arrowicons
        const arrowIcons = clonedTable.querySelectorAll('.icon-arrow');
        arrowIcons.forEach(icon => {
            icon.parentNode.removeChild(icon); // Remove each arrow icon
        });

        // Remove actions header from table header
        const actionsHeader = clonedTable.querySelector('thead th.actions');
        if (actionsHeader) {
            actionsHeader.parentNode.removeChild(actionsHeader); // Remove actions header
        }

        // Extracting only the table body section
        const tableBodyContent = clonedTable.querySelector('.table__body').innerHTML;

        // Create HTML content for PDF
        const htmlContent = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Export to PDF</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <style>
                /* Additional styles for PDF layout */
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                th .actions{display:none;}

            </style>
        </head>
        <body>
            <main class="table" id="customers_table">
                <section class="table__body">
                    ${tableBodyContent}
                </section>
            </main>
        </body>
        </html>`;

        // Open new window and write HTML content
        const newWindow = window.open();
        newWindow.document.open();
        newWindow.document.write(htmlContent);
        newWindow.document.close();

        // Delay before printing and closing window
        setTimeout(() => {
            newWindow.print();
            newWindow.close();
        }, 400);
    };

    // Event listener for PDF button click
    pdfBtn.addEventListener('click', () => {
        toPDF(customersTable);
    });
});



// 4. Converting HTML table to JSON

const json_btn = document.querySelector('#toJSON');

const toJSON = function (table) {
    let table_data = [],
        t_head = [],

        t_headings = table.querySelectorAll('th'),
        t_rows = table.querySelectorAll('tbody tr');

    for (let t_heading of t_headings) {
        let actual_head = t_heading.textContent.trim().split(' ');

        t_head.push(actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase());
    }

    t_rows.forEach(row => {
        const row_object = {},
            t_cells = row.querySelectorAll('td');

        t_cells.forEach((t_cell, cell_index) => {
            const img = t_cell.querySelector('img');
            if (img) {
                row_object['customer image'] = decodeURIComponent(img.src);
            }
            row_object[t_head[cell_index]] = t_cell.textContent.trim();
        })
        table_data.push(row_object);
    })

    return JSON.stringify(table_data, null, 4);
}

json_btn.onclick = () => {
    const json = toJSON(customers_table);
    downloadFile(json, 'json')
}

// 5. Converting HssTML table to CSV File

const csv_btn = document.querySelector('#toCSV');

const toCSV = function (table) {
    // Code For SIMPLE TABLE
    // const t_rows = table.querySelectorAll('tr');
    // return [...t_rows].map(row => {
    //     const cells = row.querySelectorAll('th, td');
    //     return [...cells].map(cell => cell.textContent.trim()).join(',');
    // }).join('\n');

    const t_heads = table.querySelectorAll('th'),
        tbody_rows = table.querySelectorAll('tbody tr');

    const headings = [...t_heads].map(head => {
        let actual_head = head.textContent.trim().split(' ');
        return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
    }).join(',') + ',' + 'image name';

    const table_data = [...tbody_rows].map(row => {
        const cells = row.querySelectorAll('td'),
            img = decodeURIComponent(row.querySelector('img').src),
            data_without_img = [...cells].map(cell => cell.textContent.replace(/,/g, ".").trim()).join(',');

        return data_without_img + ',' + img;
    }).join('\n');

    return headings + '\n' + table_data;
}

csv_btn.onclick = () => {
    const csv = toCSV(customers_table);
    downloadFile(csv, 'csv', 'customer orders');
}

// 6. Converting HTML table to EXCEL File

const excel_btn = document.querySelector('#toEXCEL');

const toExcel = function (table) {
    // Code For SIMPLE TABLE
    // const t_rows = table.querySelectorAll('tr');
    // return [...t_rows].map(row => {
    //     const cells = row.querySelectorAll('th, td');
    //     return [...cells].map(cell => cell.textContent.trim()).join('\t');
    // }).join('\n');

    const t_heads = table.querySelectorAll('th'),
        tbody_rows = table.querySelectorAll('tbody tr');

    const headings = [...t_heads].map(head => {
        let actual_head = head.textContent.trim().split(' ');
        return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
    }).join('\t') + '\t' + 'image name';

    const table_data = [...tbody_rows].map(row => {
        const cells = row.querySelectorAll('td'),
            img = decodeURIComponent(row.querySelector('img').src),
            data_without_img = [...cells].map(cell => cell.textContent.trim()).join('\t');

        return data_without_img + '\t' + img;
    }).join('\n');

    return headings + '\n' + table_data;
}

excel_btn.onclick = () => {
    const excel = toExcel(customers_table);
    downloadFile(excel, 'excel');
}

const downloadFile = function (data, fileType, fileName = '') {
    const a = document.createElement('a');
    a.download = fileName;
    const mime_types = {
        'json': 'application/json',
        'csv': 'text/csv',
        'excel': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    }
    a.href = `
        data:${mime_types[fileType]};charset=utf-8,${encodeURIComponent(data)}
    `;
    document.body.appendChild(a);
    a.click();
    a.remove();
}
</script>

</body>


@endsection
@section('profilename')
{{ $userName }}
@endsection
@section('role')
Qualificateur
@endsection
