<?php

namespace App\Imports;

use Illuminate\Support\Collection;

class AttendanceImport
{

    /**
     * @param Collection $collection
     */
    // public function collection($rows)
    // {
    //     foreach ($rows as $row) {
    //         $faculty = Faculty::where('firstname', 'LIKE', '%'.$row['first_name'].'%')
    //                     ->orWhere('lastname', 'LIKE', '%'.$row['last_name'].'%')
    //                     ->first();
    //         if($faculty)
    //         {
    //             $date = Carbon::parse($row['date_created'])->startOfDay();
    //             $attendance = $faculty->attendances()->whereDate('created_at',$date)->first();

    //             if($attendance)
    //             {
    //                 $attendance->update([
    //                     'first_in' => $row['first_in'],
    //                     'first_out' => $row['first_out'],
    //                     'second_in' => $row['second_in'],
    //                     'second_out' => $row['second_out'],
    //                     'created_at' => $row['date_created'],
    //                     'updated_at' => $row['date_created'],
    //                 ]);

    //             }else{
    //                 $faculty->attendances()->create(
    //                     [
    //                         'first_in' => $row['first_in'],
    //                         'first_out' => $row['first_out'],
    //                         'second_in' => $row['second_in'],
    //                         'second_out' => $row['second_out'],
    //                         'created_at' => $row['date_created'],
    //                         'updated_at' => $row['date_created'],
    //                     ]
    //                 );
    //             }
    //         }
    //     }
    // }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
