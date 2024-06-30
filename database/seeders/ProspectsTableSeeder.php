<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pros;

class ProspectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prospects = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'status' => 1],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'status' => 0],
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'status' => 3],
            ['name' => 'Bob Brown', 'email' => 'bob@example.com', 'status' => 2],
            ['name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'status' => 1],
            ['name' => 'David Evans', 'email' => 'david@example.com', 'status' => 2],
            ['name' => 'Eva Green', 'email' => 'eva@example.com', 'status' => 0],
            ['name' => 'Frank Harris', 'email' => 'frank@example.com', 'status' => 4],
            ['name' => 'Grace Johnson', 'email' => 'grace@example.com', 'status' => 4],
            ['name' => 'Henry King', 'email' => 'henry@example.com', 'status' => 3],
            ['name' => 'Isabel Lee', 'email' => 'isabel@example.com', 'status' => 0],
            ['name' => 'Jack Miller', 'email' => 'jack@example.com', 'status' => 1],
            ['name' => 'Karen Nelson', 'email' => 'karen@example.com', 'status' => 4],
            ['name' => 'Leo Owens', 'email' => 'leo@example.com', 'status' => 3],
            ['name' => 'Mona Perry', 'email' => 'mona@example.com', 'status' => 2],
            ['name' => 'Nathan Quinn', 'email' => 'nathan@example.com', 'status' => 1],
            ['name' => 'Olivia Roberts', 'email' => 'olivia@example.com', 'status' => 4],
            ['name' => 'Paul Scott', 'email' => 'paul@example.com', 'status' => 3],
            ['name' => 'Quincy Taylor', 'email' => 'quincy@example.com', 'status' => 1],
            ['name' => 'Rachel White', 'email' => 'rachel@example.com', 'status' => 0],
        ];

        foreach ($prospects as $prospect) {
            Pros::create($prospect);
        }
    }
}
