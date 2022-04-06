<?php

namespace Core\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function responseCustom($retorno, $status = 200)
    {
        $retorno = array(
            'data' => $retorno
        );

        return response()->json($retorno, $status);
    }

    public function responseCustomAdaptativa($retorno, $status = 200)
    {
        $retorno = array(
            'statusCode' => $status,
            'data' => $retorno
        );

        return response()->json($retorno, $status, [], JSON_NUMERIC_CHECK);
    }
}
