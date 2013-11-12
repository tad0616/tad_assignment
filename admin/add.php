<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_assignment_adm_add.html";
include_once "header.php";
include_once "../function.php";
/*-----------function區--------------*/
//tad_assignment編輯表單
function tad_assignment_form($assn=""){
  global $xoopsDB,$xoopsTpl;

  //抓取預設值
  if(!empty($assn)){
    $DBV=get_tad_assignment($assn);
  }else{
    $DBV=array();
  }

  //預設值設定

  $assn=(!isset($DBV['assn']))?"":$DBV['assn'];
  $title=(!isset($DBV['title']))?"":$DBV['title'];
  $passwd=(!isset($DBV['passwd']))?"":$DBV['passwd'];
  $start_date=(!isset($DBV['start_date']))?date("Y-m-d H:i",xoops_getUserTimestamp(time())):date("Y-m-d H:i",xoops_getUserTimestamp($DBV['start_date']));
  $end_date=(!isset($DBV['end_date']))?date("Y-m-d H:i",xoops_getUserTimestamp(time()+86400)):date("Y-m-d H:i",xoops_getUserTimestamp($DBV['end_date']));
  $note=(!isset($DBV['note']))?"":$DBV['note'];
  $uid=(!isset($DBV['uid']))?"":$DBV['uid'];
  $show=(!isset($DBV['show']))?"1":$DBV['show'];


  $start_date_form="<input type='text' value='{$start_date}' size='15' name='start_date' id='start_date' onClick=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm' , startDate:'%y-%M-%d %H:%m}'})\">";


  $end_date_form="<input type='text' value='{$end_date}' size='15' name='end_date' id='end_date' onClick=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm' , startDate:'%y-%M-%d %H:%m}'})\">";


  $op=(empty($assn))?"insert_tad_assignment":"update_tad_assignment";


  $xoopsTpl->assign('assn',$assn);
  $xoopsTpl->assign('title',$title);
  $xoopsTpl->assign('note',$note);
  $xoopsTpl->assign('passwd',$passwd);
  $xoopsTpl->assign('start_date_form',$start_date_form);
  $xoopsTpl->assign('end_date_form',$end_date_form);
  $xoopsTpl->assign('show',$show);
  $xoopsTpl->assign('op',$op);

}

//新增資料到tad_assignment中
function insert_tad_assignment(){
  global $xoopsDB,$xoopsUser;
  $uid=$xoopsUser->getVar('uid');
  $start_date=strtotime($_POST['start_date']);
  $end_date=strtotime($_POST['end_date']);
  $sql = "insert into ".$xoopsDB->prefix("tad_assignment")." (`title`,`passwd`,`start_date`,`end_date`,`note`,`uid`,`show`) values('{$_POST['title']}','{$_POST['passwd']}','{$start_date}','{$end_date}','{$_POST['note']}','{$uid}','{$_POST['show']}')";
  $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  //取得最後新增資料的流水編號
  $assn=$xoopsDB->getInsertId();
  return $assn;
}



//更新tad_assignment某一筆資料
function update_tad_assignment($assn=""){
  global $xoopsDB,$xoopsUser;
  $uid=$xoopsUser->getVar('uid');
  $start_date=strtotime($_POST['start_date']);
  $end_date=strtotime($_POST['end_date']);

  $sql = "update ".$xoopsDB->prefix("tad_assignment")." set  `title` = '{$_POST['title']}', `passwd` = '{$_POST['passwd']}', `start_date` = '{$start_date}', `end_date` = '{$end_date}', `note` = '{$_POST['note']}', `uid` = '{$uid}', `show` = '{$_POST['show']}' where assn='$assn'";
  $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
  return $assn;
}

/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "":$_REQUEST['op'];
$assn = (!isset($_REQUEST['assn']))? "":intval($_REQUEST['assn']);

switch($op){

  //新增資料
  case "insert_tad_assignment":
  insert_tad_assignment();
  header("location: index.php");
  break;

  //輸入表格
  case "tad_assignment_form";
  tad_assignment_form($assn);
  break;

  //刪除資料
  case "delete_tad_assignment";
  delete_tad_assignment($assn);
  header("location: index.php");
  break;


  //更新資料
  case "update_tad_assignment";
  update_tad_assignment($assn);
  header("location: index.php");
  break;


  //預設動作
  default:
  tad_assignment_form($assn);
  break;

}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>
