<?php
namespace Core\Controllers;
use Aws\DynamoDb\Marshaler;
use Core\Services\DynamoDBService;

class DynamoDBController extends BaseController
{
    /**
     * EX:
     {
        "table": "ArquivosEdu",
        "values": {
            ":idAccountUpload": 222159,
            ":nome": "Exerc"
        },
        "filterExpression": "IdAccountUpload = :idAccountUpload and begins_with(Nome, :nome)"
    }
     * @return \Illuminate\Http\JsonResponse
     */
    public function scan()
    {
        try {
            $data = collect(request()->all());
            validate($data->toArray(), [
                'filterExpression' => 'required',
                'values' => 'required',
                'table' => 'required'
            ], [
                'filterExpression.required' => 'Informe a condição a ser recuperados.',
                'values.required' => 'Informe os valoes a serem recuperados.',
                'table.required' => 'Informe a tabela que deseja buscar as informações.',
            ]);

            $marshaler = new Marshaler();
            $keys = $marshaler->marshalJson(json_encode($data->get('values')));

            $ddbService = new DynamoDBService();
            $result = $ddbService->scan($data->get('table'), $keys, $data->get('filterExpression'),
                $data->get("limitDynamoDB"),
                $data->get("perPage"), $data->get('startWithKey'));

            return $this->responseCustom($result);
        }
        catch (\Exception $e){
            return $this->responseCustom($e->getMessage(), 400);
        }
    }
}
