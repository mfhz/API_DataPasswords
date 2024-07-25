<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNameRequest;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function onSaveName(StoreNameRequest $request)
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
}
