<?php
namespace Core\Controllers;

use Core\Services\CloudFrontService;

class CloudFrontController extends BaseController
{
    public function invalidateObject()
    {
        try {
            $data = collect(request()->all());
            $url = null;
            validate($data->toArray(), [
                'id' => 'required',
                'path' => 'required'
            ], [
                'id.required' => 'O ID do cloud front é obrigatório.',
                'path.required' => 'Informe um path ou um arquivo (endereço completo) para ser invalidado.',
            ]);

            $path = $data->get('path');
            if(!is_array($path)){
                $path = [$data->get('path')];
            }

            $cloudFrontService = new CloudFrontService();
            $result = $cloudFrontService->invalidateObject($data->get('id'), $path);

            return $this->responseCustom($result);
        }
        catch (\Exception $e){
            return $this->responseCustom($e->getMessage(), 400);
        }
    }
}
