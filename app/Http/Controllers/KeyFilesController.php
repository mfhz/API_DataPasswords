<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesKeyRequest;
use App\Http\Resources\KeyFilesResource;
use App\Models\KeyFiles;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class KeyFilesController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oKeyFiles = KeyFiles::all();
        return $this->successResponse($oKeyFiles, 'The record was showed success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilesKeyRequest $request)
    {
        try {
            DB::beginTransaction();
            $oFiles = KeyFiles::create([
                'name_key' => $request['name_key'],
                'line' => $request['line'],
                'id_file' => $request['id_file'],
            ]);
            DB::commit();
            return $this->successResponse($oFiles, 'The record was saved success', 200);
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
            $oKeyFile = KeyFiles::findOrFail($id);
            return $this->successResponse(KeyFilesResource::make($oKeyFile), 'The record was showed success', 200);
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
    
    public function onSaveFile(StoreFilesKeyRequest $request)
    {
        try {
            DB::beginTransaction();
            $oFiles = KeyFiles::create([
                'name_key' => $request['name_key'],
                'line' => $request['line'],
                'id_file' => $request['id_file'],                
            ]);
            DB::commit();
            return $this->successResponse($oFiles, 'The record was saved success', 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $this->errorResponse('The record could not be saved', $exception->getMessage(), 422);
        }
        
    }
}
