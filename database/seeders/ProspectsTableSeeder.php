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
            ['name' => 'Samuel Black', 'email' => 'samuel@example.com', 'status' => 2],
            ['name' => 'Tina Brown', 'email' => 'tina@example.com', 'status' => 1],
            ['name' => 'Uma Green', 'email' => 'uma@example.com', 'status' => 0],
            ['name' => 'Victor Blue', 'email' => 'victor@example.com', 'status' => 3],
            ['name' => 'Wendy Grey', 'email' => 'wendy@example.com', 'status' => 2],
            ['name' => 'Xander Harris', 'email' => 'xander@example.com', 'status' => 4],
            ['name' => 'Yasmine Gold', 'email' => 'yasmine@example.com', 'status' => 1],
            ['name' => 'Zach White', 'email' => 'zach@example.com', 'status' => 0],
            ['name' => 'Adam Smith', 'email' => 'adam@example.com', 'status' => 1],
            ['name' => 'Bella Green', 'email' => 'bella@example.com', 'status' => 3],
            ['name' => 'Calvin Brown', 'email' => 'calvin@example.com', 'status' => 2],
            ['name' => 'Diana White', 'email' => 'diana@example.com', 'status' => 0],
            ['name' => 'Ethan Blue', 'email' => 'ethan@example.com', 'status' => 4],
            ['name' => 'Fiona Grey', 'email' => 'fiona@example.com', 'status' => 3],
            ['name' => 'George Harris', 'email' => 'george@example.com', 'status' => 1],
            ['name' => 'Hannah Gold', 'email' => 'hannah@example.com', 'status' => 0],
            ['name' => 'Ian Black', 'email' => 'ian@example.com', 'status' => 2],
            ['name' => 'Julia Brown', 'email' => 'julia@example.com', 'status' => 4],
            ['name' => 'Kyle Green', 'email' => 'kyle@example.com', 'status' => 1],
            ['name' => 'Laura White', 'email' => 'laura@example.com', 'status' => 0],
            ['name' => 'Mason Blue', 'email' => 'mason@example.com', 'status' => 3],
            ['name' => 'Nina Grey', 'email' => 'nina@example.com', 'status' => 2],
            ['name' => 'Owen Harris', 'email' => 'owen@example.com', 'status' => 1],
            ['name' => 'Paula Gold', 'email' => 'paula@example.com', 'status' => 0],
            ['name' => 'Quinn Black', 'email' => 'quinn@example.com', 'status' => 3],
            ['name' => 'Rita Brown', 'email' => 'rita@example.com', 'status' => 2],
            ['name' => 'Steve Green', 'email' => 'steve@example.com', 'status' => 4],
            ['name' => 'Tara White', 'email' => 'tara@example.com', 'status' => 1],
            ['name' => 'Uma Blue', 'email' => 'uma@example.com', 'status' => 0],
            ['name' => 'Victor Grey', 'email' => 'victor@example.com', 'status' => 3],
            ['name' => 'Wendy Harris', 'email' => 'wendy@example.com', 'status' => 2],
            ['name' => 'Xander Gold', 'email' => 'xander@example.com', 'status' => 1],
            ['name' => 'Yasmine Black', 'email' => 'yasmine@example.com', 'status' => 4],
            ['name' => 'Zach Brown', 'email' => 'zach@example.com', 'status' => 0],
        ];


        foreach ($prospects as $prospect) {
            Pros::create($prospect);
        }
    }
}
