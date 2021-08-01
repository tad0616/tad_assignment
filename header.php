<?php
require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once __DIR__ . '/function.php';

//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_assignment_adm'])) {
    $_SESSION['tad_assignment_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}
$interface_menu[_TAD_TO_MOD] = 'index.php';
$interface_menu[_MD_SHOW] = 'show.php';
if ($_SESSION['tad_assignment_adm']) {
    $interface_menu[_TAD_TO_ADMIN] = 'admin/main.php';
}
