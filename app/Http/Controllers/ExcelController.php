<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $import = Excel::import(new AttendanceImport, $file);

        if ($import) {
            return response()->json(['message' => 'Excel imported successfully']);
        } else {
            return response()->json(['message' => 'Error importing Excel']);
        }
    }
}
