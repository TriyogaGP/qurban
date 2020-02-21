<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['login'] = 'welcome';
$route['dashboard'] = 'Dashboard';
$route['auth'] = 'login_dashboard/auth';
$route['logout'] = 'login_dashboard/logout';


$route['admin'] = 'Dashboard/admin';
$route['addadmin'] = 'Dashboard/addadmin';
$route['saveadmin'] = 'Dashboard/saveadmin';
$route['editadmin/(:num)'] = 'Dashboard/editadmin/$1';
$route['updateadmin'] = 'Dashboard/updateadmin';
$route['deleteadmin/(:num)'] = 'Dashboard/deleteadmin/$1';
$route['detailadmin/(:num)'] = 'Dashboard/detailadmin/$1';


$route['compro'] = 'Dashboard/compro';
$route['addcomprokategori'] = 'Dashboard/addcomprokategori';
$route['savecomprokategori'] = 'Dashboard/savecomprokategori';
$route['editcomprokategori/(:num)'] = 'Dashboard/editcomprokategori/$1';
$route['updatecomprokategori'] = 'Dashboard/updatecomprokategori';
$route['deletecomprokategori/(:num)'] = 'Dashboard/deletecomprokategori/$1';
$route['addcomprocatalog'] = 'Dashboard/addcomprocatalog';
$route['savecomprocatalog'] = 'Dashboard/savecomprocatalog';
$route['editcomprocatalog/(:num)/(:num)'] = 'Dashboard/editcomprocatalog/$1/$2';
$route['updatecomprocatalog'] = 'Dashboard/updatecomprocatalog';
$route['deletecomprocatalog/(:num)'] = 'Dashboard/deletecomprocatalog/$1';
$route['keranjang'] = 'Dashboard/keranjang';
$route['viewkeranjang'] = 'Dashboard/viewkeranjang';
$route['addkeranjang/(:num)/(:num)'] = 'Dashboard/addkeranjang/$1/$2';
$route['paidkeranjang/(:num)/(:num)'] = 'Dashboard/paidkeranjang/$1/$2';
$route['deletekeranjang/(:num)/(:num)'] = 'Dashboard/deletekeranjang/$1/$2';
$route['deleteallkeranjang/(:num)'] = 'Dashboard/deleteallkeranjang/$1';
$route['customer/(:num)'] = 'Dashboard/customer/$1';
$route['viewcustomer/(:num)'] = 'Dashboard/viewcustomer/$1';
$route['editcustomer/(:num)'] = 'Dashboard/editcustomer/$1';
$route['editcustomerbanyak/(:num)'] = 'Dashboard/editcustomerbanyak/$1';
$route['updatecustomer'] = 'Dashboard/updatecustomer';
$route['updatecustomerbanyak'] = 'Dashboard/updatecustomerbanyak';
$route['deletecustomer/(:num)/(:num)'] = 'Dashboard/deletecustomer/$1/$2';
$route['uploadbukti/(:num)'] = 'Dashboard/uploadbukti/$1';
$route['updateuploadbukti'] = 'Dashboard/updateuploadbukti';
$route['updateuploadbuktipelunasan'] = 'Dashboard/updateuploadbuktipelunasan';
$route['downloadbukti/(:any)'] = 'Dashboard/downloadbukti/$1';
$route['lihatnotif/(:num)'] = 'Dashboard/lihatnotif/$1';
$route['pelunasan/(:num)'] = 'Dashboard/pelunasan/$1';
$route['getnotifAdmin'] = 'Dashboard/getnotifAdmin';
$route['getnotifReseller'] = 'Dashboard/getnotifReseller';
$route['uploadbuktiDPLUNAS/(:num)'] = 'Dashboard/uploadbuktiDPLUNAS/$1';
$route['approvepembelian/(:num)'] = 'Dashboard/approvepembelian/$1';
$route['historykeranjang'] = 'Dashboard/historykeranjang';
$route['Fetchhistorykeranjang'] = 'Dashboard/Fetchhistorykeranjang';
$route['historycustomer'] = 'Dashboard/historycustomer';
$route['Fetchhistorycustomer'] = 'Dashboard/Fetchhistorycustomer';
$route['lookkeranjangReseller'] = 'Dashboard/lookkeranjangReseller';
$route['checkoutallkeranjang'] = 'Dashboard/checkoutallkeranjang';

//CRONJOB
$route['dailyActivitypesan'] = 'Cronjob/deleteDailyKeranjangPesan';
$route['dailyActivitypaid'] = 'Cronjob/deleteDailyKeranjangPaid';
$route['dailyActivitypaidDP'] = 'Cronjob/deleteDailyKeranjangPaidDP';
$route['dailyActivityverify'] = 'Cronjob/deleteDailyKeranjangVerified';
$route['dailyActivityapprove'] = 'Cronjob/deleteDailyKeranjangApproved';
$route['soldout'] = 'Cronjob/soldout';

//JSON
$route['loginreseller'] = 'Json/loginreseller';
$route['getmenu'] = 'Json/getmenu';
$route['gethewan'] = 'Json/gethewan';
$route['getcarihewan'] = 'Json/getcarihewan';
$route['addcart'] = 'Json/addcart';
$route['orderhewan'] = 'Json/orderhewan';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
