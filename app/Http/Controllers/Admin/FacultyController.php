<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Faculty;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;

class FacultyController extends Controller
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('searchTerm') ?? '';
        $faculties = Faculty::query()
                ->search($searchTerm)
                ->with('detail')
                ->latest()
                ->paginate(10)
                ->withQueryString();

        return Inertia::render('Admin/Faculty/IndexPage', compact('faculties'));
    }

    public function show(Faculty $faculty)
    {
        $setting = Setting::where('type', 'time')->first();
        return Inertia::render('Admin/Faculty/SinglePage', [
            'faculty' => $faculty->load('detail'),
            'attendances' => $faculty->attendances()->latest()->paginate(5),
            'setting' => $setting
        ]);
    }

    /**
     * @return Response
     */
    public  function create()
    {
        return Inertia::render('Admin/Faculty/CreatePage');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'firstname' => 'required|string|min:5|max:30',
            'lastname' => 'required|string|min:1|max:30',
            'middlename' => 'required|string|min:1|max:30',
            'email' => 'required|email|max:80',
            'phone' => 'nullable|string',
            'country' => 'required|string|max:50',
            'address' => 'required|string',
            'position' => 'required|string',
            'division' => 'required|string',
            'speciality' => 'required|string'
        ]);

        $faculty = Faculty::create(array_diff_key($validatedData, array_flip(['position', 'division', 'speciality'])));

        if($faculty)
        {
            $faculty->detail()->create($request->only(['position', 'division', 'speciality']));
        }

        return to_route('admin.faculties.index');
    }

    /**
     * @return Response
     */
    public  function edit(Faculty $faculty)
    {
        $faculty->load('detail');
        return Inertia::render('Admin/Faculty/EditPage', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'firstname' => 'required|string|min:3|max:30',
            'lastname' => 'required|string|min:1|max:30',
            'middlename' => 'required|string|min:1|max:30',
            'email' => 'required|email|max:80',
            'phone' => 'nullable|string',
            'country' => 'required|string|max:50',
            'address' => 'required|string',
            'position' => 'required|string',
            'division' => 'required|string',
            'speciality' => 'required|string'
        ]);

        $faculty->update(array_diff_key($validatedData, array_flip(['position', 'division', 'speciality'])));
        $faculty->detail()->update($request->only(['position', 'division', 'speciality']));

        return to_route('admin.faculties.show', ['faculty' => $faculty->id]);
    }

    public function logShow(Request $request, Faculty $faculty)
    {
        $month = '2023-03';
        $dates = $request->get('dates') ?? [
            Carbon::parse($month)->startOfMonth(),
            Carbon::parse($month)->endOfMonth()
        ];
        $data = $this->getLogs($faculty->id, $dates);
        $setting = Setting::where('type', 'time')->first();
        return Inertia::render('Admin/Faculty/Logs/LogsIndex', [
            'faculty' => $faculty,
            'dates' => $dates,
            'attendances' => fn() => $data['attendance'],
            'totalLoggedHours' => fn() => $data['totalLoggedHours'],
            'totalLateHours' => fn() => $data['totalLateHours'],
            'setting' => $setting
        ]);
    }

    /**
     * @param $facultyId
     * @param $dates
     * @return array
     */
    public function getLogs($facultyId, $dates): array
    {
        if(empty($dates)) return [];
        $attendance = Attendance::query()
                        ->where('faculty_id', $facultyId)
                        ->whereBetween('created_at', $dates)
                        ->latest()
                        ->paginate(35);

        $totalLateHours = $this->getTotalHours($attendance, true);
        $totalLoggedHours = $this->getTotalHours($attendance);

        return compact('attendance', 'totalLoggedHours', 'totalLateHours');

    }

    /**
     * @param LengthAwarePaginator $item
     * @param bool $isForLate
     * @return mixed
     */
    public function getTotalHours(LengthAwarePaginator $item, bool $isForLate = false): mixed
    {
        $result =  $item->getCollection()->sum(function ($data) use ($isForLate){
            if(!$isForLate)
            {
                $firstInTotal = $this->getHours($data->first_in, $data->first_out);
                $secondInTotal = $this->getHours($data->second_in, $data->second_out);
                $total = $firstInTotal + $secondInTotal;
            }else{
                $timeInSetting = Setting::where('type','time')->first();
                $firstIn = $timeInSetting?->first_in ?? "08:00:00";
                $secondIn = $timeInSetting?->first_out ?? "13:00:00";
                $firstLateInTotal = $this->getHours($firstIn, $data->first_in);
                $secondLateInTotal = $this->getHours($secondIn, $data->second_in);
                $total = $firstLateInTotal + $secondLateInTotal;
            }
            return $total;
        });

        return $this->secondsToHoursFormat($result);
    }

    /**
     * @param string $startTime
     * @param string $endTime
     * @return int
     */
    public function getHours(string $startTime, string $endTime): int
    {
        return (strtotime($endTime) - strtotime($startTime));
    }

    /**
     * @param int $seconds
     * @return string
     */
    public function secondsToHoursFormat(int $seconds): string
    {
        $init = $seconds;
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;

        return $hours . ":" . $minutes . ":" .$seconds;
    }
}
