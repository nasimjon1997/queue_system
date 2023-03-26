<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use App\Models\WorkScheduleCabinet;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting insert Cabinets');

        Cabinet::create(['name' => 'Кабинет 1']);
        Cabinet::create(['name' => 'Кабинет 2']);
        Cabinet::create(['name' => 'Кабинет 3']);
        Cabinet::create(['name' => 'Кабинет 4']);
        Cabinet::create(['name' => 'Кабинет 5']);
        $this->command->info('Cabinets inserted');
        $this->command->info('Starting insert work schedule Cabinets');
        $begin = new DateTime('2023-03-26');
        $end = new DateTime('2023-04-26');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $cabinets = Cabinet::all();
        foreach ($period as $dt) {
            $from_date = $dt->setTime(8, 0)->format("Y-m-d H:i:s");
            $to_date = $dt->setTime(17, 0)->format("Y-m-d H:i:s");
            foreach ($cabinets as $cabinet) {
                WorkScheduleCabinet::create([
                    'cabinet_id' => $cabinet->id,
                    'from' => $from_date,
                    'to' => $to_date
                ]);
            }
        }
        $this->command->info('Work schedule Cabinets inserted');

    }
}
