<?php
use XoopsModules\Tadtools\Utility;
xoops_loadLanguage('main', 'tadtools');

define('_TAD_ASSIGNMENT_UPLOAD_DIR', XOOPS_ROOT_PATH . '/uploads/tad_assignment/');
define('_TAD_ASSIGNMENT_UPLOAD_URL', XOOPS_URL . '/uploads/tad_assignment/');

//以流水號取得某筆tad_assignment資料
function get_tad_assignment($assn = '')
{
    global $xoopsDB;
    if (empty($assn)) {
        return;
    }

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment') . '` WHERE `assn`=?';
    $result = Utility::query($sql, 'i', [$assn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);

    return $data;
}
