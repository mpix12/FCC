<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/
$route['admin'] = 'login/index';
$route['admin/loginMe'] = 'login/loginMe';
$route['admin/dashboard'] = 'user';
$route['admin/logout'] = 'user/logout';
$route['admin/userListing'] = 'user/userListing';
$route['admin/userListing/(:num)'] = "user/userListing/$1";
$route['admin/addNew'] = "user/addNew";

$route['admin/addNewUser'] = "user/addNewUser";
$route['admin/editOld'] = "user/editOld";
$route['admin/editOld/(:num)'] = "user/editOld/$1";
$route['admin/editUser'] = "user/editUser";
$route['admin/deleteUser'] = "user/deleteUser";
$route['admin/loadChangePass'] = "user/loadChangePass";
$route['admin/changePassword'] = "user/changePassword";
$route['admin/pageNotFound'] = "user/pageNotFound";
$route['admin/checkEmailExists'] = "user/checkEmailExists";

$route['admin/forgotPassword'] = "login/forgotPassword";
$route['admin/resetPasswordUser'] = "login/resetPasswordUser";
$route['admin/resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['admin/resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['admin/resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['admin/createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */

// user routes
	// frontend
$route['user'] = 'userlogin';
$route['user/forgotpassword'] = 'userlogin/forgotpassword';
$route['user/signup'] = 'userlogin/signup';
$route['home'] = 'home';
$route['user/myaccount'] = 'home/myaccount';
$route['user/seeauctions'] = 'home/seeauctions';
$route['user/logout'] = 'home/logout';
$route['contact_us'] = 'home/contact_us';
$route['user/disableaccount'] = 'home/disableaccount';
$route['user/enableaccount'] = 'home/enableaccount';
$route['user/removeaccount'] = 'home/removeaccount';

	// backend
$route['user/b_signup'] = 'userlogin/b_signup';
$route['user/b_signin'] = 'userlogin/b_signin';

$route['user/b_action_add'] = 'home/b_action_add';
$route['user/b_action_down'] = 'home/b_action_down';

$route['user/b_save_firstname'] = 'home/b_save_firstname';
$route['user/b_save_lastname'] = 'home/b_save_lastname';
$route['user/b_save_email'] = 'home/b_save_email';
$route['user/b_save_username'] = 'home/b_save_username';
$route['user/b_save_phone'] = 'home/b_save_phone';
