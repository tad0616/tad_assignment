<?php

use XoopsModules\Tad_assignment\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_assignment(&$module)
{

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_assignment");

    return true;
}

