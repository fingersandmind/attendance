<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = Faculty::factory()
            ->count(50)
            ->hasDetail()
            ->create();
        foreach ($faculties as $faculty)
        {
            $this->generateLogs($faculty);
        }
    }

    public function generateLogs($user)
    {
        $now = Carbon::now();
        $start = Carbon::parse($now)->startOfMonth();
        $end = Carbon::parse($now)->endOfMonth();

        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->copy();
            $start->addDay();
        }
        
        foreach ($dates as $day)
        {
            if($day->isWeekday())
            {
                $user->attendances()->create([
                    'first_in' => $this->setTime($day),
                    'first_out' => $this->setTime($day, 'first_out'),
                    'second_in' => $this->setTime($day, 'second_in'),
                    'second_out' => $this->setTime($day, 'second_out'),
                    'created_at' => $day,
                    'updated_at' => $day
                ]);
            }
        }
    }

    public function setTime($day, $type = 'first_in')
    {
        if($type == 'first_in')
        {
            $day->hour = rand( 7,9 );
        }

        if($type == 'first_out')
        {
            $day->hour = rand(11,12 );
        }

        if($type == 'second_in')
        {
            $day->hour = rand( 12,14 );
        }

        if($type == 'second_out')
        {
            $day->hour = rand( 15,17 );
        }

        $day->minute = rand( 0,45 );

        return $day->format('H:i:s');
    }
}
