<?php

	function getInfoUserHelper() {
		$ci =& get_instance();
		return $ci->session->userdata(SESSION_SYSTEM_NAME);
	}

	function getTimeHelper() {
		date_default_timezone_set('Asia/Ho_Chi_Minh'); # add your city to set local time zone
		return date('Y-m-d H:i:s');
	}

	function getFirstFromJsonString($json) {
		return json_decode($json)[0];
	}

	function getConfigByCode($code) {
		$ci =& get_instance();
		$config = $ci->Mconfig->configDetailByCode($code);
		$config['value'] = json_decode($config['value']);
		return $config;
	}

	function getConfigs() {
		$configs = array(
			'seoConfig' => getConfigByCode(CONFIG_CODE_SEO_WEB),
			'contactConfig' => getConfigByCode(CONFIG_CODE_CONTACT_SHOP),
			'iconsContactConfig' => getConfigByCode(CONFIG_CODE_ICONS_CONTACT),
			'footerConfig' => getConfigByCode(CONFIG_CODE_FOOTER),
			'logoConfig' => getConfigByCode(CONFIG_CODE_LOGO),
            'logoFooterConfig' => getConfigByCode(CONFIG_CODE_LOGO_FOOTER),
			'emailConfig' => getConfigByCode(CONFIG_CODE_MAIL_SMTP)
		);
		return $configs;
	}

    function renderAliasByType($type) {
    	switch ($type) {
    		case TYPE_CATEGORY_CONTENTS:
    			return base_url().'danh-muc-bai-viet/';
			case TYPE_CATEGORY_HOME:
				return base_url();
			case TYPE_CATEGORY_PRODUCTS:
				return base_url().'danh-muc/';
			case TYPE_CATEGORY_CONTENT_ONE:
				return base_url().'bai-viet/';
            case TYPE_CATEGORY_MENU:
                return base_url().'menu/';
    		default:
    			return false;
    	}
    }
