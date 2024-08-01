<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNameRequest;
use App\Http\Resources\HostnameResource;
use Illuminate\Support\Facades\DB;
use App\Models\Hostname;
use App\Traits\ApiResponse;

class HostnameController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oHostName = Hostname::all();
        return $this->successResponse($oHostName, 'The record was showed success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNameRequest $request)
    {
        try {
            DB::beginTransaction();
            $oHostname = Hostname::create([
                'name' => $request->name,
                'progress' => 0,
                'count_file' => 0,
            ]);
            DB::commit();
            return $this->successResponse($oHostname, 'The name was saved success', 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $this->errorResponse('The record could not be saved', $exception->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $oHostName = Hostname::findOrFail($id);
            return $this->successResponse(HostnameResource::make($oHostName), 'The record was showed success', 200);
        } catch (\Throwable $exception) {
            return $this->errorResponse('The record could not be showed', $exception->getMessage(), 422);
        }     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
