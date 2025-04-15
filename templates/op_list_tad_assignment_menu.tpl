<h2 class="sr-only visually-hidden"><{$smarty.const._MD_TAD_ASSIGNMENT_ASSN_LIST}></h2>

<{if $all|default:false}>
  <div class="form-group row mb-3">
    <label class="col-sm-3 col-form-label text-sm-right text-sm-end control-label">
      <{$smarty.const._MD_TAD_ASSIGNMENT_SELECT_ASSN}>
    </label>
    <div class="col-sm-9">
      <select onChange="window.location.href='index.php?assn='+this.value" class="form-control form-select" title="select assignment">
        <option value=''><{$smarty.const._MD_TAD_ASSIGNMENT_SELECT_ASSN}></option>
        <{foreach from=$all item=data}>
          <option value='<{$data.assn}>' <{if $assn==$data.assn}>selected<{/if}>><{$data.start_date}> <{$data.title}> (<{$data.uid_name}>) </option>
        <{/foreach}>
      </select>
    </div>
  </div>
<{elseif $smarty.session.tad_assignment_adm}>
  <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TAD_ASSIGNMENT_EMPTY}></h2>
  <div class="jumbotron bg-light p-5 rounded-lg m-3">
    <{$smarty.const._MD_TAD_ASSIGNMENT_EMPTY}>
    <a href="post.php" class="btn btn-info"><i class="fa fa-square-plus" aria-hidden="true"></i>  <{$smarty.const._TAD_ADD}></a>
  </div>
<{else}>
  <h2 class="sr-only visually-hidden"><{$smarty.const._MD_TAD_ASSIGNMENT_EMPTY}></h2>
  <div class="jumbotron bg-light p-5 rounded-lg m-3">
    <{$smarty.const._MD_TAD_ASSIGNMENT_EMPTY}>
  </div>
<{/if}>