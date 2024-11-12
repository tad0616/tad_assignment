<?php
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TAD_ASSIGNMENT_NAME;
// $modversion['version'] = 2.7;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TAD_ASSIGNMENT_DESC;
$modversion['author'] = _MI_TAD_ASSIGNMENT_AUTHOR;
$modversion['credits'] = _MI_TAD_ASSIGNMENT_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-11-18';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = [
    'tad_assignment',
    'tad_assignment_file',
    'tad_assignment_types',
];

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
$modversion['sub'] = [
    ['name' => _MI_TAD_ASSIGNMENT_SMNAME2, 'url' => 'show.php'],
    ['name' => _MI_TAD_ASSIGNMENT_SMNAME3, 'url' => 'post.php'],
];

//---樣板設定---//
$modversion['templates'] = [
    ['file' => 'tad_assignment_index.tpl', 'description' => 'tad_assignment_index.tpl'],
    ['file' => 'tad_assignment_admin.tpl', 'description' => 'tad_assignment_admin.tpl'],
];

//---區塊設定---//
$modversion['blocks'] = [
    [
        'file' => 'tad_new_assignment.php',
        'name' => _MI_TAD_ASSIGNMENT_BNAME1,
        'description' => _MI_TAD_ASSIGNMENT_BDESC1,
        'show_func' => 'tad_new_assignment',
        'template' => 'tad_new_assignment.tpl',
    ],
];

//---偏好設定---//
$modversion['config'] = [
    [
        'name' => 'create_group',
        'title' => '_MI_TAD_ASSIGNMENT_CREATE_GROUP',
        'description' => '_MI_TAD_ASSIGNMENT_CREATE_GROUP_DESC',
        'formtype' => 'group_multi',
        'valuetype' => 'array',
        'default' => [1],
    ],
];
