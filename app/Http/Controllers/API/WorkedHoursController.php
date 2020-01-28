<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\WorkingHourResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkingHour;
use Validator;

class WorkedHoursController extends Controller
{
    //ispravi gresku u php vremenskim zonama
    public static function cor_time()
    {
        if(date('I') !=1)
        {
            return Carbon::now()->addHour();
        } else {
            return Carbon::now();
        }
    }

    //radni sati svih usera
    public function index()
    {
        $showAllHours = WorkingHour::All();
        return WorkingHourResource::collection($showAllHours);
    }

    //pocni novi sat odnosno novo radno vreme
    //upisuje samo start i user id
    public function store(Request $request)
    {
        $user_id = 1;
        $start_time = self::cor_time();

        $request->merge([
           'start' => $start_time->toDateTimeString(),
           'user_id' => $user_id,
        ]);

        $createHoursById = WorkingHour::create($request->all());
        return new WorkingHourResource($createHoursById);

    }

    //prikazi odradjeni sat
    public function show($hour)
    {
        $showHoursById = WorkingHour::findOrFail($hour);
        return new WorkingHourResource($showHoursById);
    }

    //upisuje zavrsi radni sat
    //racuna ukupno vreme na poslu
    public function update(Request $request, $this_hour)
    {
        //u promenljive start i end upisemo pocetno i zavrsno vreme iz baze
        //i racunamo proteklo vreme
        $hour = WorkingHour::findOrFail($this_hour);
        $start = new Carbon($hour->start);
        $end = self::cor_time();
        $hours_worked = $end->diffInMinutes($start);
        $request->merge([
            'start' => $start->toDateTimeString(),
            'end' => $end->toDateTimeString(),
            'hours_worked' => $hours_worked,
        ]);
        $hour->update($request->all());
        return new WorkingHourResource($hour);
    }

    //brise radne sate
    public function destroy($id)
    {
        WorkingHour::find($id)->delete();
        return response()->json([], 204);

    }
}
