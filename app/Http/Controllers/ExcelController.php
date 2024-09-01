<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceImport;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public $skippedNthCol = 6;

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        DB::beginTransaction();

        try {
            $file = $request->file('file');
            $collection = Excel::toCollection(new AttendanceImport, $file)[0];
            $dataProcessed = $this->processData($collection);

            $this->updateAttendances($dataProcessed);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($collection) {
            return response()->json(['message' => 'Excel imported successfully']);
        } else {
            return response()->json(['message' => 'Error importing Excel']);
        }
    }

    private function processData(Collection $collection)
    {
        $dataProcessed = [];

        foreach ($collection->slice($this->skippedNthCol) as $row) {
            $dataProcessed[] = [
                'name' => $row[1],
                'department' => $row[2],
                'date' => $row[3],
                'first_in' => $this->convertDecimalToTime($row[4]),
                'first_out' => $this->convertDecimalToTime($row[5]),
                'second_in' => $this->convertDecimalToTime($row[6]),
                'second_out' => $this->convertDecimalToTime($row[7]),
            ];
        }

        return $dataProcessed;
    }

    private function updateAttendances(array $dataProcessed)
    {
        if (empty($dataProcessed)) {
            return;
        }

        foreach ($dataProcessed as $row) {
            $faculty = Faculty::where('firstname', 'LIKE', '%' . $row['name'] . '%')
                ->orWhere('lastname', 'LIKE', '%' . $row['name'] . '%')
                ->first();

            if ($faculty) {
                $date = Carbon::parse($row['date'])->startOfDay();
                $attendance = $faculty->attendances()->whereDate('created_at', $date)->first();

                if ($attendance) {
                    $attendance->update([
                        'first_in' => $row['first_in'],
                        'first_out' => $row['first_out'],
                        'second_in' => $row['second_in'],
                        'second_out' => $row['second_out'],
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                } else {
                    $faculty->attendances()->create(
                        [
                            'first_in' => $row['first_in'],
                            'first_out' => $row['first_out'],
                            'second_in' => $row['second_in'],
                            'second_out' => $row['second_out'],
                            'created_at' => $date,
                            'updated_at' => $date,
                        ]
                    );
                }
            }
        }
    }

    private function convertDecimalToTime($decimal)
    {
        // If the decimal value is a fraction of a day, convert it to hours, minutes, and seconds
        $hours = floor($decimal * 24);
        $minutes = floor(($decimal * 24 * 60) % 60);
        $seconds = floor(($decimal * 24 * 60 * 60) % 60);

        // Format as H:i:s
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
