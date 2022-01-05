<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ControllerHelper
{
    private $codes;

    public function __construct() {
        $this->codes = new ResponseCodeHelper;
    }
    private function sample_return(int $status_code, $content = [])
    {
        return new JsonResponse($content, $status_code);
    }

    public function not_valid_return()
    {
        return $this->sample_return($this->codes::not_valid);
    }

    public function no_content_return()
    {
        return $this->sample_return($this->codes::no_content);
    }

    public function inputs_not_valid(Request $request): bool
    {
        if (is_null($request->input('email')) or is_null($request->input('password'))) {
            return true;
        }
        return false;
    }

    public function to_save(Model $to_save, string $ok_code = "ok")
    {
        if ($to_save->save()) {
            return $this->sample_return(constant( get_class($this->codes) .'::'.$ok_code), $to_save);
        }
        return $this->sample_return($this->codes::internal_error);
    }

}
