<div class="container-fluid">
  <h2><{$smarty.const._MA_TAD_ASSIGNMENT_ADD_TYPE_TITLE}></h2>

  <form action="add_type.php" method="post" id="myForm" name="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="row my-3">
      <div class="col-auto">
        <div class="input-group">
          <input type="file" name="file" class="form-control">
            <div class="input-group-append input-group-btn">
                <button type="submit" class="btn btn-primary" name="op" value="add_type"><{$smarty.const._TAD_SAVE}></button>
            </div>
        </div>
      </div>
    </div>
  </form>

  <table class="table table-striped table-bordered table-hover">
    <tr><th><{$smarty.const._MA_TAD_ASSIGNMENT_TYPE_LIST}></th></tr>
  <{foreach from=$all item=data}>
    <tr>
        <td>
          <a href="javascript:delete_type_func('<{$data.type}>');" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
          <{$data.type}>
        </td>
    </tr>
  <{/foreach}>
  </table>
</div>