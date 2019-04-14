<?php

use XoopsModules\Tad_assignment\Utility;

function xoops_module_update_tad_assignment(&$module, $old_version)
{
    global $xoopsDB;

    if (!Utility::chk_chk1()) {
        Utility::go_update1();
    }

    if (!Utility::chk_chk2()) {
        Utility::go_update2();
    }

    if (Utility::chk_uid()) {
        Utility::go_update_uid();
    }

    $old_DateTime = XOOPS_ROOT_PATH . '/modules/tad_assignment/class/DateTime';
    if (is_dir($old_DateTime)) {
        Utility::delete_directory($old_DateTime);
    }

    return true;
}
