<?php

use App\Models\User;
use Twilio\Rest\Client;

if (!function_exists("getApiConnectedUser")) {

    function getApiConnectedUser()
    {
        $user = auth()->guard('api')->user();
        \Illuminate\Support\Facades\Log::info($user);
        return $user != null ? $user->load("identity","company") : null;
    }
}

if (!function_exists("getApiConnectedUserIdentity")) {

    function getApiConnectedUserIdentity()
    {
        $user = auth()->guard('api')->user();
        \Illuminate\Support\Facades\Log::info($user);
        return $user != null ? $user->load("identity") : null;
    }
}

if (!function_exists("getApiConnectedUserCompany")) {

    function getApiConnectedUserCompany()
    {
        $user = auth()->guard('api')->user();
        \Illuminate\Support\Facades\Log::info($user);
        return $user != null ? $user->load("company") : null;
    }
}

if (!function_exists("checkLocation")) {

    function checkLocation($location)
    {
        $location = array_filter(explode('/', $location));
        $path = public_path();

        foreach ($location as $key) {
            $path .= "/$key";

            if (is_dir($path) != true) {
                mkdir($path, 0775, true);
            }
        }
    }
}

if (!function_exists("uploadFile")) {

    function uploadFile($file, $location)
    {
        return "storage/" . $file->store($location, 'public');
    }
}


if (!function_exists('uploadOne')) {
    /**
     * Télécharger un seul fichier dans le serveur
     *
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    function uploadOne(\Illuminate\Http\UploadedFile $file, $folder, $filename, $disk = 'public')
    {
        $name = !is_null($filename) ? $filename : time() . 'jpg';
        return $file->storeAs(
            $folder,
            $name,
            $disk
        );
    }
}


