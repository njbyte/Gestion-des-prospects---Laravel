<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch users with specific columns
        $users = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->get();

        // Transform role into descriptive role_label
        $users->transform(function ($user) {
            switch ($user->role) {
                case 0:
                    $user->role_label = 'Admin';
                    break;
                case 1:
                    $user->role_label = 'Qualificateur';
                    break;
                case 2:
                    $user->role_label = 'Commercial';
                    break;
                default:
                    $user->role_label = 'Unknown';
            }
            // Remove the original 'role' attribute if not needed
            unset($user->role);
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
            'Updated At','Role',
        ];
    }
}
