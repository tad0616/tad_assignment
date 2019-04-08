<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">

  <h2><{$smarty.const._MA_TADASSIGN_ASSN_LIST}></h2>

  <script>
  function delete_tad_assignment_func(assn){
    var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
    if (!sure)  return;
    location.href="main.php?op=delete_tad_assignment&assn=" + assn;
  }
  </script>

  <table class="table table-striped table-bordered table-hover">
  <tr>
    <th><{$smarty.const._MA_TADASSIGN_ASSN}></th>
    <th><{$smarty.const._MA_TADASSIGN_TITLE}></th>
    <th><{$smarty.const._MA_TADASSIGN_PASSWD}></th>
    <th><{$smarty.const._MA_TADASSIGN_START_DATE}></th>
    <th><{$smarty.const._MA_TADASSIGN_END_DATE}></th>
    <th><{$smarty.const._MA_TADASSIGN_UID}></th>
    <th><{$smarty.const._MA_TADASSIGN_SHOW}></th>
    <th><{$smarty.const._TAD_FUNCTION}></th>
  </tr>
    <tbody>

      <{foreach from=$all_data item=as}>
        <tr>
          <td><{$as.assn}></td>
          <td><a href="../show.php?assn=<{$as.assn}>"><{$as.title}></a></td>
          <td><{$as.passwd}></td>
          <td><{$as.start_date}></td>
          <td><{$as.end_date}></td>
          <td><{$as.uid_name}></td>
          <td><{if $as.show=='1'}><{$smarty.const._YES}><{else}><{$smarty.const._NO}><{/if}></td>
          <td>
            <a href="javascript:delete_tad_assignment_func(<{$as.assn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
            <a href="add.php?op=tad_assignment_form&assn=<{$as.assn}>" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
          </td>
        </tr>
      <{/foreach}>

    </tbody>
  </table>
  <{$bar}>
</div>