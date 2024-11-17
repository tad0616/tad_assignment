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
$type = Request::getString('type');

switch ($op) {
    case 'add_type':
        add_type();
        header("location: {$_SERVER['PHP_SELF']}?t={$_FILES['file']['type']}");
        exit;

    case 'del_type':
        del_type($type);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        add_type_form();
        $op = 'add_type_form';
        break;
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
$xoopsTpl->assign('tad_assignment_adm', $tad_assignment_adm);
$xoopsTpl->assign('now_op', $op);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

function add_type_form()
{
    global $xoopsDB, $xoopsTpl;

    $all = [];
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment_types') . '` ORDER BY `type`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    while (list($type) = $xoopsDB->fetchRow($result)) {

        $all[$i]['type'] = (\Xmf\Request::hasVar('t') && $_GET['t'] == $type) ? "<b style='color:red;'>$type</b>" : $type;
        $i++;

    }
    $xoopsTpl->assign('all', $all);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_type_func', "add_type.php?op=del_type&type=", 'ftype');
}

function add_type()
{
    global $xoopsDB;
    $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_assignment_types') . '` (`type`) VALUES (?)';
    Utility::query($sql, 's', [$_FILES['file']['type']]) or Utility::web_error($sql, __FILE__, __LINE__);

    mk_type();
}

function del_type($type = '')
{
    global $xoopsDB;
    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_assignment_types') . '` WHERE `type`=?';
    Utility::query($sql, 's', [$type]) or Utility::web_error($sql, __FILE__, __LINE__);

    mk_type();
}

function mk_type()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_assignment_types') . '` ORDER BY `type`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($type) = $xoopsDB->fetchRow($result)) {
        $all[] = "\"$type\"";
    }

    $txt = "<?php\n\$all_types=array(" . implode(",\n", $all) . ");\n?>";

    $fp = fopen(XOOPS_ROOT_PATH . '/uploads/tad_assignment/allow_types.php', 'wb');
    fwrite($fp, $txt);
    fclose($fp);
}
