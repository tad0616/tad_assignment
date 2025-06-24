<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_assignment_index.tpl';
require_once __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/header.php';
/*-----------執行動作判斷區----------*/
$op   = Request::getString('op');
$assn = Request::getInt('assn');

switch ($op) {
    //新增資料
    case 'insert_tad_assignment_file':
        $assn = insert_tad_assignment_file();
        header("location: show.php?assn=$assn");
        exit;

    //預設動作
    default:
        if (!empty($assn)) {
            tad_assignment_file_form($assn);
            $op = 'tad_assignment_file_form';
        } else {
            list_tad_assignment_menu();
            $op = 'list_tad_assignment_menu';
        }
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
$xoopsTpl->assign('now_op', $op);
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/

//列出所有tad_assignment資料
function list_tad_assignment_menu()
{
    global $xoopsDB, $xoopsTpl;
    $now    = xoops_getUserTimestamp(time());
    $sql    = 'SELECT `assn`, `title`, `uid`, `start_date` FROM `' . $xoopsDB->prefix('tad_assignment') . '` WHERE `start_date` < ? AND `end_date` > ? ORDER BY `start_date` DESC';
    $result = Utility::query($sql, 'ss', [$now, $now]) or Utility::web_error($sql, __FILE__, __LINE__);

    $i    = 0;
    $data = [];
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = \XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($uid, 0);
        }

        $data[$i]['assn']       = $assn;
        $data[$i]['title']      = $title;
        $data[$i]['uid_name']   = $uid_name;
        $data[$i]['start_date'] = date('Y-m-d H:i', xoops_getUserTimestamp($start_date));
        $i++;
    }

    $xoopsTpl->assign('all', $data);
}

//tad_assignment_file編輯表單
function tad_assignment_file_form($assn = '')
{
    global $xoopsTpl;

    $DBV = get_tad_assignment($assn);
    foreach ($DBV as $k => $v) {
        $$k = $v;
        $xoopsTpl->assign($k, $v);
    }

    $xoopsTpl->assign('note', nl2br($note));
    $FormValidator = new FormValidator("#myForm", false);
    $FormValidator->render('topLeft');
}

//新增資料到tad_assignment_file中
function insert_tad_assignment_file()
{
    global $xoopsDB, $xoopsUser;
    if (empty($_FILES['file']['name'])) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_TAD_ASSIGNMENT_NEED_FILE);
    }
    $assn       = (int) $_POST['assn'];
    $assignment = get_tad_assignment($assn);

    if ($_POST['passwd'] != $assignment['passwd']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_ASSIGNMENT_WRONG_PASSWD);
    }
    $now    = date('Y-m-d H:i:s');
    $email  = $xoopsUser ? $xoopsUser->email() : $_POST['email'];
    $email  = $email ? $email : '';
    $author = $xoopsUser ? $xoopsUser->name() : $_POST['author'];

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_assignment_file') . '` (`assn`, `my_passwd`, `show_name`, `desc`, `author`, `email`, `score`, `comment`, `up_time`) VALUES (?, ?, ?, ?, ?, ?, 0, "", ?)';
    Utility::query($sql, 'issssss', [$assn, '', $author, $_POST['desc'], $author, $email, $now]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $asfsn = $xoopsDB->getInsertId();

    upload_file($asfsn, $assn);

    return $assn;
}

//上傳檔案
function upload_file($asfsn = '', $assn = '')
{
    global $xoopsDB, $xoopsModuleConfig;
    // 1.先做黑名單檢查
    $origName = $_FILES['file']['name'] ?? '';
    $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    // 可依需求加更多的副檔名
    $forbidden_ext = $xoopsModuleConfig['forbidden'] ? explode(';', $xoopsModuleConfig['forbidden']) : ['php', 'php3', 'php4', 'php5', 'phtml', 'js', 'sh'];
    if (in_array($ext, $forbidden_ext)) {
        // 刪除黑名單上傳紀錄
        $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_assignment_file') . '`
                WHERE `asfsn` = ?';
        Utility::query($sql, 'i', [$asfsn]) or Utility::web_error($sql, __FILE__, __LINE__);

        // alert 並回上一頁
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MD_TAD_ASSIGNMENT_FORBIDDEN, $ext));
    }

    // 2. 再載入上傳處理元件
    require_once XOOPS_ROOT_PATH . '/modules/tadtools/upload/class.upload.php';
    set_time_limit(0);
    ini_set('memory_limit', '220M');
    $handle = new \Verot\Upload\Upload($_FILES['file'], 'zh_TW');
    if ($handle->uploaded) {
        $handle->file_safe_name     = false;
        $handle->mime_check         = false;
        $ext                        = pathinfo($handle->file_src_name, PATHINFO_EXTENSION); // 取得原始副檔名
        $handle->file_new_name_ext  = $ext; // 自動保留副檔名
        $handle->auto_create_dir    = true;
        $handle->file_new_name_body = (int) $asfsn;
        $handle->process(_TAD_ASSIGNMENT_UPLOAD_DIR . "{$assn}/");
        $now = date('Y-m-d H:i:s');
        if ($handle->processed) {
            $handle->clean();
            $sql = 'UPDATE `' . $xoopsDB->prefix('tad_assignment_file') . '` SET `file_name`=?, `file_size`=?, `file_type`=?, `up_time`=? WHERE `asfsn`=?';
            Utility::query($sql, 'sissi', [$_FILES['file']['name'], $_FILES['file']['size'], $_FILES['file']['type'], $now, $asfsn]) or Utility::web_error($sql, __FILE__, __LINE__);

        } else {
            $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_assignment_file') . '`
                      WHERE `asfsn`=?';
            Utility::query($sql, 'i', [$asfsn]) or Utility::web_error($sql, __FILE__, __LINE__);

            redirect_header($_SERVER['PHP_SELF'], 3, 'Error:' . $handle->error);
        }
    }
}
