<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\dadataClient\models;


use yii\base\Model;
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class PartyNameModel extends Model
{
    /**
     * @var string
     */
    public $full_with_opf;
    /**
     * @var string
     */
    public $short_with_opf;
    /**
     * @var string
     */
    public $latin;
    /**
     * @var string
     */
    public $full;
    /**
     * @var string
     */
    public $short;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->short_with_opf;
    }
}