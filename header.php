<?php
require_once '../../mainfile.php';
require_once 'function.php';

//�P�_�O�_��ӼҲզ��޲z�v��
$isAdmin = false;
if ($xoopsUser) {
    $module_id = $xoopsModule->getVar('mid');
    $isAdmin = $xoopsUser->isAdmin($module_id);
}

$interface_menu[_TAD_TO_MOD] = 'index.php';
$interface_menu[_MD_SHOW] = 'show.php';
if ($isAdmin) {
    $interface_menu[_TAD_TO_ADMIN] = 'admin/main.php';
}
