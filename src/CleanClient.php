<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */

namespace skeeks\yii2\dadataClient;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class CleanClient extends BaseClient
{
    /**
     * @var string
     */
    public $baseUrl = "https://cleaner.dadata.ru/api/v1/";

    public function clean($name, $value)
    {
        $url = "clean/$name";
        $fields = [$value];
        $response = $this->sendPost($url, $fields);
        return $response[0];
    }

    public function cleanRecord($structure, $record)
    {
        $url = "clean";
        $data = [
            "structure" => $structure,
            "data"      => [$record],
        ];
        $response = $this->sendPost($url, $data);
        return $response["data"][0];
    }
}