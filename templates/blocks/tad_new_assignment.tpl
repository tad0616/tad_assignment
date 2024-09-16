<{if $block|default:false}>
  <div class="row">
    <select onChange="location.href='<{$xoops_url}>/modules/tad_assignment/show.php?assn='+this.value" class="col-sm-12" title="select assignment">
    <option value=''><{$smarty.const._MB_TADASSIGN_SELECT_ASSN}></option>
    <{foreach from=$block item=as}>
      <option value='<{$as.assn}>'><{$as.start_date}> <{$as.title}> (<{$as.uid_name}>) </option>
    <{/foreach}>
    </select>
  </div>
<{/if}>