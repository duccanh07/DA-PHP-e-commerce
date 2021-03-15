<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/* CUSTOM CONSTANT */
define('SESSION_SYSTEM_NAME', 'sessionUserAdmin');
define('URL_404', '404-page-not-found');

define('PATH_IMAGES', 'assets/images/');

define('CURRENTCY_UNIT', 'đ');

define('KIND_ADMIN', 1);
define('KIND_CUSTOMER', 2);

define('STATUS_ACTIVE', 1);
define('STATUS_DELETE', -2);
define('STATUS_BLOCK', -1);
define('STATUS_PENDING', 0);

//Định nghĩ giới tính
define('SEX_MALE',1);
define('SEX_FEMALE',2);
define('SEX_ORTHER',3);
define('ID_NEWS_TOPIC',20);

//Định nghĩa kind images
define('KIND_IMAGES_PRODUCT', 1);
define('KIND_BANNER', 2);
define('KIND_IMAGES_SLIDER', 3);
define('KIND_AVATAR_USER', 4);
define('KIND_AVATAR_NEWS', 5);
define('KIND_ICON_CATEGORY', 6);
define('KIND_LOGO_AGENCY', 7);
define('KIND_AVATAR_CUSTOMER_FEEDBACK', 8);
define('KIND_IMG_POLICI', 8);

define('TYPE_SLIDER', 1);
define('TYPE_BANNER', 2);
define('TYPE_LOGO_AGENCY', 3);

//Số mẫu tin / 1 trang
define('TOTAL_ITEM_PAGING', 10);

define('DEFAULT_PARENT_ID', -1);

define('TYPE_CATEGORY_HOME', 0);
define('TYPE_CATEGORY_PRODUCT', 1);
define('TYPE_CATEGORY_CONTENT', 2);
define('TYPE_CATEGORY_PRODUCT_ONE', 3);
define('TYPE_CATEGORY_CONTENT_ONE', 4);
define('TYPE_CATEGORY_DU_AN', 5);
define('TYPE_CATEGORY_VIDEO_CONG_TRINH', 6);

define('LIMIT_PRODUCT_SHOW_HOME', 8);
define('LIMIT_PRODUCT_SHOW_CATEGORY', 20);
define('LIMIT_CONTENT_LIST', 20);

define('LIMIT_POSTS_SHOW_HOME', 8);

define('SESSION_SAVE_LIST_IMAGES', 'listImagesUpload');
define('SESSION_LIST_IMAGES_ITEM_COLOR', 'listImagesUploadItemColor');
define('STATE_IMAGES_TMP', 0);
define('STATE_IMAGES_IMG', 1);

define('KIND_NEWS',1);
define('KIND_ORTHER',0);

define('TYPE_TINH',1);
define('TYPE_THANH_PHO',2);

define('TYPE_QUAN',1);
define('TYPE_HUYEN',2);
define('TYPE_TP',3);
define('TYPE_THIXA',4);
define('TYPE_XA',1);
define('TYPE_PHUONG',2);
define('TYPE_THI_TRAN',3);

define('PAYMENT_THANH_TOAN_KHI_NHAN_HANG', 1);

define('EMAIL_REPLACE', 'ngotrungphat@gmail.com');

define('PASSWORD_DEFAULT_SYS', '601f1889667efaebb33b8c12572835da3f027f78');

define('STATE_ORDER_ORDERING', 0);
define('STATE_ORDER_PROCESSING', 1);
define('STATE_ORDER_SHIPPING', 2);
define('STATE_ORDER_COMPLETE', 3);
define('STATE_ORDER_CANCEL', 4);

define('CATEGORY_ALLOW_SHOW_IN_HOME', 1);
define('CATEGORY_NOT_ALLOW_SHOW_IN_HOME', 0);
define('CATEGORY_ALLOW_SHOW_IN_MENU', 1);
define('CATEGORY_NOT_ALLOW_SHOW_IN_MENU', 0);

define('PRODUCT_IS_SALE', 1);
define('PRODUCT_IS_NOT_SALE', 0);

define('PRODUCT_IS_HOT', 1);
define('PRODUCT_IS_NOT_HOT', 0);

define('PRODUCT_IS_HOT_SALE', 1);
define('PRODUCT_IS_NOT_HOT_SALE', 0);

define('PRODUCT_IS_NEW', 1);
define('PRODUCT_IS_NOT_NEW', 0);

define('PRODUCT_IS_PRODUCT_VIDEO', 1);
define('PRODUCT_IS_NOT_PRODUCT_VIDEO', 0);

define('RESPONSE_CODE_SUCCESS', 1);
define('RESPONSE_CODE_ERROR', 2);

define('PRODUCT_ON', 1);
define('PRODUCT_OFF', 0);


define('POLICIES_TYPE_HOME_PAGE', 1);
define('POLICIES_TYPE_ORTHER', 2);

define('OPTION_FILLTER_NO_PRICE', 1);
define('OPTION_FILLTER_PRICE', 6);
define('OPTION_FILLTER_HOT_SALE', 2);
define('OPTION_FILLTER_HOT', 3);
define('OPTION_FILLTER_NEW', 4);
define('OPTION_FILLTER_PRODUCT_VIDEO', 5);

define('CONFIG_CODE_SEO_WEB', 'SEO_WEB');
define('CONFIG_CODE_CONTACT_SHOP', 'CONTACT_SHOP');
define('CONFIG_CODE_EMAIL', 'EMAIL');
define('CONFIG_CODE_MXH', 'MXH');
define('CONFIG_CODE_FOOTER', 'FOOTER');
define('CONFIG_CODE_LOGO', 'LOGO');
define('CONFIG_CODE_LOGO_FOOTER', 'LOGO_FOOTER');
define('CONFIG_CODE_HOME_PAGE_BANNER', 'HOME_PAGE_BANNER');
define('CONFIG_CODE_HOME_ICONS', 'HOME_PAGE_ICONS');
define('CONFIG_CODE_HOME_PAGE_BANNER_TOP', 'HOME_PAGE_BANNER_TOP');
define('CONFIG_CODE_MAIL_SMTP', 'MAIL_SMTP');
define('CONFIG_CODE_ICONS_CONTACT', 'ICONS_CONTACT');

defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
