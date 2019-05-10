<?php

use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_assignment\Update;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
if (!class_exists('XoopsModules\Tad_assignment\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
}
function xoops_module_update_tad_assignment(&$module, $old_version)
{
    global $xoopsDB;

    if (!Update::chk_chk1()) {
        Update::go_update1();
    }

    if (!Update::chk_chk2()) {
        Update::go_update2();
    }

    if (Update::chk_uid()) {
        Update::go_update_uid();
    }

    $old_DateTime = XOOPS_ROOT_PATH . '/modules/tad_assignment/class/DateTime';
    if (is_dir($old_DateTime)) {
        Utility::delete_directory($old_DateTime);
    }

    return true;
}
