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
    "value": "ООО \"КАЛУГА-ЛАДА\"",
    "unrestricted_value": "ООО \"КАЛУГА-ЛАДА\"",
    "data": {
        "kpp": "402901001",
        "capital": null,
        "management": null,
        "founders": null,
        "managers": null,
        "branch_type": "MAIN",
        "branch_count": 0,
        "source": null,
        "qc": null,
        "hid": "f06f3558f0507b75d65573b248d1bae8d28750646b352ab0966df63fa618cbb9",
        "type": "LEGAL",
        "state": {
            "status": "ACTIVE",
            "actuality_date": 1590451200000,
            "registration_date": 907027200000,
            "liquidation_date": null
        },
        "opf": {
            "type": "2014",
            "code": "12300",
            "full": "Общество с ограниченной ответственностью",
            "short": "ООО"
        },
        "name": {
            "full_with_opf": "ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ \"КАЛУГА-ЛАДА\"",
            "short_with_opf": "ООО \"КАЛУГА-ЛАДА\"",
            "latin": null,
            "full": "КАЛУГА-ЛАДА",
            "short": "КАЛУГА-ЛАДА"
        },
        "inn": "4004010487",
        "ogrn": "1024000566369",
        "okpo": "48361552",
        "okato": "29401000000",
        "oktmo": "29701000001",
        "okogu": "4210014",
        "okfs": "16",
        "okved": "45.11.2",
        "okveds": null,
        "authorities": null,
        "documents": null,
        "licenses": null,
        "finance": {
            "tax_system": null,
            "income": null,
            "expense": null,
            "debt": null,
            "penalty": null
        },
        "address": {
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
        },
        "phones": null,
        "emails": null,
        "ogrn_date": 1035504000000,
        "okved_type": "2014",
        "employee_count": null
    }
}*/
/**
 * @property string $kpp
 * @property string $type
 * @property string $ogrn
 * @property string $inn
 * @property PartyNameModel $name
 * @property AddressModel $address
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class PartyModel extends Model
{
    /**
     * @var
     */
    public $value;

    /**
     * @var
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
     * @param string $key
     * @return mixed
     */
    public function getDataValue(string $key, $default = null)
    {
        return ArrayHelper::getValue($this->data, $key, $default = null);
    }

    /**
     * @return string
     */
    public function getKpp()
    {
        return (string) $this->getDataValue("kpp");
    }

    /**
     * @return string
     */
    public function getType()
    {
        return (string) $this->getDataValue("type");
    }

    /**
     * @return string
     */
    public function getInn()
    {
        return (string) $this->getDataValue("inn");
    }

    /**
     * @return string
     */
    public function getOgrn()
    {
        return (string) $this->getDataValue("ogrn");
    }

    /**
     * @return PartyNameModel
     */
    public function getName()
    {
        return new PartyNameModel((array) $this->getDataValue("name"));
    }

    /**
     * @return AddressModel
     */
    public function getAddress()
    {
        return new AddressModel((array) $this->getDataValue("address"));
    }
}