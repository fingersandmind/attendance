<?php

namespace App\Imports;

use App\Imports\Sheets\FirstSheetImport;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendanceImport implements WithMultipleSheets, SkipsUnknownSheets
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

    public function sheets(): array
    {
        return [
            'Abnormal' => new FirstSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        dd($sheetName);
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
