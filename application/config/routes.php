<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home/index';
$route['trang-chu'] = 'home/index';

$route['video/(:any)'] = 'product/video/$1';
$route['videos'] = 'product/videos';
$route['videos/(:num)'] = 'product/videos/$1';
$route['danh-muc/(:any)'] = 'product/product_by_category/$1';
$route['danh-muc/(:any)/(:num)'] = 'product/product_by_category/$1/$1';
$route['san-pham/(:any)'] = 'product/detail_product/$1';
$route['danh-muc-bai-viet/(:any)'] = 'posts/listPost/$1';
$route['danh-muc-bai-viet/(:any)/(:num)'] = 'posts/listPost/$1/$1';
$route['bai-viet/(:any)'] = 'posts/detail_post/$1';
$route['gio-hang'] = 'cart/list_cart';
$route['dat-hang-thanh-cong'] = 'cart/booking_success';
$route['search?(:any)'] = 'search/index/$1';
$route['search?(:any)/(:num)'] = 'search/index/$1';


/*Trang admin*/
$route['admin'] = 'admin/dashboard';
$route['admin/login']='admin/login/login';

/* user */
$route['admin/user']='admin/user/index';
$route['admin/user/(:num)']='admin/user/index/$1';
$route['admin/user/insert']='admin/user/insert';
$route['admin/user/update/(:num)']='admin/user/update/$1';
$route['admin/user/delete/(:num)']='admin/user/delete/$1';

/*UPLOAD*/
$route['ajaxupload/upload_files']='admin/ajax_upload/upload_files';
$route['ajaxupload/upload_files_item_color']='admin/ajax_upload/upload_files_item_color';
$route['ajaxupload/delete_file']='admin/ajax_upload/delete_file';
$route['ajaxupload/delete_image_product']='admin/ajax_upload/delete_image_product';
$route['ajaxupload/delete_file_item_color']='admin/ajax_upload/delete_file_item_color';

$route['admin/category/(:num)']='admin/category/index/$1';
$route['admin/product/(:num)']='admin/product/index/$1';
$route['admin/content/(:num)']='admin/content/index/$1';

$route['admin/customer-feedback']='admin/CustomerFeedback/index';
$route['admin/customer-feedback/(:num)']='admin/CustomerFeedback/index/$1';
$route['admin/customer-feedback/insert']='admin/CustomerFeedback/insert';
$route['admin/customer-feedback/update/(:num)']='admin/CustomerFeedback/update/$1';
$route['admin/customer-feedback/delete/(:num)']='admin/CustomerFeedback/delete/$1';

$route['admin/orders/(:num)']='admin/orders/index/$1';
$route['admin/orders/view/(:any)']='admin/orders/viewAndEditOrder/$1';
$route['admin/orders/update/(:any)']='admin/orders/viewAndEditOrder/$1';

$route['admin/configs']='admin/configs/index';
$route['admin/config/update/(:num)']='admin/configs/update/$1';

$route['404'] = 'admin/ErrorController/error_404';
$route['404-page-not-found'] = 'ErrorController/error_404';

$route['(:any)'] = 'ErrorController/error_404';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
