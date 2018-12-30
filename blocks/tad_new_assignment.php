<?php
//區塊主函式 (列出目前開放上傳的作業項目)
function tad_new_assignment($options)
{
    global $xoopsDB, $xoopsModule;
    $now    = xoops_getUserTimestamp(time());
    $sql    = "select assn,title,uid,start_date from " . $xoopsDB->prefix("tad_assignment") . " where start_date < '$now' and end_date > '$now'";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

    $i     = 0;
    $block = array();
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        $block[$i]['assn']       = $assn;
        $block[$i]['title']      = $title;
        $block[$i]['uid_name']   = $uid_name;
        $block[$i]['start_date'] = date("Y-m-d", $start_date);
        $i++;
    }

    return $block;
}
