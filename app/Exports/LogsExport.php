<?php
namespace App\Exports;

use App\Models\Logs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Logs::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Log Name',
            'Description',
            'Subject Type',
            'Subject ID',
            'Causer Type',
            'Causer ID',
            'Properties',
            'From',
            'To',
            'Batch UUID',
            'Created At',
            'Updated At',
        ];
    }
}
