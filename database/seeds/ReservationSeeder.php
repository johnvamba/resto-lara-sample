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
        // \factory(Space::class, 15)->create();
        Space::create([
        	'name' => 'Table 1',
        	'description' => "Top right corner; max 5 pax"
        ]);

        Space::create([
        	'name' => 'Table 2',
        	'description' => "Top left near door; max 3 pax"
        ]);

        Space::create([
        	'name' => 'Table 3',
        	'description' => "Bottom left of counter; max 2 pax"
        ]);

        Space::create([
        	'name' => 'Table 3',
        	'description' => "Bottom right of counter; max 2 pax"
        ]);
    }
}
