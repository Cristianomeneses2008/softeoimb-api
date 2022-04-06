<?php
namespace Core\Controllers;

use Core\Services\LambdaService;
use Core\Services\S3Service;

class LambdaController extends BaseController
{
    public function getFunction()
    {
        try {
            $data = collect(request()->all());
            $url = null;
            validate($data->toArray(), [
                'function' => 'required'
            ], [
                'function.required' => 'Informe o nome da funcao.'
            ]);

            $lambdaService = new LambdaService();
            $result = $lambdaService->getFunction($data->get('function'));

            return $this->responseCustom($result);
        }
        catch (\Exception $e){
            return $this->responseCustom($e->getMessage(), 400);
        }
    }
}
