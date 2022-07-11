<?php

namespace App\Http\Controllers\File;

date_default_timezone_set('America/El_Salvador');

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        //
        return view('file.index');
    }

    public function list()
    {
        //
        $files = DB::table('files')->get();
        return response()->json($files);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        // $max_file_size = (int)ini_get('upload_max_filesize') * 1024 * 1024;
        $files = $request->file('files');
        $saved = false;

        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                // Se valida el tamaño del archivo
                // if ($file->getSize() > $max_file_size) {
                //     return response()->json(['error' => 'El archivo ' . $file->getClientOriginalName() . ' es demasiado grande.']);
                // }

                // Se valida el tipo de archivo
                // $extension = $file->getClientOriginalExtension();
                // if (!in_array($extension, ['pdf', 'jpg', 'jpeg', 'png'])) {
                //     return response()->json(['error' => 'El archivo ' . $file->getClientOriginalName() . ' no es valido.']);
                // }

                // Se guarda el archivo en el disco local
                Storage::disk('archivos')->put($filename, File::get($file));

                // Se guardan los datos en la base de datos
                DB::table('files')->insert([
                    'name' => $filename,
                    'user' => 'admin_prueba',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $saved = true;
            }
            if ($saved) {
                return response()->json([
                    'status' => true,
                    'message' => 'Archivos subidos correctamente.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Error al subir los archivos.',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No se ha seleccionado ningun archivo.',
            ]);
        }
    }

    public function show($filename)
    {
        //
        $file = Storage::disk('archivos')->get($filename);
        $type = Storage::mimeType($filename);

        return response()->make($file, 200, [
            'Content-Type' => $type,
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
