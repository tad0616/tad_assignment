<?php
use Xmf\Request;
use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_assignment_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$assn = Request::getInt('assn');
$asfsn = Request::getInt('asfsn');

switch ($op) {
    //刪除資料
    case 'delete_tad_assignment_file':
        delete_tad_assignment_file($asfsn);
        header("location: show.php?assn=$assn");
        exit;

    default:
        list_tad_assignment_menu();
        if (!empty($assn)) {
            list_tad_assignment_file($assn);
        }
        $op = 'tad_assignment_show';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
$xoopsTpl->assign('tad_assignment_adm', $tad_assignment_adm);
$xoopsTpl->assign('now_op', $op);
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/
//列出所有tad_assignment資料
function list_tad_assignment_menu()
{
    global $xoopsDB, $xoopsTpl;

    $sql = 'SELECT `assn`, `title`, `uid`, `start_date` FROM `' . $xoopsDB->prefix('tad_assignment') . '` ORDER BY `start_date` DESC';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $alldata = [];
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = \XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($uid, 0);
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
    global $xoopsDB, $xoopsTpl, $xoTheme, $xoopsUser;
    $now_uid = $xoopsUser ? $xoopsUser->uid() : 0;
    $xoopsTpl->assign('now_uid', $now_uid);
    $DBV = get_tad_assignment($assn);
    foreach ($DBV as $k => $v) {
        $$k = $v;
        $xoopsTpl->assign($k, $v);
    }

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment_file') . '` WHERE `assn`=? ORDER BY `up_time` DESC';
    $result = Utility::query($sql, 'i', [$assn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $data = [];
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        foreach ($all as $k => $v) {
            $$k = $v;
            $data[$i][$k] = $v;
        }

        $show_name = (empty($show_name)) ? $author . _MD_TAD_ASSIGNMENT_UPLOAD_FILE : $show_name;
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

    $FancyBox = new FancyBox(".assignment_fancy_{$assn}");
    $FancyBox->render(false);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_func', "show.php?op=delete_tad_assignment_file&assn={$assn}&asfsn=", 'asfsn');
    $xoTheme->addStylesheet('modules/tadtools/css/iconize.css');
}

//刪除tad_assignment_file某筆資料資料
function delete_tad_assignment_file($asfsn = '')
{
    global $xoopsDB;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment_file') . '` WHERE `asfsn`=?';
    $result = Utility::query($sql, 'i', [$asfsn]) or Utility::web_error($sql, __FILE__, __LINE__);

    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }
    }

    $filepart = explode('.', $file_name);
    foreach ($filepart as $ff) {
        $sub_name = mb_strtolower($ff);
    }

    unlink(_TAD_ASSIGNMENT_UPLOAD_DIR . "{$assn}/{$asfsn}.{$sub_name}");

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_assignment_file') . '` WHERE `asfsn`=?';
    Utility::query($sql, 'i', [$asfsn]) or Utility::web_error($sql, __FILE__, __LINE__);

}
