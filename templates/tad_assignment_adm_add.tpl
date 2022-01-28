<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">

  <script type="text/javascript" src="<{$xoops_url}>/modules/tadtools/My97DatePicker/WdatePicker.js"></script>
  <form action="add.php" method="post" id="myForm" name="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_TITLE}></label>
      <div class="col-sm-8"><input type="text" name="title" value="<{$title}>" class="form-control" placeholder="<{$smarty.const._MA_TADASSIGN_TITLE}>"></div>

    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_PASSWD}></label>
      <div class="col-sm-3"><input type="text" name="passwd" class="form-control" value="<{$passwd}>" placeholder="<{$smarty.const._MA_TADASSIGN_PASSWD}>"></div>
      <div class="col-sm-5"><{$smarty.const._MA_TADASSIGN_PASSWD_DESC}></div>

    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_NOTE}></label>
      <div class="col-sm-8"><textarea name="note"  class="form-control" rows=4 placeholder="<{$smarty.const._MA_TADASSIGN_NOTE}>"><{$note}></textarea></div>
    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_START_DATE}></label>
      <div class="col-sm-3"><{$start_date_form}></div>
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_END_DATE}></label>
      <div class="col-sm-3"><{$end_date_form}></div>
    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right control-label"><{$smarty.const._MA_TADASSIGN_SHOW}></label>
      <div class="col-sm-8">
          <div class="form-check-inline radio-inline">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="show" value="1" <{if $show=='1'}>checked<{/if}>>
                  <{$smarty.const._MA_TADASSIGN_SHOW_ASSIGNMENT_YES}>
              </label>
          </div>
          <div class="form-check-inline radio-inline">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="show" value="0" <{if $show=='0'}>checked<{/if}>>
                  <{$smarty.const._MA_TADASSIGN_SHOW_ASSIGNMENT_NO}>
              </label>
          </div>
      </div>
    </div>


    <div class="text-center">
      <input type="hidden" name="op" value="<{$op}>">
      <input type="hidden" name="assn" value="<{$assn}>">
      <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
  </form>

</div>