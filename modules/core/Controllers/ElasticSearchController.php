<?php
namespace Core\Controllers;

use Core\Services\ElasticSearchService;
use Core\Services\S3Service;

class ElasticSearchController extends BaseController
{
    public function create()
    {
        try {
            $data = collect(request()->all());
            $url = null;
            validate($data->toArray(), [
                'path' => 'required',
                'body' => 'required'
            ], [
                'path.required' => 'Informe o caminho da indexação do dominio da AWS.',
                'body.required' => 'Informe o corpo do log que deseja armazenar.',
            ]);

            $s3Service = new ElasticSearchService();
            $result = $s3Service->postLog($data);

            return $this->responseCustom($result);
        }
        catch (\Exception $e){
            return $this->responseCustom($e->getMessage(), 400);
        }
    }
}
