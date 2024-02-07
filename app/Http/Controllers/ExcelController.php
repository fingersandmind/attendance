<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        try {

            $file = $request->file('file');
            $import = Excel::import(new AttendanceImport, $file);
            // $collection = Excel::toCollection(new AttendanceImport, $file);
            // dd($collection);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }

        if ($import) {
            return response()->json(['message' => 'Excel imported successfully']);
        } else {
            return response()->json(['message' => 'Error importing Excel']);
        }
    }
}
