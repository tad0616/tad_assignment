<h2><{$smarty.const._MD_TAD_ASSIGNMENT_SELECT_ASSN}></h2>

<div class="alert alert-info">
  <div class="input-group">
      <div class="input-group-prepend input-group-addon">
          <span class="input-group-text"><{$smarty.const._MD_TAD_ASSIGNMENT_SELECT_ASSN}></span>
      </div>
      <select onChange="window.location.href='show.php?assn='+this.value" class="form-control form-select" title="select assignment">
        <option value=''><{$smarty.const._MD_TAD_ASSIGNMENT_SELECT_ASSN}></option>
        <{if $select_assn_all|default:false}>
          <{foreach from=$select_assn_all item=data}>
            <option value='<{$data.assn}>' <{if $assn==$data.assn}>selected<{/if}>><{$data.start_date}> <{$data.title}> (<{$data.uid_name}>) </option>
          <{/foreach}>
        <{/if}>
      </select>
  </div>
</div>


<div style="margin-top: 30px;">
  <{if $title|default:false}>
    <h2 class="d-inline-block">
      <{$title|default:''}>
    </h2>
    <{if $assn|default:false}>
      <a href="index.php?assn=<{$assn|default:''}>" class="btn btn-primary btn-sm"><i class="fa fa-upload" aria-hidden="true"></i> <{$smarty.const._MD_TAD_ASSIGNMENT_SAVE}></a>
        <{if $uid==$now_uid}>
          <a href="post.php?op=tad_assignment_form&assn=<{$assn|default:''}>" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
          <{if !$show}>
          <span class="badge badge-dnager bg-danger"><{$smarty.const._MD_TAD_ASSIGNMENT_HIDE}></span>
          <{/if}>
        <{/if}>
    <{/if}>
  <{/if}>
</div>

<{if !$show && !$tad_assignment_adm|default:false && $assn|default:'' && $uid!=$now_uid}>
  <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TAD_ASSIGNMENT_HIDE}></h2>
  <div class="alert alert-warning">
    <h3><{$smarty.const._MD_TAD_ASSIGNMENT_HIDE}></h3>
  </div>
<{else}>

  <{if $file_data|default:false}>
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <th><{$smarty.const._MD_TAD_ASSIGNMENT_UP_TIME}></th>
        <th><{$smarty.const._MD_TAD_ASSIGNMENT_FILENAME}></th>
        <th><{$smarty.const._MD_TAD_ASSIGNMENT_DESC}></th>
        <th><{$smarty.const._MD_TAD_ASSIGNMENT_AUTHOR}></th>
        <{if $tad_assignment_adm|default:false}><th><{$smarty.const._TAD_FUNCTION}></th><{/if}>
      </tr>
      <tbody>
      <{foreach from=$file_data item=all}>
        <tr>
          <td><{$all.up_time}></td>
          <td>
            <{if $now_op=="tad_assignment_show" and $show!="1" and !$tad_assignment_adm}>
              <{$all.file_name}>
            <{elseif $now_op=="tad_assignment_show"}>
            <a href='<{$smarty.const._TAD_ASSIGNMENT_UPLOAD_URL}><{$all.assn}>/<{$all.asfsn}>.<{$all.sub_name}>'  class="assignment_fancy_<{$assn|default:''}>" rel="group" title="<{$all.author}> (<{$all.up_time}>) <{$all.file_name}>"><{$all.file_name}></a>
            <{/if}>
          </td>
          <td><{$all.desc}></td>
          <td><{$all.author}></td>
          <{if $tad_assignment_adm|default:false}>
          <td>
            <a href="javascript:delete_func(<{$all.asfsn}>);" class="btn btn-sm btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
          </td>
          <{/if}>
        </tr>
      <{/foreach}>
      </tbody>
    </table>
  <{/if}>

<{/if}>
