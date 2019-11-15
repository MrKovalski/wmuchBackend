<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UsersResource;
use App\Http\Resources\WorkingHoursResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkingHour;

class WorkedHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showAllHours = WorkingHour::All();
        return WorkingHoursResource::collection($showAllHours);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createHoursById = WorkingHour::create($request->all());
        return new WorkingHoursResource($createHoursById);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hour)
    {
        $showHoursById = WorkingHour::findOrFail($hour);
        return new WorkingHoursResource($showHoursById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateHoursById = WorkingHour::findOrFail($id);
        $updateHoursById->update($request->all());
        return new WorkingHoursResource($updateHoursById);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteHoursById = WorkingHour::find($id)->delete();
        return response()->json([], 204);

    }
}
