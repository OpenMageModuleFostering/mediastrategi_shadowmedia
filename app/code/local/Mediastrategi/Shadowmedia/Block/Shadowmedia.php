<?php
class Mediastrategi_Shadowmedia_Block_Shadowmedia
    extends Mage_Core_Block_Template
{
    const COOKIE_KEY_SOURCE = 'mediastrategi_shadowmedia_source';
    public $units = array(
        'seconds'   => 1,
        'minutes'   => 60,
        'hours'     => 3600,
        'days'      => 86400,
        'weeks'     => 604800,
        'months'    => 2419200,
        'years'     => 29030400
    );

    public function __construct() {
        Mage::Log('test');
    }

    public function getIsActive()
    {
        return Mage::getStoreConfig(
            'mediastrategi_shadowmedia/general/status'
        ) ? true : false;
    }

    public function getCookie()
    {
        return Mage::getModel('core/cookie')->get(
            self::COOKIE_KEY_SOURCE
        );
    }

    public function setCookie()
    {
        return Mage::getModel('core/cookie')->set(
            self::COOKIE_KEY_SOURCE,
            'shadowmedia',
            $this->_getCookieLifetime()
        );
    }

    public function getContent()
    {
        return Mage::getStoreConfig(
            'mediastrategi_shadowmedia/content/content'
        );
    }

    protected function _getCookieLifetime()
    {
        $unit = $this->units[Mage::getStoreConfig(
            'mediastrategi_shadowmedia/cookie/timeout_unit'
        )];

        $timeout = Mage::getStoreConfig(
            'mediastrategi_shadowmedia/cookie/timeout'
        );

        return (int)$unit * $timeout;
    }
}
