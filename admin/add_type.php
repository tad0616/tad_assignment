<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_assignment_adm_add_type.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/


//
function add_type_form(){
  global $xoopsDB,$xoopsModule,$xoopsTpl;

  $all="";
  $sql = "select * from ".$xoopsDB->prefix("tad_assignment_types")." order by `type`";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3,  mysql_error());
  $i=0;
  while(list($type)=$xoopsDB->fetchRow($result)){
    $all[$i]['type']=($_GET['t']==$type)?"<b style='color:red;'>$type</b>":$type;
    $i++;
  }
  $xoopsTpl->assign('all',$all);
}


//
function add_type(){
  global $xoopsDB;
  $sql = "replace into ".$xoopsDB->prefix("tad_assignment_types")." (`type`) values('{$_FILES['file']['type']}')";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  mk_type();
}


//
function del_type($type=""){
  global $xoopsDB;
  $sql = "delete from ".$xoopsDB->prefix("tad_assignment_types")." where type='{$type}'";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

  mk_type();
}


function mk_type(){
  global $xoopsDB;
  $sql = "select * from ".$xoopsDB->prefix("tad_assignment_types")." order by `type`";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3,  mysql_error());
  while(list($type)=$xoopsDB->fetchRow($result)){
    $all[]="\"$type\"";
  }

  $txt="<?php\n\$all_types=array(".implode(",\n",$all).");\n?>";

  $fp = fopen(XOOPS_ROOT_PATH."/uploads/tad_assignment/allow_types.php", 'w');
  fwrite($fp, $txt);
  fclose($fp);
}
/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "":$_REQUEST['op'];

switch($op){

  //
  case "add_type";
  add_type();
  header("location: {$_SERVER['PHP_SELF']}?t={$_FILES['file']['type']}");
  break;

  case "del_type";
  del_type($_GET['type']);
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  //預設動作
  default:
  add_type_form();
  break;

}


/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>
