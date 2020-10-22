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

    /**
     * API стандартизации ФИО
     * @see https://dadata.ru/api/clean/name/
     *
     * @param string $value
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function name(string $value)
    {
        return $this->_clean("name", $value);
    }

    /**
     * API стандартизации паспортов
     * @see https://dadata.ru/api/clean/passport/
     *
     * @param string $value
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function passport(string $value)
    {
        return $this->_clean("passport", $value);
    }

    /**
     * @param string $name
     * @param string $value
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function _clean(string $name, string $value)
    {
        $url = "clean/$name";
        $fields = [$value];
        $response = $this->sendPost($url, $fields);
        return (array) $response[0];
    }

    /**
     * @param $structure
     * @param $record
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function cleanRecord($structure, $record)
    {
        $url = "clean";
        $data = [
            "structure" => $structure,
            "data"      => [$record],
        ];
        $response = $this->sendPost($url, $data);
        return (array) $response["data"][0];
    }
}