<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesRequest;
use App\Http\Resources\FilesResource;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oFiles = Files::all();
        return $this->successResponse($oFiles, 'The record was showed success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilesRequest $request)
    {
        try {
            DB::beginTransaction();
            $fileData = base64_decode($request->server_path, true);
            $extension = $this->getExtensionFromBase64($request->server_path);
            $sNameResource = 'fil_'.date('Ymd').time().'.'.$extension;
            Storage::disk('public')->put("fileName/$sNameResource", $fileData);
            $oFiles = Files::create([
                'computer_path' => $request->computer_path,
                'server_path' => $sNameResource,
                'id_hostname' => $request->id_hostname,
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
            $oFile = Files::findOrFail($id);
            return $this->successResponse(FilesResource::make($oFile), 'The record was showed success', 200);
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

    public function getExtensionFromBase64($base64String)
    {
        // Decodificar la cadena base64
        $fileData = base64_decode($base64String);
        // dd($fileData);

        // Crear una instancia de finfo
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        // dd($finfo);

        // Obtener el tipo MIME del contenido decodificado
        $mimeType = $finfo->buffer($fileData);
        // dd($mimeType);

        // Mapear el tipo MIME a una extensión de archivo
        $mimeTypes = [
            'text/plain' => 'txt',
            'application/pdf' => 'pdf',
            'text/xml' => 'xml',
            'text/plain' => 'csv',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx'
        ];

        $extension = isset($mimeTypes[$mimeType]) ? $mimeTypes[$mimeType] : 'bin';

        // Retornar la extensión como respuesta
        return $extension;
    }

    public function onGetFile($idHostname)
    {        
        try {
            $oFiles = Files::where('id_hostname', $idHostname)->get();
            return $this->successResponse($oFiles, 'The record was showed success', 200);
        } catch (\Throwable $exception) {
            return $this->errorResponse('The record could not be showed', $exception->getMessage(), 422);
        }   
    }    
}
