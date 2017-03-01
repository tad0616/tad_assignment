<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "tad_assignment_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";
/*-----------function區--------------*/

//列出所有tad_assignment資料
function list_tad_assignment_menu()
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;
    $now    = xoops_getUserTimestamp(time());
    $sql    = "select assn,title,uid,start_date from " . $xoopsDB->prefix("tad_assignment") . " where start_date < '$now' and end_date > '$now'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $i      = 0;
    $data   = "";
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        $data[$i]['assn']       = $assn;
        $data[$i]['title']      = $title;
        $data[$i]['uid_name']   = $uid_name;
        $data[$i]['start_date'] = date("Y-m-d H:i", xoops_getUserTimestamp($start_date));
        $i++;
    }

    $xoopsTpl->assign('all', $data);
    $xoopsTpl->assign('now_op', 'list_tad_assignment_menu');
}

//tad_assignment_file編輯表單
function tad_assignment_file_form($assn = "")
{
    global $xoopsDB, $xoopsTpl;

    $DBV = get_tad_assignment($assn);
    foreach ($DBV as $k => $v) {
        $$k = $v;
        $xoopsTpl->assign($k, $v);
    }

    $xoopsTpl->assign('note', nl2br($note));
    $xoopsTpl->assign('now_op', 'tad_assignment_file_form');
}

//新增資料到tad_assignment_file中
function insert_tad_assignment_file()
{
    global $xoopsDB;
    if (empty($_FILES['file']['name'])) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_TADASSIGN_NEED_FILE);
    }

    $assignment = get_tad_assignment($_POST['assn']);

    if ($_POST['passwd'] != $assignment['passwd']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_ASSIGNMENT_WRONG_PASSWD);
    }
    $now = date("Y-m-d H:i:s");

    $myts               = MyTextSanitizer::getInstance();
    $_POST['show_name'] = $myts->addSlashes($_POST['show_name']);
    $_POST['desc']      = $myts->addSlashes($_POST['desc']);
    $_POST['author']    = $myts->addSlashes($_POST['author']);
    $_POST['email']     = $myts->addSlashes($_POST['email']);
    $_POST['assn']      = intval($_POST['assn']);

    $sql = "insert into " . $xoopsDB->prefix("tad_assignment_file") . " (`assn` , `my_passwd` , `show_name` , `desc` , `author` , `email` ,`score`,`comment` , `up_time`) values('{$_POST['assn']}','{$_POST['my_passwd']}','{$_POST['show_name']}','{$_POST['desc']}','{$_POST['author']}','{$_POST['email']}' ,0, '', '$now')";
    $xoopsDB->query($sql) or web_error($sql);
    //取得最後新增資料的流水編號
    $asfsn = $xoopsDB->getInsertId();

    upload_file($asfsn, $_POST['assn']);

    return $_POST['assn'];
}

//上傳檔案
function upload_file($asfsn = "", $assn = "")
{
    global $xoopsDB;
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/upload/class.upload.php";
    set_time_limit(0);
    ini_set('memory_limit', '150M');
    $flv_handle = new upload($_FILES['file'], "zh_TW");
    if ($flv_handle->uploaded) {
        //$name=substr($_FILES['file']['name'],0,-4);
        $flv_handle->file_safe_name = false;
        $flv_handle->mime_check     = false;

        $flv_handle->auto_create_dir    = true;
        $flv_handle->file_new_name_body = "{$asfsn}";
        $flv_handle->process(_TAD_ASSIGNMENT_UPLOAD_DIR . "{$assn}/");
        $now = date("Y-m-d H:i:s");
        if ($flv_handle->processed) {
            $flv_handle->clean();
            $sql = "update " . $xoopsDB->prefix("tad_assignment_file") . " set file_name='{$_FILES['file']['name']}',file_size='{$_FILES['file']['size']}' ,file_type='{$_FILES['file']['type']}',`up_time`='$now'  where asfsn='$asfsn'";
            $xoopsDB->queryF($sql) or web_error($sql);
        } else {
            $sql = "delete from " . $xoopsDB->prefix("tad_assignment_file") . " where asfsn='{$asfsn}'";
            $xoopsDB->query($sql) or web_error($sql);
            redirect_header($_SERVER['PHP_SELF'], 3, "Error:" . $flv_handle->error);
        }
    }
}

/*-----------執行動作判斷區----------*/

include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op   = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');

switch ($op) {

    //新增資料
    case "insert_tad_assignment_file":
        $assn = insert_tad_assignment_file();
        header("location: show.php?assn=$assn");
        exit;
        break;

    //預設動作
    default:
        if (!empty($assn)) {
            tad_assignment_file_form($assn);
        } else {
            list_tad_assignment_menu();
        }
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("isAdmin", $isAdmin);

include_once XOOPS_ROOT_PATH . '/footer.php';
