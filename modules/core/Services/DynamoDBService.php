<?php
namespace Core\Services;

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\Laravel\AwsFacade as AWS;
use Illuminate\Support\Facades\Config;

class DynamoDBService extends BaseService
{
    protected $clientDynamo;

    public function __construct()
    {
        $config = Config::get('aws');
        //LOCAL
        //$this->clientDynamo = AWS::createClient('DynamoDb', ['region'=>'sa-east-1', 'endpoint'=> 'http://172.20.0.211:8000']);
        //Utiliza as credenciais
        $this->clientDynamo = AWS::createClient('DynamoDb', ['region'=>'sa-east-1']);
    }

    /**
     * @param $idUser
     * @param bool $onlyEdebeOn retorna apenas skus do tipo edebeOn
     * @return array
     */
    public function getSKUsByUser($idUser, $onlyEdebeOn = false)
    {
        $skus= [];
        //$tables =  $this->clientDynamo->listTables();
        $marshaler = new Marshaler();
        $eav = $marshaler->marshalJson('{
                    ":iduser": '.$idUser.' 
                 }'
            );

        try {
            $resultSkuUser = $this->clientDynamo->query(array(
                'TableName'     => 'AcessoPublicacaoUser',
                'KeyConditionExpression' => 'IdUser = :iduser',
                'ExpressionAttributeValues' => $eav

            ));
            if($onlyEdebeOn){
                $skusEdebeOn = $this->getSkusTypeEdebeOn();
            }

            foreach ($resultSkuUser['Items'] as $skuUser) {
                $sku =$marshaler->unmarshalValue($skuUser['SKU']);
                if($onlyEdebeOn) {
                    if(in_array($sku, $skusEdebeOn)){
                        array_push($skus, ['sku' => $marshaler->unmarshalValue($skuUser['SKU']), 'expires' => $marshaler->unmarshalValue($skuUser['Expire'])]);
                    }
                }else{
                    array_push($skus, ['sku' => $marshaler->unmarshalValue($skuUser['SKU']), 'expires' => $marshaler->unmarshalValue($skuUser['Expire'])]);
                }
            }

            return $skus;
        } catch (DynamoDbException $e) {
            throw $e;
        }
    }

    /**
     * Retorna os SKUS dos livros que são do tipo EdebeOn
     * @param bool $formatDynamoFilter retorna o array no formato de filtros para o DynamoDB
     * @return array
     */
    function getSkusTypeEdebeOn($formatDynamoFilter = false)
    {
        $skus= [];
        $marshaler = new Marshaler();
        $conditions = [':edebeon' => (int) 1];
        $eav = $marshaler->marshalJson(json_encode($conditions, true));

        try {
            $resultSkus = $this->clientDynamo->scan([
                'TableName'     => 'EdebelixPublicacao',
                'FilterExpression' => 'EdebeOn = :edebeon',
                'ExpressionAttributeValues' => $eav,
                'ProjectionExpression' => 'SKU'
            ]);
            $count = 0;
            foreach ($resultSkus['Items'] as $rskus) {
                if($formatDynamoFilter) {
                    $skus[':sku' . $count] = $rskus['SKU'];
                    $count++;
                    $skus[':sku' . $count] = $rskus['SKU'];
                }else{
                    array_push($skus, $marshaler->unmarshalValue($rskus['SKU']));
                }
            }

            return $skus;
        } catch (DynamoDbException $e) {
            throw $e;
        }
    }

    /**
     * Update Item in Database DynamoDB (AWS)
     * @param $tableName
     * @param $key  $key = $marshaler->marshalJson('{
                        "SKU": ' . $data->get('sku') . '
                    }');
     * @param $data $data = $marshaler->marshalJson('{
                        ":r": 1
                    }');
     * @param $expression $expression = 'set EdebeOn = :r';
     * @return mixed
     */
    public function updateItem($tableName, $key, $data, $expression, $expressionAttributeNames = false,
                               $conditionExpression = false){
//        $tables =  $this->clientDynamo->listTables();
//        dd($tables);
        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'UpdateExpression' => $expression,
            'ExpressionAttributeValues'=> $data,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        if($expressionAttributeNames){
            $params['ExpressionAttributeNames'] = $expressionAttributeNames;
        }

        if($conditionExpression){
            $params['ConditionExpression'] = $conditionExpression;
        }
//dd($params);
        try {
            $result = $this->clientDynamo->updateItem($params);

            return $result;
        } catch (DynamoDbException $e) {
            throw $e;
        }

    }

    /**
     * Update Item in Database DynamoDB (AWS)
     * @param $tableName
     * @param $key  $key = $marshaler->marshalJson('{
    "SKU": ' . $data->get('sku') . '
    }');
     * @param $data $data = $marshaler->marshalJson('{
    ":r": 1
    }');
     * @param $expression $expression = 'set EdebeOn = :r';
     * @return mixed
     */
    public function scan($tableName, $expressionAttributeValues, $filterExpression, $limitScanDynamo = false,
                         $limitPagination = null, $startWithKey = null){
        $params = [
            'TableName' => $tableName,
            'FilterExpression' => $filterExpression,
            'ExpressionAttributeValues'=> $expressionAttributeValues,

        ];

        if($limitScanDynamo) {
            $params['Limit'] = 200;
        }

        if($startWithKey) {
            $params['ExclusiveStartKey'] = $startWithKey;
        }

        try {
            $resultFinal = [];
            $allResulted = [];
            $marshaler = new Marshaler();

            do {
                $result = $this->clientDynamo->scan($params);
                foreach ($result['Items'] as $i) {
                    array_push($allResulted,$marshaler->unmarshalItem($i));
                }
                $lastEvalueateKey = $result['LastEvaluatedKey'];
                $params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
                if(($limitPagination && count($allResulted) > $limitPagination)) {
                    break;
                }
            } while (isset($result['LastEvaluatedKey']));

            $resultFinal['PerPage'] = $limitPagination;
            $resultFinal['Total'] = count($allResulted);
            $resultFinal['LastEvaluatedKey'] = $lastEvalueateKey ? $marshaler->unmarshalItem($lastEvalueateKey) : null;
            $resultFinal['Items'] = $allResulted;
            return $resultFinal;
        } catch (DynamoDbException $e) {
            throw $e;
        }

    }

    /**
     * @param $tableName
     * @param $item $item = $marshaler->marshalJson('{
        "year": ' . $year . ',
        "title": "' . $title . '"
        }');
     * @return mixed
     */
    public function putItem($tableName, $item){
        $params = [
            'TableName' => $tableName,
            'Item' => $item
        ];

//dd($params);
        try {
            $result = $this->clientDynamo->putItem($params);

            return $result;
        } catch (DynamoDbException $e) {
            throw $e;
        }

    }
}
