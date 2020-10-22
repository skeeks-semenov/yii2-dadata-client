<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\dadataClient\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

/*{
    "value": "г Калуга, ул Зерновая, д 17",
    "unrestricted_value": "248025, Калужская обл, г Калуга, ул Зерновая, д 17",
    "data": {
        "postal_code": "248025",
        "country": "Россия",
        "country_iso_code": "RU",
        "federal_district": "Центральный",
        "region_fias_id": "18133adf-90c2-438e-88c4-62c41656de70",
        "region_kladr_id": "4000000000000",
        "region_iso_code": "RU-KLU",
        "region_with_type": "Калужская обл",
        "region_type": "обл",
        "region_type_full": "область",
        "region": "Калужская",
        "area_fias_id": null,
        "area_kladr_id": null,
        "area_with_type": null,
        "area_type": null,
        "area_type_full": null,
        "area": null,
        "city_fias_id": "b502ae45-897e-4b6f-9776-6ff49740b537",
        "city_kladr_id": "4000000100000",
        "city_with_type": "г Калуга",
        "city_type": "г",
        "city_type_full": "город",
        "city": "Калуга",
        "city_area": null,
        "city_district_fias_id": null,
        "city_district_kladr_id": null,
        "city_district_with_type": null,
        "city_district_type": null,
        "city_district_type_full": null,
        "city_district": null,
        "settlement_fias_id": null,
        "settlement_kladr_id": null,
        "settlement_with_type": null,
        "settlement_type": null,
        "settlement_type_full": null,
        "settlement": null,
        "street_fias_id": "45d1c15a-3ebf-46e0-b1a4-1fc31219c125",
        "street_kladr_id": "40000001000013300",
        "street_with_type": "ул Зерновая",
        "street_type": "ул",
        "street_type_full": "улица",
        "street": "Зерновая",
        "house_fias_id": "46e0236b-2d17-4c0e-b34d-26aba5323408",
        "house_kladr_id": "4000000100001330002",
        "house_type": "д",
        "house_type_full": "дом",
        "house": "17",
        "block_type": null,
        "block_type_full": null,
        "block": null,
        "flat_type": null,
        "flat_type_full": null,
        "flat": null,
        "flat_area": null,
        "square_meter_price": null,
        "flat_price": null,
        "postal_box": null,
        "fias_id": "46e0236b-2d17-4c0e-b34d-26aba5323408",
        "fias_code": "40000001000000001330002",
        "fias_level": "8",
        "fias_actuality_state": "0",
        "kladr_id": "4000000100001330002",
        "geoname_id": "553915",
        "capital_marker": "2",
        "okato": "29401000000",
        "oktmo": "29701000001",
        "tax_office": "4029",
        "tax_office_legal": "4029",
        "timezone": "UTC+3",
        "geo_lat": "54.5426744",
        "geo_lon": "36.3021847",
        "beltway_hit": null,
        "beltway_distance": null,
        "metro": null,
        "qc_geo": "0",
        "qc_complete": null,
        "qc_house": null,
        "history_values": null,
        "unparsed_parts": null,
        "source": "248025, ОБЛАСТЬ КАЛУЖСКАЯ, ГОРОД КАЛУГА, УЛИЦА ЗЕРНОВАЯ, 17, -, -",
        "qc": "0"
    }
}*/

/**
 * @property array $coordinates;
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class AddressModel extends Model
{
    /**
     * @var string Адрес одной строкой (как показывается в списке подсказок)
     */
    public $value;

    /**
     * @var string Адрес одной строкой (полный, с индексом)
     */
    public $unrestricted_value;

    /**
     * @var
     */
    public $data;


    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->unrestricted_value;
    }

    /**
     * Строка региона, без адреса
     * Регион, район, город, поселение
     *
     * @return string
     */
    public function getRegionString()
    {
        //Оно может быть не сохранено если определяли по ip
        $result = [];

        $result[] = ArrayHelper::getValue($this->data, 'region_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'area_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'city_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'settlement_with_type');

        $result = array_unique($result);

        foreach ($result as $key => $value)
        {
            if (!$value)
            {
                unset($result[$key]);
            }
        }

        return implode(", ", $result);
    }

    /**
     * @return array
     */
    public function getRegionArray()
    {
        $result = [];

        if (ArrayHelper::getValue($this->data, 'region'))
        {
            $result['region'] = ArrayHelper::getValue($this->data, 'region');
        }

        if (ArrayHelper::getValue($this->data, 'area'))
        {
            $result['area'] = ArrayHelper::getValue($this->data, 'area');
        }

        if (ArrayHelper::getValue($this->data, 'city'))
        {
            $result['city'] = ArrayHelper::getValue($this->data, 'city');
        }
        if (ArrayHelper::getValue($this->data, 'settlement'))
        {
            $result['settlement'] = ArrayHelper::getValue($this->data, 'settlement');
        }

        return $result;
    }

    /**
     * Короткий адрес, без города
     * Улица, дом, квартира
     *
     * @return string
     */
    public function getShortAddressString()
    {
        //Оно может быть не сохранено если определяли по ip
        $result = [];

        $result[] = ArrayHelper::getValue($this->data, 'street_with_type');

        if (ArrayHelper::getValue($this->data, 'house'))
        {
            $result[] = ArrayHelper::getValue($this->data, 'house_type') . " " . ArrayHelper::getValue($this->data, 'house');
        }
        if (ArrayHelper::getValue($this->data, 'flat'))
        {
            $result[] = ArrayHelper::getValue($this->data, 'flat_type') . " " . ArrayHelper::getValue($this->data, 'flat');
        }

        $result = array_unique($result);

        foreach ($result as $key => $value)
        {
            if (!$value)
            {
                unset($result[$key]);
            }
        }

        return implode(", ", $result);
    }

    /**
     * @return array|null
     */
    public function getCoordinates()
    {
        if (ArrayHelper::getValue($this->data, 'geo_lat') && ArrayHelper::getValue($this->data, 'geo_lon'))
        {
            return [(float) ArrayHelper::getValue($this->data, 'geo_lat'), (float) ArrayHelper::getValue($this->data, 'geo_lon')];
        }

        return null;
    }
}