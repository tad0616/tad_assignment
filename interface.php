<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_assignment_adm'])) {
    $_SESSION['tad_assignment_adm'] = $xoopsUser ? $xoopsUser->isAdmin() : false;
}
//取得目前使用者的群組編號
if (!isset($_SESSION['xoopsUserGroups']) or $_SESSION['xoopsUserGroups'] === []) {
    $_SESSION['xoopsUserGroups'] = $xoopsUser ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];
}

$interface_menu[_MD_TAD_ASSIGNMENT_INDEX] = 'index.php';
$interface_icon[_MD_TAD_ASSIGNMENT_INDEX] = "fa-upload";

$interface_menu[_MD_TAD_ASSIGNMENT_SHOW] = 'show.php';
$interface_icon[_MD_TAD_ASSIGNMENT_SHOW] = "fa-desktop";

if (isset($xoopsModuleConfig) and (is_array($xoopsModuleConfig['create_group']) and is_array($_SESSION['xoopsUserGroups']) and array_intersect($_SESSION['xoopsUserGroups'], $xoopsModuleConfig['create_group'])) or $_SERVER['PHP_SELF'] == '/admin.php') {
    $interface_menu[_MD_TAD_ASSIGNMENT_POST] = 'post.php';
    $interface_icon[_MD_TAD_ASSIGNMENT_POST] = "fa-square-plus";
}
