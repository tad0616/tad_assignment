<{$toolbar}>
<h2><{$smarty.const._MD_TADASSIGN_SELECT_ASSN}></h2>

<div class="form-group">
  <label class="col-sm-3 control-label">
    <{$smarty.const._MD_TADASSIGN_SELECT_ASSN}>
  </label>
  <div class="col-sm-9">
    <select onChange="window.location.href='show.php?assn='+this.value" class="form-control">
      <option value=''><{$smarty.const._MD_TADASSIGN_SELECT_ASSN}></option>
      <{if $select_assn_all}>
        <{foreach from=$select_assn_all item=data}>
          <option value='<{$data.assn}>' <{if $assn==$data.assn}>selected<{/if}>><{$data.start_date}> <{$data.title}> (<{$data.uid_name}>) </option>
        <{/foreach}>
      <{/if}>
    </select>
  </div>
</div>

<hr>

<{if $now_op=="list_tad_assignment_file" and $show!="1" and !$isAdmin}>
  <div class="jumbotron">
    <{$smarty.const._MD_TADASSIGN_HIDE}>
  </div>
<{/if}>

  <link rel='stylesheet' type='text/css' href='<{$xoops_url}>/modules/tadtools/css/iconize.css'>
  <{$fancybox_code}>

  <div class="row" style="margin-top: 30px;">
    <div class="col-sm-10"><h2><{$title}>
  <{if $assn}><small><a href="index.php?assn=<{$assn}>" class="btn btn-primary"><{$smarty.const._MD_SAVE}></a></small><{/if}></h2></div>
    <div class="col-sm-2"></div>
  </div>
  <{if $file_data}>
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <th><{$smarty.const._MD_TADASSIGN_UP_TIME}></th>
        <th><{$smarty.const._MD_TADASSIGN_FILENAME}></th>
        <th><{$smarty.const._MD_TADASSIGN_DESC}></th>
        <th><{$smarty.const._MD_TADASSIGN_AUTHOR}></th>
        <{if $isAdmin}><th><{$smarty.const._TAD_FUNCTION}></th><{/if}>
      </tr>
      <tbody>
      <{foreach from=$file_data item=all}>
        <tr>
          <td><{$all.up_time}></td>
          <td>
            <{if $now_op=="list_tad_assignment_file" and $show!="1" and !$isAdmin}>
            <{$all.file_name}>
            <{elseif $now_op=="list_tad_assignment_file"}>
          	<a href='<{$smarty.const._TAD_ASSIGNMENT_UPLOAD_URL}><{$all.assn}>/<{$all.asfsn}>.<{$all.sub_name}>'  class="assignment_fancy_<{$assn}>" rel="group" title="<{$all.author}> (<{$all.up_time}>) <{$all.file_name}>"><{$all.file_name}></a>
          	<{/if}>
          </td>
          <td><{$all.desc}></td>
          <td><{$all.author}></td>
          <{if $isAdmin}>
          <td>
            <a href="javascript:delete_func(<{$all.asfsn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
          </td>
          <{/if}>
        </tr>
      <{/foreach}>
      </tbody>
    </table>
  <{/if}>

