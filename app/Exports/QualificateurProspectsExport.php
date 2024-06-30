<?php

namespace App\Exports;

use App\Models\Pros;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QualificateurProspectsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $users = Pros::select('id', 'name', 'email', 'status', 'created_at', 'updated_at')->where('status', 1)->orwhere('status', 0)->get();
        $users->transform(function ($user) {
            switch ($user->status) {
                case 0:
                    $user->status_label = 'Nouveau';
                    break;
                case 1:
                    $user->status_label = 'Qualifié';
                    break;
                case 2:
                    $user->status_label = 'Rejeté';
                    break;
                case 3:
                    $user->status_label = 'Converti';
                    break;
                case 4:
                    $user->status_label = 'Cloturé';
                    break;
            }
            unset($user->status);
            return $user;
        });
        return $users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',

            'Created At',
            'Updated At','Status',
        ];
    }
}
