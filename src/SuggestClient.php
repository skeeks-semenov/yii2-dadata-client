<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */

namespace skeeks\yii2\dadataClient;

use yii\base\Component;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Request;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class SuggestClient extends BaseClient
{
    /**
     * @var string
     */
    public $baseUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/";

    /**
     * Поиск аффилированных компаний
     * @see https://dadata.ru/api/find-affiliated/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function findAffiliated($query, array $data = [])
    {
        $url = "findAffiliated/party";
        $data = ArrayHelper::merge(["query" => $query], $data);
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }

    public function geolocate($name, $lat, $lon, $radiusMeters = 100, $count = 10, $kwargs = [])
    {
        $url = "geolocate/$name";
        $data = array(
            "lat" => $lat,
            "lon" => $lon,
            "radius_meters" => $radiusMeters,
            "count" => $count,
        );
        $data = $data + $kwargs;
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }

    public function iplocate($ip, $kwargs = [])
    {
        $url = "iplocate/address";
        $query = ["ip" => $ip];
        $query = $query + $kwargs;
        $response = $this->sendGet($url, $query);
        return $response["location"];
    }


    /**
     * @param       $name
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    protected function _suggest(string $name, $query, array $data = [])
    {
        $url = "suggest/$name";
        $data = ArrayHelper::merge(["query" => $query], $data);
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }

    /**
     * @param       $name
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    protected function _findById($name, $query, array $data = [])
    {
        $url = "findById/$name";
        $data = ArrayHelper::merge(["query" => $query], $data);
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }

    /**
     * Организация по ИНН или ОГРН
     * @see https://dadata.ru/api/find-party/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function findByIdParty($query, array $data = [])
    {
        return $this->_findById("party", $query, $data);
    }

    /**
     * Банк по БИК, SWIFT, ИНН или регистрационному номеру
     * @see https://dadata.ru/api/find-bank/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function findByIdBank($query, array $data = [])
    {
        return $this->_findById("bank", $query, $data);
    }

    /**
     * API подсказок по адресам
     * @see https://dadata.ru/api/suggest/address/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function address($query, array $data = [])
    {
        return $this->_suggest("address", $query, $data);
    }

    /**
     * API подсказок по организациям
     * @see https://dadata.ru/api/suggest/party/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function party($query, array $data = [])
    {
        return $this->_suggest("party", $query, $data);
    }

    /**
     * API подсказок по банкам
     * @see https://dadata.ru/api/suggest/bank/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function bank($query, array $data = [])
    {
        return $this->_suggest("bank", $query, $data);
    }

    /**
     * API подсказок по email
     * @see https://dadata.ru/api/suggest/email/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function email($query, array $data = [])
    {
        return $this->_suggest("email", $query, $data);
    }

    /**
     * API подсказок по ФИО
     * @see https://dadata.ru/api/suggest/name/
     *
     * @param       $query
     * @param array $data
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function fio($query, array $data = [])
    {
        return $this->_suggest("fio", $query, $data);
    }
}