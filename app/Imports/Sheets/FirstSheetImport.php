<?php
namespace App\Imports\Sheets;

use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FirstSheetImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $name = $row[1];
            $date = $row[3];
            $firstIn = $row[4];
            $firstOut = $row[5];
            $lastIn = $row[6];
            $lastOut = $row[7];

            $faculty = Faculty::where('firstname', 'LIKE', '%'.$name.'%')
                        ->orWhere('lastname', 'LIKE', '%'.$name.'%')
                        ->first();

            $attendanceData = [
                'first_in' => $firstIn,
                'first_out' => $firstOut,
                'second_in' => $lastIn,
                'second_out' => $lastOut,
                'created_at' => $date,
                'updated_at' => $date,
            ];

            if($faculty)
            {
                $date = Carbon::parse($date)->startOfDay();
                $attendance = $faculty->attendances()->whereDate('created_at',$date)->first();

                if($attendance)
                {
                    $attendance->update($attendanceData);
                }else{
                    $faculty->attendances()->create($attendanceData);
                }
            }else {
                $name = ucfirst($name);
                $faculty = Faculty::factory()
                    ->hasDetail()
                    ->create(['firstname' => $name]);
                $faculty->attendances()->create($attendanceData);
            }
        }
    }

    public function startRow(): int
    {
        return 6;
    }
}
