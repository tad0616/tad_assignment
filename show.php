<?php
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
include_once 'header.php';
$xoopsOption['template_main'] = 'tad_assignment_show.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

/*-----------function區--------------*/
//列出所有tad_assignment資料
function list_tad_assignment_menu()
{
    global $xoopsDB, $xoopsModule, $isAdmin, $xoopsTpl;

    // $where=($isAdmin)?"":"where `show`='1'";

    $sql = 'select assn,title,uid,start_date from ' . $xoopsDB->prefix('tad_assignment') . " $where order by start_date desc";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $alldata = [];
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        $alldata[$i]['assn'] = $assn;
        $alldata[$i]['title'] = $title;
        $alldata[$i]['uid_name'] = $uid_name;
        $alldata[$i]['start_date'] = date('Y-m-d H:i', xoops_getUserTimestamp($start_date));
        $i++;
    }

    $xoopsTpl->assign('select_assn_all', $alldata);
}

//列出所有tad_assignment_file資料
function list_tad_assignment_file($assn = '')
{
    global $xoopsDB, $xoopsModule, $isAdmin, $xoopsTpl;

    $DBV = get_tad_assignment($assn);
    foreach ($DBV as $k => $v) {
        $$k = $v;
        $xoopsTpl->assign($k, $v);
    }

    $sql = 'select * from ' . $xoopsDB->prefix('tad_assignment_file') . " where assn='{$assn}' order by `up_time` desc";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $data = [];
    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
            $data[$i][$k] = $v;
        }

        $show_name = (empty($show_name)) ? $author . _MD_TADASSIGN_UPLOAD_FILE : $show_name;
        $filepart = explode('.', $file_name);
        foreach ($filepart as $ff) {
            $sub_name = mb_strtolower($ff);
        }

        $data[$i]['sub_name'] = $sub_name;
        $data[$i]['show_name'] = $show_name;

        $i++;
    }

    $xoopsTpl->assign('title', $title);
    $xoopsTpl->assign('assn', $assn);
    $xoopsTpl->assign('file_data', $data);
    $xoopsTpl->assign('now_op', 'list_tad_assignment_file');
    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php')) {
        redirect_header('index.php', 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php';
    $fancybox = new fancybox(".assignment_fancy_{$assn}");
    $fancybox_code = $fancybox->render(false);
    $xoopsTpl->assign('fancybox_code', $fancybox_code);

    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php')) {
        redirect_header('index.php', 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php';
    $sweet_alert = new sweet_alert();
    $sweet_alert->render('delete_func', "show.php?op=delete_tad_assignment_file&assn={$assn}&asfsn=", 'asfsn');
}

//刪除tad_assignment_file某筆資料資料
function delete_tad_assignment_file($asfsn = '')
{
    global $xoopsDB;

    $sql = 'select * from ' . $xoopsDB->prefix('tad_assignment_file') . " where asfsn='{$asfsn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }
    }

    $filepart = explode('.', $file_name);
    foreach ($filepart as $ff) {
        $sub_name = mb_strtolower($ff);
    }

    unlink(_TAD_ASSIGNMENT_UPLOAD_DIR . "{$assn}/{$asfsn}.{$sub_name}");

    $sql = 'delete from ' . $xoopsDB->prefix('tad_assignment_file') . " where asfsn='$asfsn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');
$asfsn = system_CleanVars($_REQUEST, 'asfsn', 0, 'int');

switch ($op) {
    //刪除資料
    case 'delete_tad_assignment_file':
        delete_tad_assignment_file($asfsn);
        header("location: show.php?assn=$assn");
        exit;
        break;
    default:
        list_tad_assignment_menu();
        if (!empty($assn)) {
            list_tad_assignment_file($assn);
        }
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('isAdmin', $isAdmin);

include_once XOOPS_ROOT_PATH . '/footer.php';
