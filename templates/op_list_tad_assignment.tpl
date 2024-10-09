
<div class="container-fluid">

  <h2><{$smarty.const._MD_TAD_ASSIGNMENT_ASSN_LIST}></h2>




  <table class="table table-striped table-bordered table-hover">
  <tr>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_ASSN}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_TITLE}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_PASSWD}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_START_DATE}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_END_DATE}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_UID}></th>
    <th><{$smarty.const._MD_TAD_ASSIGNMENT_DISPLAY}></th>
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
            <a href="javascript:delete_tad_assignment_func(<{$as.assn}>);" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
            <a href="../post.php?op=tad_assignment_form&assn=<{$as.assn}>" class="btn btn-sm btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
          </td>
        </tr>
      <{/foreach}>

    </tbody>
  </table>
  <{$bar|default:''}>
</div>