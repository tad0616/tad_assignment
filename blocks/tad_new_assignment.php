<?php
use XoopsModules\Tadtools\Utility;
//區塊主函式 (列出目前開放上傳的作業項目)
function tad_new_assignment($options)
{
    global $xoopsDB;
    $now = xoops_getUserTimestamp(time());
    $sql = 'SELECT `assn`, `title`, `uid`, `start_date` FROM `' . $xoopsDB->prefix('tad_assignment') . '` WHERE `start_date` < ? AND `end_date` > ?';
    $result = Utility::query($sql, 'ss', [$now, $now]) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $block = [];
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = \XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($uid, 0);
        }

        $block[$i]['assn'] = $assn;
        $block[$i]['title'] = $title;
        $block[$i]['uid_name'] = $uid_name;
        $block[$i]['start_date'] = date('Y-m-d', $start_date);
        $i++;
    }

    return $block;
}
