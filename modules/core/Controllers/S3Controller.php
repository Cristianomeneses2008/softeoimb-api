<?php
namespace Core\Controllers;

use Core\Services\S3Service;

class S3Controller extends BaseController
{
    public function getObject()
    {
        try {
            $data = collect(request()->all());
            $url = null;
            validate($data->toArray(), [
                'key' => 'required',
                'bucket' => 'required'
            ], [
                'key.required' => 'Informe a key do objeto a ser recuperado.',
                'bucket.required' => 'Informe o bucket que deseja recuperar o objeto.',
            ]);

            $s3Service = new S3Service();
            $result = $s3Service->getByKey($data->get('key'), $data->get('bucket'));

            return $this->responseCustom($result);
        }
        catch (\Exception $e){
            return $this->responseCustom($e->getMessage(), 400);
        }
    }
}
