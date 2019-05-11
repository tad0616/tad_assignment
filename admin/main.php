<?php
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_assignment_adm_main.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
/*-----------function區--------------*/

//列出所有tad_assignment資料
function list_tad_assignment($show_function = 1)
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;
    $sql = 'select * from ' . $xoopsDB->prefix('tad_assignment') . ' order by start_date desc';

    //PageBar(資料數, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    $total = $xoopsDB->getRowsNum($result);

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 10, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    $all_data = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $uid_name = \XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($uid, 0);
        }

        $start_date = date('Y-m-d H:i', xoops_getUserTimestamp($start_date));
        $end_date = date('Y-m-d H:i', xoops_getUserTimestamp($end_date));

        $all_data[$i]['assn'] = $assn;
        $all_data[$i]['title'] = $title;
        $all_data[$i]['passwd'] = $passwd;
        $all_data[$i]['start_date'] = $start_date;
        $all_data[$i]['end_date'] = $end_date;
        $all_data[$i]['uid_name'] = $uid_name;
        $all_data[$i]['show'] = $show;
        $i++;
    }

    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('bar', $bar);
}

//刪除tad_assignment某筆資料資料
function delete_tad_assignment($assn = '')
{
    global $xoopsDB;
    $sql = 'delete from ' . $xoopsDB->prefix('tad_assignment') . " where assn='$assn'";
    $xoopsDB->queryF($sql) or web_error($sql, __FILE__, __LINE__);
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');

switch ($op) {
    //刪除資料
    case 'delete_tad_assignment':
        delete_tad_assignment($assn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
        break;
    //預設動作
    default:
        list_tad_assignment();
        break;
}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';
