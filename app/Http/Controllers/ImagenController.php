<?php

namespace App\Http\Controllers;

use App\Services\Campaign\ResourcePublicationService;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{

    public function download($resource)
    {
        $resource = ResourcePublicationService::getOne($resource);
        $rutaImagen = substr($resource->url_imagen, 39);
        $nameImage = explode('/', $rutaImagen);
        $nombreDescarga = $nameImage[3];
        $contenido = Storage::disk('s3')->get($rutaImagen);
        return response($contenido, 200)
            ->header('Content-Type', 'image/jpg')
            ->header('Content-Disposition', 'attachment; filename="' . $nombreDescarga . '"');
    }
}
