<?php
use Xmf\Request;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_assignment_admin.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$assn = Request::getInt('assn');

switch ($op) {
    //刪除資料
    case 'delete_tad_assignment':
        delete_tad_assignment($assn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        list_tad_assignment();
        $op = 'list_tad_assignment';
        break;
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
$xoopsTpl->assign('tad_assignment_adm', $tad_assignment_adm);
$xoopsTpl->assign('now_op', $op);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

//列出所有tad_assignment資料
function list_tad_assignment()
{
    global $xoopsDB, $xoopsTpl;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment') . '` ORDER BY `start_date` DESC';
    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 10, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
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

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_assignment_func', "main.php?op=delete_tad_assignment&assn=", 'assn');
}

//刪除tad_assignment某筆資料資料
function delete_tad_assignment($assn = '')
{
    global $xoopsDB;
    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_assignment') . '` WHERE `assn`=?';
    Utility::query($sql, 'i', [$assn]) or Utility::web_error($sql, __FILE__, __LINE__);

}
