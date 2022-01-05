<?php

namespace App\Helpers;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class ResponseCodeHelper
{
    const not_valid =  ResponseCodes::HTTP_BAD_REQUEST;
    const created = ResponseCodes::HTTP_CREATED;
    const ok = ResponseCodes::HTTP_OK;
    const no_content = ResponseCodes::HTTP_NO_CONTENT;
    const internal_error = ResponseCodes::HTTP_INTERNAL_SERVER_ERROR;
}
