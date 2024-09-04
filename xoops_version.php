<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TADASSIGN_NAME;
// $modversion['version'] = 2.7;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TADASSIGN_DESC;
$modversion['author'] = _MI_TADASSIGN_AUTHOR;
$modversion['credits'] = _MI_TADASSIGN_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2022=01-28';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5';
$modversion['min_tadtools'] = '2.02';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation : ' . _MI_TAD_WEB;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_assignment';
$modversion['tables'][2] = 'tad_assignment_file';
$modversion['tables'][3] = 'tad_assignment_types';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$modversion['sub'][2]['name'] = _MI_TADASSIGN_SMNAME2;
$modversion['sub'][2]['url'] = 'show.php';

//---樣板設定---//
$i = 1;
$modversion['templates'][$i]['file'] = 'tad_assignment_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_index.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_assignment_show.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_show.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_assignment_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_main.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_assignment_adm_add.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_add.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_assignment_adm_add_type.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_add_type.tpl';

//---區塊設定---//
$modversion['blocks'][1]['file'] = 'tad_new_assignment.php';
$modversion['blocks'][1]['name'] = _MI_TADASSIGN_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADASSIGN_BDESC1;
$modversion['blocks'][1]['show_func'] = 'tad_new_assignment';
$modversion['blocks'][1]['template'] = 'tad_new_assignment.tpl';
