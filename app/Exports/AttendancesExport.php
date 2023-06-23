<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendancesExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $attendances = Attendance::with('faculty:id,firstname,lastname')->get()->map(function($attendance){
            $attendance = collect($attendance->toArray());
            $faculty = $attendance['faculty'];
            $additional = ['firstname' => $faculty['firstname'], 'lastname' => $faculty['lastname']];
            $attendance->splice(1,0, collect($additional));
            return $attendance->except('faculty','updated_at');
        });
        
        return $attendances;
    }

    public function title(): string
    {
        return 'Attendance Log';
    }

    public function headings(): array
    {
        // Define your column names
        return config('attendance.headings');
    }
}
