<?php


namespace App\Traits;


trait HelperTrait
{
    public function generateCode()
    {
        return rand(10000,99999);
    }
}
