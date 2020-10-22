<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */

namespace skeeks\yii2\dadataClient;

use yii\base\Component;
/**
 * @property SuggestClient $suggest
 * @property ProfileClient $profile
 * @property CleanClient   $clean
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class DadataClient extends Component
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
     * @var null|CleanClient
     */
    public $_clean = null;

    /**
     * @var null|ProfileClient
     */
    public $_profile = null;

    /**
     * @var null|SuggestClient
     */
    public $_suggest = null;

    /**
     * @return SuggestClient
     */
    public function getSuggest()
    {
        if ($this->_suggest === null) {
            $this->_suggest = new SuggestClient([
                'token'   => $this->token,
                'secret'  => $this->secret,
                'timeout' => $this->timeout,
            ]);
        }

        return $this->_suggest;
    }

    /**
     * @param SuggestClient $suggestClient
     * @return $this
     */
    public function setSuggest(SuggestClient $suggestClient)
    {
        $this->_suggest = $suggestClient;
        return $this;
    }

    /**
     * @return ProfileClient|null
     */
    public function getProfile()
    {
        if ($this->_profile === null) {
            $this->_profile = new ProfileClient([
                'token'   => $this->token,
                'secret'  => $this->secret,
                'timeout' => $this->timeout,
            ]);
        }

        return $this->_profile;
    }

    /**
     * @param ProfileClient $profileClient
     * @return $this
     */
    public function setProfile(ProfileClient $profileClient)
    {
        $this->_profile = $profileClient;
        return $this;
    }

    /**
     * @return CleanClient
     */
    public function getClean()
    {
        if ($this->_clean === null) {
            $this->_clean = new CleanClient([
                'token'   => $this->token,
                'secret'  => $this->secret,
                'timeout' => $this->timeout,
            ]);
        }

        return $this->_clean;
    }

    /**
     * @param CleanClient $cleanClient
     * @return $this
     */
    public function setClean(CleanClient $cleanClient)
    {
        $this->_clean = $cleanClient;
        return $this;
    }
}