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
abstract class BaseClient extends Component
{
    /**
     * @var string
     */
    public $token = '';

    /**
     * @var string
     */
    public $secret = '';

    /**
     * @var int set timeout to 15 seconds for the case server is not responding
     */
    public $timeout = 2;

    /**
     * @var string
     */
    public $baseUrl = "";

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->token) {
            throw new InvalidConfigException("Не указан token");
        }

        if (!$this->baseUrl) {
            throw new InvalidConfigException("Не указан базовый url api");
        }
    }

    /**
     * @return Request
     * @throws \yii\base\InvalidConfigException
     */
    public function _createHttpRequest()
    {
        $client = new Client();
        $client->requestConfig = ['format' => Client::FORMAT_JSON];

        $request = $client
            ->createRequest()
            ->addHeaders(['Authorization' => "Token ".$this->token])
            ->addHeaders(['Accept' => 'application/json'])
            ->addHeaders(['Content-type' => 'application/json'])
            ->setOptions([
                'timeout' => $this->timeout,
            ]);

        if ($this->secret) {
            $request->addHeaders(['X-Secret' => $this->secret]);
        }

        return $request;
    }

    /**
     * @param string $apiMethod
     * @param array  $query
     * @return array
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function sendGet(string $apiMethod, array $query = [])
    {
        $url = $this->baseUrl.$apiMethod;
        return $this->send($url, $query, "GET");
    }

    /**
     * @param string $apiMethod
     * @param array  $data
     * @return array
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function sendPost(string $apiMethod, array $data = [])
    {
        $url = $this->baseUrl.$apiMethod;
        return $this->send($url, $data);
    }

    /**
     * @param        $url
     * @param array  $data
     * @param string $requestMethod
     * @return array
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function send($url, array $data = [], $requestMethod = "POST")
    {
        $httpRequest = $this->_createHttpRequest();
        $httpRequest->setMethod($requestMethod);
        $httpRequest->setUrl($url);
        $httpRequest->setData($data);
        $httpResponse = $httpRequest->send();

        if ($httpResponse->isOk) {
            return (array)$httpResponse->data;
        }

        if (!$message = $this->_getMessageByStatusCode($httpResponse->statusCode)) {
            $message = $httpResponse->content;
        }
        throw new Exception("Ошибка: ".$message);
    }


    /**
     * Коды ответа на запрос
     *
     * @see https://dadata.ru/api/suggest/#response-address
     * @var array
     */
    static public $errorStatuses = [
        '400' => 'Некорректный запрос',
        '401' => 'В запросе отсутствует API-ключ',
        '403' => 'В запросе указан несуществующий API-ключ',
        '404' => 'Запрошенный метод апи не существует',
        '405' => 'Запрос сделан с методом, отличным от POST',
        '413' => 'Нарушены ограничения',
        '500' => 'Произошла внутренняя ошибка сервиса во время обработки',
    ];

    /**
     * @param $httpStatusCode
     *
     * @return string
     */
    public function _getMessageByStatusCode($httpStatusCode)
    {
        return (string)ArrayHelper::getValue(static::$errorStatuses, (string)$httpStatusCode, $httpStatusCode);
    }
}