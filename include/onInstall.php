<?php

use XoopsModules\Tadtools\Utility;

function xoops_module_install_tad_assignment(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_assignment');

    return true;
}
