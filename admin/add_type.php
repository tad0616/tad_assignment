<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_assignment_adm_add_type.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------function區--------------*/

function add_type_form()
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;

    $all = [];
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('tad_assignment_types') . ' ORDER BY `type`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $i = 0;
    while (list($type) = $xoopsDB->fetchRow($result)) {

            $all[$i]['type'] = (\Xmf\Request::hasVar('t') && $_GET['t'] == $type) ? "<b style='color:red;'>$type</b>" : $type;
        $i++;

    }
    $xoopsTpl->assign('all', $all);
}

function add_type()
{
    global $xoopsDB;
    $sql = 'replace into ' . $xoopsDB->prefix('tad_assignment_types') . " (`type`) values('{$_FILES['file']['type']}')";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    mk_type();
}

function del_type($type = '')
{
    global $xoopsDB;
    $sql = 'delete from ' . $xoopsDB->prefix('tad_assignment_types') . " where type='{$type}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    mk_type();
}

function mk_type()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('tad_assignment_types') . ' ORDER BY `type`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($type) = $xoopsDB->fetchRow($result)) {
        $all[] = "\"$type\"";
    }

    $txt = "<?php\n\$all_types=array(" . implode(",\n", $all) . ");\n?>";

    $fp = fopen(XOOPS_ROOT_PATH . '/uploads/tad_assignment/allow_types.php', 'wb');
    fwrite($fp, $txt);
    fclose($fp);
}
/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');
$type = system_CleanVars($_REQUEST, 'type', '', 'string');

switch ($op) {
    case 'add_type':
        add_type();
        header("location: {$_SERVER['PHP_SELF']}?t={$_FILES['file']['type']}");
        exit;
        break;
    case 'del_type':
        del_type($type);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
        break;
    //預設動作
    default:
        add_type_form();
        break;
}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';
