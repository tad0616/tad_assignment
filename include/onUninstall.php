<?php

use XoopsModules\Tad_assignment\Utility;

function xoops_module_uninstall_tad_assignment(&$module)
{
    global $xoopsDB;

    $date = date("Ymd");

    rename(XOOPS_ROOT_PATH . "/uploads/tad_assignment", XOOPS_ROOT_PATH . "/uploads/tad_assignment_bak_{$date}");

    return true;
}


