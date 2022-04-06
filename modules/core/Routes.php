<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cloud-front', 'as' => 'cloud-front.'], function () {
    Route::get('invalidate-object', ['as' => 'invalidate-objetc', 'uses' => 'CloudFrontController@invalidateObject']);
});
Route::group(['prefix' => 's3', 'as' => 's3.'], function () {
    Route::get('get-object', ['as' => 'get-object', 'uses' => 'S3Controller@getObject']);
});
Route::group(['prefix' => 'es', 'as' => 'es.'], function () {
    Route::post('/', ['as' => 'create', 'uses' => 'ElasticSearchController@create']);
});

Route::group(['prefix' => 'lambda', 'as' => 'lambda.'], function () {
    Route::get('get-function', ['as' => 'get-funtion', 'uses' => 'LambdaController@getFunction']);
});

Route::group(['prefix' => 'dynamodb', 'as' => 'dynamodb.'], function () {
    Route::post('scan', ['as' => 'scan', 'uses' => 'DynamoDBController@scan']);
});
