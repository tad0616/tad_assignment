<?php
use XoopsModules\Tadtools\Utility;

define('_TAD_ASSIGNMENT_UPLOAD_DIR', XOOPS_ROOT_PATH . '/uploads/tad_assignment/');
define('_TAD_ASSIGNMENT_UPLOAD_URL', XOOPS_URL . '/uploads/tad_assignment/');

//以流水號取得某筆tad_assignment資料
function get_tad_assignment($assn = '')
{
    global $xoopsDB;
    if (empty($assn)) {
        return;
    }

    $sql = 'select * from ' . $xoopsDB->prefix('tad_assignment') . " where assn='$assn'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//轉換成時間戳記
function day2ts($day = '', $sy = '-')
{
    if (empty($day)) {
        $day = date('Y-m-d H:i:s');
    }

    $dt = explode(' ', $day);

    $d = explode($sy, $dt[0]);
    $t = explode(':', $dt[1]);

    $ts = mktime($t['0'], $t['1'], $t['2'], $d['1'], $d['2'], $d['0']);

    return $ts;
}
/********************* 預設函數 *********************/
