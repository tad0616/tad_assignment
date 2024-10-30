<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_assignment_adm'])) {
    $_SESSION['tad_assignment_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}
//取得目前使用者的群組編號
if (!isset($_SESSION['groups']) or $_SESSION['groups'] === '') {
    $_SESSION['groups'] = $xoopsUser ? $xoopsUser->getGroups() : [XOOPS_GROUP_ANONYMOUS];
}

$interface_menu[_MD_TAD_ASSIGNMENT_INDEX] = 'index.php';
$interface_icon[_MD_TAD_ASSIGNMENT_INDEX] = "fa-upload";

$interface_menu[_MD_TAD_ASSIGNMENT_SHOW] = 'show.php';
$interface_icon[_MD_TAD_ASSIGNMENT_SHOW] = "fa-desktop";

if (is_array($xoopsModuleConfig['create_group']) and is_array($_SESSION['groups']) and array_intersect($_SESSION['groups'], $xoopsModuleConfig['create_group'])) {
    $interface_menu[_MD_TAD_ASSIGNMENT_POST] = 'post.php';
    $interface_icon[_MD_TAD_ASSIGNMENT_POST] = "fa-plus-square";
}
