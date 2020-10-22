<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\dadataClient;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class ProfileClient extends BaseClient
{
    /**
     * @var string
     */
    public $baseUrl = "https://dadata.ru/api/v2/";

    /**
     * Баланс пользователя
     * @see https://dadata.ru/api/balance/
     *
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getBalance()
    {
        $url = "profile/balance";
        $response = $this->sendGet($url);
        return (array) $response["balance"];
    }

    /**
     * Статистика использования
     * @see https://dadata.ru/api/stat/
     *
     * @param null $date
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getDailyStats($date = null)
    {
        $url = "stat/daily";
        if (!$date) {
            $date = new \DateTime();
        }
        $query = ["date" => $date->format("Y-m-d")];
        $response = $this->sendGet($url, $query);
        return (array) $response;
    }

    /**
     * Даты актуальности справочников
     * @see https://dadata.ru/api/version/
     *
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function getVersions()
    {
        $url = "version";
        $response = $this->sendGet($url);
        return (array) $response;
    }
}