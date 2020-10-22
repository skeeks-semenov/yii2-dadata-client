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

    public function findAffiliated($query, $count = 10, $kwargs = [])
    {
        $url = "findAffiliated/party";
        $data = ["query" => $query, "count" => $count];
        $data = $data + $kwargs;
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }

    public function findById($name, $query, $count = 10, $kwargs = [])
    {
        $url = "findById/$name";
        $data = ["query" => $query, "count" => $count];
        $data = $data + $kwargs;
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

    public function suggest($name, $query, $count = 10, $kwargs = [])
    {
        $url = "suggest/$name";
        $data = ["query" => $query, "count" => $count];
        $data = $data + $kwargs;
        $response = $this->sendPost($url, $data);
        return $response["suggestions"];
    }
}