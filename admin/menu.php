<?php
$adminmenu = [];
$icon_dir = '2.6' === mb_substr(XOOPS_VERSION, 6, 3) ? '' : 'images/';

$i = 1;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['desc'] = _MI_TAD_ADMIN_HOME_DESC;
$adminmenu[$i]['icon'] = 'images/admin/home.png';

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ASSIGNMENT_ADMENU1;
$adminmenu[$i]['link'] = 'admin/main.php';
$adminmenu[$i]['desc'] = _MI_TAD_ASSIGNMENT_ADMENU1;
$adminmenu[$i]['icon'] = 'images/admin/folder.png';

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ASSIGNMENT_ADMENU3;
$adminmenu[$i]['link'] = 'admin/add_type.php';
$adminmenu[$i]['desc'] = _MI_TAD_ASSIGNMENT_ADMENU3;
$adminmenu[$i]['icon'] = 'images/admin/type.png';

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['desc'] = _MI_TAD_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon'] = 'images/admin/about.png';
