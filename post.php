<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_assignment_index.tpl';
require_once __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/header.php';

if (!array_intersect($_SESSION['groups'], $xoopsModuleConfig['create_group'])) {
    redirect_header('index.php', 3, _MD_TAD_ASSIGNMENT_NO_PERM);
}
/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$assn = Request::getInt('assn');

switch ($op) {
    //新增資料
    case 'insert_tad_assignment':
        insert_tad_assignment();
        header('location: index.php');
        exit;

    //輸入表格
    case 'tad_assignment_form':
        tad_assignment_form($assn);
        break;

    //刪除資料
    case 'delete_tad_assignment':
        delete_tad_assignment($assn);
        header('location: index.php');
        exit;

    //更新資料
    case 'update_tad_assignment':
        update_tad_assignment($assn);
        header('location: index.php');
        exit;

    //預設動作
    default:
        tad_assignment_form($assn);
        $op = 'tad_assignment_form';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
$xoopsTpl->assign('tad_assignment_adm', $tad_assignment_adm);
$xoopsTpl->assign('now_op', $op);
require_once XOOPS_ROOT_PATH . '/footer.php';
/*-----------function區--------------*/

//tad_assignment編輯表單
function tad_assignment_form($assn = '')
{
    global $xoopsTpl, $xoTheme, $xoopsUser, $tad_assignment_adm;
    //抓取預設值
    $DBV = !empty($assn) ? get_tad_assignment($assn) : [];

    //預設值設定

    $assn = (!isset($DBV['assn'])) ? '' : $DBV['assn'];
    $title = (!isset($DBV['title'])) ? '' : $DBV['title'];
    $passwd = (!isset($DBV['passwd'])) ? '' : $DBV['passwd'];
    $start_date = (!isset($DBV['start_date'])) ? date('Y-m-d H:i', xoops_getUserTimestamp(time())) : date('Y-m-d H:i', xoops_getUserTimestamp($DBV['start_date']));
    $end_date = (!isset($DBV['end_date'])) ? date('Y-m-d H:i', xoops_getUserTimestamp(time() + 86400)) : date('Y-m-d H:i', xoops_getUserTimestamp($DBV['end_date']));
    $note = (!isset($DBV['note'])) ? '' : $DBV['note'];
    $uid = (!isset($DBV['uid'])) ? '' : $DBV['uid'];
    $show = (!isset($DBV['show'])) ? '1' : $DBV['show'];

    $now_uid = $xoopsUser ? $xoopsUser->uid() : 0;
    if ($uid != $now_uid && !$tad_assignment_adm) {
        redirect_header('index.php', 3, _MD_TAD_ASSIGNMENT_NO_PERM);
    }

    $op = (empty($assn)) ? 'insert_tad_assignment' : 'update_tad_assignment';

    $xoopsTpl->assign('assn', $assn);
    $xoopsTpl->assign('title', $title);
    $xoopsTpl->assign('note', $note);
    $xoopsTpl->assign('passwd', $passwd);
    $xoopsTpl->assign('start_date', $start_date);
    $xoopsTpl->assign('end_date', $end_date);
    $xoopsTpl->assign('show', $show);
    $xoopsTpl->assign('op', $op);
    $xoTheme->addScript('modules/tadtools/My97DatePicker/WdatePicker.js');
    // $xoTheme->addStylesheet('modules/tadtools/css/font-awesome/css/font-awesome.css');
    $FormValidator = new FormValidator("#myForm", false);
    $FormValidator->render();
}

//新增資料到tad_assignment中
function insert_tad_assignment()
{
    global $xoopsDB, $xoopsUser;
    $uid = $xoopsUser->uid();
    $start_date = strtotime($_POST['start_date']);
    $end_date = strtotime($_POST['end_date']);
    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_assignment') . '` (`title`, `passwd`, `start_date`, `end_date`, `note`, `uid`, `show`) VALUES (?, ?, ?, ?, ?, ?, ?)';
    Utility::query($sql, 'sssssis', [$_POST['title'], $_POST['passwd'], $start_date, $end_date, $_POST['note'], $uid, $_POST['show']]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $assn = $xoopsDB->getInsertId();

    return $assn;
}

//更新tad_assignment某一筆資料
function update_tad_assignment($assn = '')
{
    global $xoopsDB, $xoopsUser;
    $uid = $xoopsUser->uid();
    $start_date = strtotime($_POST['start_date']);
    $end_date = strtotime($_POST['end_date']);

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_assignment') . '` SET `title` = ?, `passwd` = ?, `start_date` = ?, `end_date` = ?, `note` = ?, `uid` = ?, `show` = ? WHERE `assn` = ?';
    Utility::query($sql, 'sssssisi', [
        $_POST['title'],
        $_POST['passwd'],
        $start_date,
        $end_date,
        $_POST['note'],
        $uid,
        $_POST['show'],
        $assn,
    ]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $assn;
}
