@extends('layouts.SidebarAdmin')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert | Export html Table to CSV & EXCEL File</title>

<style>
    * {
    margin: 0;
    padding: 0;

    box-sizing: border-box;
    font-family: sans-serif;
}
@media print {
 .table, .table__body {
  overflow: visible;
  height: auto !important;
  width: auto !important;
 }
}

/*@page {
    size: landscape;
    margin: 0;
}*/

body {
    min-height: 100vh;
    background: url(images/html_table.jpg) center / cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

main.table {
    width: 82vw;
    height: 90vh;
    background-color: #fff5;

    backdrop-filter: blur(7px);
    box-shadow: 0 .4rem .8rem #0005;
    border-radius: .8rem;

    overflow: hidden;
}

.table__header {
    width: 100%;
    height: 10%;
    background-color: #fff4;
    padding: .8rem 1rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table__header .input-group {
    width: 35%;
    height: 100%;
    background-color: #fff5;
    padding: 0 .8rem;
    border-radius: 2rem;

    display: flex;
    justify-content: center;
    align-items: center;

    transition: .2s;
}

.table__header .input-group:hover {
    width: 45%;
    background-color: #fff8;
    box-shadow: 0 .1rem .4rem #0002;
}

.table__header .input-group img {
    width: 1.2rem;
    height: 1.2rem;
}

.table__header .input-group input {
    width: 100%;
    padding: 0 .5rem 0 .3rem;
    background-color: transparent;
    border: none;
    outline: none;
}

.table__body {
    width: 95%;
    max-height: calc(89% - 1.6rem);
    background-color: #fffb;

    margin: .8rem auto;
    border-radius: .6rem;

    overflow: auto;
    overflow: overlay;
}


.table__body::-webkit-scrollbar{
    width: 0.5rem;
    height: 0.5rem;
}

.table__body::-webkit-scrollbar-thumb{
    border-radius: .5rem;
    background-color: #0004;
    visibility: hidden;
}

.table__body:hover::-webkit-scrollbar-thumb{
    visibility: visible;
}


table {
    width: 100%;
}

td img {
    width: 36px;
    height: 36px;
    margin-right: .5rem;
    border-radius: 50%;

    vertical-align: middle;
}

table, th, td {
    border-collapse: collapse;
    padding: 1rem;
    text-align: left;
}

thead th {
    position: sticky;
    top: 0;
    left: 0;
    background-color: #d5d1defe;
    cursor: pointer;
    text-transform: capitalize;
}

tbody tr:nth-child(even) {
    background-color: #0000000b;
}

tbody tr {
    --delay: .1s;
    transition: .5s ease-in-out var(--delay), background-color 0s;
}

tbody tr.hide {
    opacity: 0;
    transform: translateX(100%);
}

tbody tr:hover {
    background-color: #fff6 !important;
}

tbody tr td,
tbody tr td p,
tbody tr td img {
    transition: .2s ease-in-out;
}

tbody tr.hide td,
tbody tr.hide td p {
    padding: 0;
    font: 0 / 0 sans-serif;
    transition: .2s ease-in-out .5s;
}

tbody tr.hide td img {
    width: 0;
    height: 0;
    transition: .2s ease-in-out .5s;
}

.status {
    padding: .4rem 0;
    border-radius: 2rem;
    text-align: center;
}

.status.commercial {
    background-color: #86e49d;
    color: #006b21;
}

.status.admin {
    background-color: #d893a3;
    color: #b30021;
}

.status.qualificateur {
    background-color: #ebc474;
}

.status.shipped {
    background-color: #6fcaea;
}


@media (max-width: 1000px) {
    td:not(:first-of-type) {
        min-width: 12.1rem;
    }
}

thead th span.icon-arrow {
    display: inline-block;
    width: 1.3rem;
    height: 1.3rem;
    border-radius: 50%;
    border: 1.4px solid transparent;

    text-align: center;
    font-size: 1rem;

    margin-left: .5rem;
    transition: .2s ease-in-out;
}

thead th:hover span.icon-arrow{
    border: 1.4px solid #6c00bd;
}

thead th:hover {
    color: #6c00bd;
}

thead th.active span.icon-arrow{
    background-color: #6c00bd;
    color: #fff;
}

thead th.asc span.icon-arrow{
    transform: rotate(180deg);
}

thead th.active,tbody td.active {
    color: #6c00bd;
}
.export__file {
    position: relative;
    margin-left: 1rem;
}

.export__file .export__file-btn {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    background: #fff6 url(images/export.png) center / 80% no-repeat;
    border-radius: 50%;
    transition: .2s ease-in-out;
}

.export__file .export__file-btn:hover {
    background-color: #fff;
    transform: scale(1.15);
    cursor: pointer;
}

.export__file input {
    display: none;
}

.export__file .export__file-options {
    position: absolute;
    right: 0;
    width: 12rem;
    border-radius: .5rem;
    overflow: hidden;
    text-align: center;
    opacity: 0;
    transform: scale(.8);
    transform-origin: top right;
    box-shadow: 0 .2rem .5rem #0004;
    transition: .2s;
    z-index: -1;
}

.export__file input:checked + .export__file-options {
    opacity: 1;
    transform: scale(1);
    z-index: 100;
}

.export__file .export__file-options label {
    display: block;
    width: 100%;
    padding: .6rem 0;
    background-color: #f2f2f2;
    display: flex;
    justify-content: space-around;
    align-items: center;
    transition: .2s ease-in-out;
}

.export__file .export__file-options label:first-of-type {
    padding: 1rem 0;
    background-color: #86e49d !important;
}

.export__file .export__file-options label:hover {
    transform: scale(1.05);
    background-color: #fff;
    cursor: pointer;
}

.export__file .export__file-options img {
    width: 2rem;
    height: auto;
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
            <h1>Users</h1>

            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="{{ asset('images/search.png') }}" alt="">

            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"><i class="gg-export"></i></label>
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
                            <a href="{{ route('admin.users.export', ['format' => 'txt']) }}">
                                <img src="{{ asset('images/json.png') }}" alt="JSON Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('admin.users.export', ['format' => 'csv']) }}">
                                <img src="{{ asset('images/csv.png') }}" alt="CSV Icon">
                            </a>
                        </button>
                    </label>

                    <label for="export-file">
                        <button style="background-color: transparent; border: none;" class="btn btn-danger">
                            <a href="{{ route('admin.users.export', ['format' => 'xlsx']) }}">
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
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Created At <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Updated At <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td >
                           <p class="@if ($user->role == 0) status admin @elseif ($user->role == 1) status qualificateur @else status commercial @endif"> @if ($user->role == 0)
                                Admin
                            @elseif ($user->role == 1)
                                Qualificateur
                            @else
                                Commercial
                            @endif</p>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="actions">
                            <!-- Example of edit and delete links/buttons -->
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" ><svg style="height:20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a>
                            @if ($user->id != 1)
                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button style="border:none;" type="submit"  onclick="return confirm('Are you sure you want to delete this user?')"><svg style="height:20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#bd0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                            </form>
                            @endif


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

// 5. Converting HTML table to CSV File

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
