<?php

namespace App\Services\Campaign;

use App\Models\Resource;

class ResourcePublicationService
{

    static public function getOne($id)
    {
        return Resource::find($id);
    }

    static  public function getAllByPublication($publicationID)
    {
        return Resource::where('publication_id', $publicationID)->get();
    }

    static public function create($resource)
    {
        try {
            $resource = Resource::create($resource);
            $resource->save();
            return $resource;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function getPathImage($url)
    {
        return substr($url, 39);
    }
}
