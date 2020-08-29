<?php

use Illuminate\Database\Seeder;
use App\Model\Reservation\Space;
class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \factory(Space::class, 15)->create();
    }
}
