<?php
require_once XOOPS_ROOT_PATH . '/modules/tadtools/language/' . $xoopsConfig['language'] . '/modinfo_common.php';
define('_MI_TADASSIGN_NAME', '作業上傳展示');
define('_MI_TADASSIGN_AUTHOR', 'Tad (tad0616@gmail.com)');
define('_MI_TADASSIGN_CREDITS', 'Michael Beck');
define('_MI_TADASSIGN_DESC', '此模組可以讓管理者（老師）開設需上傳檔案的項目，以便讓使用者（學生）上傳檔案。');
define('_MI_TADASSIGN_ADMENU1', '管理主題');
define('_MI_TADASSIGN_ADMENU2', '新增上傳主題');
define('_MI_TADASSIGN_ADMENU3', '新增檔案格式');
define('_MI_TADASSIGN_TEMPLATE_DESC1', 'index_tpl.html的樣板檔。');
define('_MI_TADASSIGN_TEMPLATE_DESC2', 'show_tpl.html的樣板檔。');
define('_MI_TADASSIGN_BNAME1', '上傳');
define('_MI_TADASSIGN_BDESC1', '列出目前開放上傳的項目');
define('_MI_TADASSIGN_BNAME2', '優秀作品展示區');
define('_MI_TADASSIGN_BDESC2', '會依照成績排序來取前幾名秀出');
define('_MI_TADASSIGN_SMNAME2', '作品展示');

define('_MI_TADASSIGN_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADASSIGN_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TADASSIGN_BACK_2_ADMIN', '管理');

//help
define('_MI_TADASSIGN_HELP_OVERVIEW', '概要');
