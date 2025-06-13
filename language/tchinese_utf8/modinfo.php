<?php
xoops_loadLanguage('modinfo_common', 'tadtools');

define('_MI_TAD_ASSIGNMENT_NAME', '作業上傳展示');
define('_MI_TAD_ASSIGNMENT_AUTHOR', 'Tad (tad0616@gmail.com)');
define('_MI_TAD_ASSIGNMENT_CREDITS', 'Michael Beck');
define('_MI_TAD_ASSIGNMENT_DESC', '此模組可以讓管理者（老師）開設需上傳檔案的項目，以便讓使用者（學生）上傳檔案。');
define('_MI_TAD_ASSIGNMENT_ADMENU1', '管理主題');
define('_MI_TAD_ASSIGNMENT_ADMENU2', '新增上傳主題');
define('_MI_TAD_ASSIGNMENT_ADMENU3', '新增檔案格式');
define('_MI_TAD_ASSIGNMENT_TEMPLATE_DESC1', 'index_tpl.html的樣板檔。');
define('_MI_TAD_ASSIGNMENT_TEMPLATE_DESC2', 'show_tpl.html的樣板檔。');
define('_MI_TAD_ASSIGNMENT_BNAME1', '上傳');
define('_MI_TAD_ASSIGNMENT_BDESC1', '列出目前開放上傳的項目');
define('_MI_TAD_ASSIGNMENT_BNAME2', '優秀作品展示區');
define('_MI_TAD_ASSIGNMENT_BDESC2', '會依照成績排序來取前幾名秀出');
define('_MI_TAD_ASSIGNMENT_SMNAME2', '作品展示');
define('_MI_TAD_ASSIGNMENT_SMNAME3', '建立作業');

define('_MI_TAD_ASSIGNMENT_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TAD_ASSIGNMENT_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TAD_ASSIGNMENT_BACK_2_ADMIN', '管理');

//help
define('_MI_TAD_ASSIGNMENT_HELP_OVERVIEW', '概要');

define('_MI_TAD_ASSIGNMENT_CREATE_GROUP', '可建立上傳作業的群組');
define('_MI_TAD_ASSIGNMENT_CREATE_GROUP_DESC', '請選擇可建立上傳作業的群組，群組中的成員登入後即可建立上傳作業。');

define('_MI_TAD_ASSIGNMENT_FORBIDDEN', '禁止上傳的副檔名');
define('_MI_TAD_ASSIGNMENT_FORBIDDEN_DESC', '考量資安因素，禁止上傳的副檔名，請用「;」隔開。');
