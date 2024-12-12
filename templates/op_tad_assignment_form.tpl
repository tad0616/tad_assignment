<div class="container-fluid">

  <form action="post.php" method="post" id="myForm" name="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_TITLE}></label>
      <div class="col-sm-8"><input type="text" name="title" value="<{$title|default:''}>" class="form-control validate[required]" placeholder="<{$smarty.const._MD_TAD_ASSIGNMENT_TITLE}>"></div>

    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_PASSWD}></label>
      <div class="col-sm-3"><input type="text" name="passwd" class="form-control validate[required]" value="<{$passwd|default:''}>" placeholder="<{$smarty.const._MD_TAD_ASSIGNMENT_PASSWD}>"></div>
      <div class="col-sm-5"><{$smarty.const._MD_TAD_ASSIGNMENT_PASSWD_DESC}></div>

    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_NOTE}></label>
      <div class="col-sm-8"><textarea name="note"  class="form-control" rows=4 placeholder="<{$smarty.const._MD_TAD_ASSIGNMENT_NOTE}>"><{$note|default:''}></textarea></div>
    </div>

    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_START_DATE}></label>
      <div class="col-sm-3"><input type='text' value='<{$start_date|default:''}>' size='15'  class='form-control' name='start_date' id='start_date' onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm' , startDate:'%y-%M-%d %H:%m}'})"></div>
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_END_DATE}></label>
      <div class="col-sm-3"><input type='text' value='<{$end_date|default:''}>' size='15'  class='form-control' name='end_date' id='end_date' onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm' , startDate:'%y-%M-%d %H:%m}'})"></div>
    </div>


    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label"><{$smarty.const._MD_TAD_ASSIGNMENT_DISPLAY}></label>
      <div class="col-sm-8">
          <div class="form-check-inline radio-inline">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="show" value="1" <{if $show=='1'}>checked<{/if}>>
                  <{$smarty.const._MD_TAD_ASSIGNMENT_DISPLAY_YES}>
              </label>
          </div>
          <div class="form-check-inline radio-inline">
              <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="show" value="0" <{if $show=='0'}>checked<{/if}>>
                  <{$smarty.const._MD_TAD_ASSIGNMENT_DISPLAY_NO}>
              </label>
          </div>
      </div>
    </div>


    <div class="text-center">
      <input type="hidden" name="op" value="<{$op|default:''}>">
      <input type="hidden" name="assn" value="<{$assn|default:''}>">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i>  <{$smarty.const._TAD_SAVE}></button>
    </div>
  </form>

</div>