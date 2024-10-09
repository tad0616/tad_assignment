<h2><{$title|default:''}></h2>
<form action="index.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
  <{if $note|default:false}>
    <div class="alert alert-info">
      <{$note|default:''}>
    </div>
  <{/if}>

  <div class="form-group row mb-3">
      <label class="col-sm-2 control-label col-form-label text-md-right text-md-end">
        <{$smarty.const._MD_TAD_ASSIGNMENT_FILE}>
      </label>
      <div class="col-sm-10">
          <input name="file" id="file" type="file" class="form-control validate[required]">
      </div>
  </div>

  <div class="form-group row mb-3">
      <label class="col-sm-2 control-label col-form-label text-md-right text-md-end">
        <{$smarty.const._MD_TAD_ASSIGNMENT_DESC}>
      </label>
      <div class="col-sm-10">
          <textarea name="desc" id="desc" rows=4 class="form-control" placeholder="<{$smarty.const._MD_TAD_ASSIGNMENT_DESC}>"></textarea>
      </div>
  </div>

  <div class="form-group row mb-3">
    <label class="col-sm-2 control-label col-form-label text-md-right text-md-end">
      <{$smarty.const._MD_TAD_ASSIGNMENT_AUTHOR}>
    </label>
    <div class="col-sm-10">
        <input name="author" id="author" type="text" class="form-control validate[required]">
    </div>
  </div>

  <div class="form-group row mb-3">
    <label class="col-sm-2 control-label col-form-label text-md-right text-md-end">
      <{$smarty.const._MD_TAD_ASSIGNMENT_INPUT_PASSWD}>
    </label>
    <div class="col-sm-10">
        <input name="passwd" id="passwd" type="password" class="form-control validate[required]">
    </div>
  </div>
  <div class="bar">
      <input type="hidden" name="assn" value="<{$assn|default:''}>">
      <input type="hidden" name="op" value="insert_tad_assignment_file">
      <button type="submit"  class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i>
        <{$smarty.const._TAD_SAVE}></button>
  </div>
</form>