<?php

if (!function_exists('validate')) {

    /**
     * Create a new Validator instance.
     *
     * @param  array $data
     * @param  array $rules
     * @param  array $messages
     * @param  array $customAttributes
     */
    function validate(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        $v = validator($data, $rules, $messages, $customAttributes);

        if ($v->fails())
            abort(400, $v->messages()->first());
    }

}

if (!function_exists('dataBr')) {

    function dataBr($data)
    {
        $date = new \DateTime($data);
        return $date->format('d/m/Y');
    }

}

if (!function_exists('dataBrToDB')) {

    function dataBrToDB($data)
    {
        if(strpos($data, '/') !== false) {
            $date = \DateTime::createFromFormat('d/m/Y', $data);
            return $date->format('Y-m-d');
        }else{
            return $data;
        }
    }
}

if(!function_exists('cleanString')) {
    function cleanString($text) {
        $result  = preg_replace('/[^a-zA-Z0-9_ -.]/s','',$text);
        return $result;
    }
}
