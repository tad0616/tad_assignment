<{$toolbar|default:''}>
<{if $now_op=="list_tad_assignment_menu"}>
  <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TADASSIGN_ASSN_LIST}></h2>

  <{if $all|default:false}>
    <div class="form-group row mb-3">
      <label class="col-sm-3 col-form-label text-sm-right control-label">
        <{$smarty.const._MD_TADASSIGN_SELECT_ASSN}>
      </label>
      <div class="col-sm-9">
        <select onChange="window.location.href='index.php?assn='+this.value" class="form-control" title="select assignment">
          <option value=''><{$smarty.const._MD_TADASSIGN_SELECT_ASSN}></option>
          <{foreach from=$all item=data}>
            <option value='<{$data.assn}>' <{if $assn==$data.assn}>selected<{/if}>><{$data.start_date}> <{$data.title}> (<{$data.uid_name}>) </option>
          <{/foreach}>
        </select>
      </div>
    </div>
  <{elseif $smarty.session.tad_assignment_adm}>
    <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TADASSIGN_EMPTY}></h2>
    <div class="jumbotron bg-light p-5 rounded-lg m-3">
      <{$smarty.const._MD_TADASSIGN_EMPTY}>
      <a href="admin/add.php" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>
  <{else}>
    <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TADASSIGN_EMPTY}></h2>
    <div class="jumbotron bg-light p-5 rounded-lg m-3">
      <{$smarty.const._MD_TADASSIGN_EMPTY}>
    </div>
  <{/if}>
<{elseif $now_op=="tad_assignment_file_form"}>
  <h2><{$title|default:''}></h2>
  <form action="index.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <{if $note|default:false}>
      <div class="alert alert-info">
        <{$note|default:''}>
      </div>
    <{/if}>
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <th><{$smarty.const._MD_TADASSIGN_FILE}></th>
        <td><input name="file" type="file" size=40></td>
      </tr>
      <tr>
        <th><{$smarty.const._MD_TADASSIGN_DESC}></th>
        <td><textarea name="desc" rows=4 class="form-control"></textarea></td>
      </tr>
      <tr>
        <th><{$smarty.const._MD_TADASSIGN_AUTHOR}></th>
        <td><input name="author" type="text"  class="form-control"></td>
      </tr>
      <tr>
        <th><{$smarty.const._MD_TADASSIGN_INPUT_PASSWD}></th>
        <td>
          <input name="passwd" type="password"  class="form-control">
        </td>
      </tr>
    </table>
    <div class="text-center">
        <input type="hidden" name="assn" value="<{$assn|default:''}>">
        <input type="hidden" name="op" value="insert_tad_assignment_file">
        <button type="submit"  class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
  </form>

<{/if}>