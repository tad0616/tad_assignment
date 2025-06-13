<?php
xoops_loadLanguage('modinfo_common', 'tadtools');

define('_MI_TAD_ASSIGNMENT_NAME', 'Tad Assignment');
define('_MI_TAD_ASSIGNMENT_AUTHOR', 'Tad (tad0616@gmail.com)');
define('_MI_TAD_ASSIGNMENT_CREDITS', 'Michael Beck');
define('_MI_TAD_ASSIGNMENT_DESC', 'This module allows administrators (teachers) to upload the file to open the topic in order to allow users (students) to upload files.');
define('_MI_TAD_ASSIGNMENT_ADMENU1', 'Management topic');
define('_MI_TAD_ASSIGNMENT_ADMENU2', 'Upload to new topic');
define('_MI_TAD_ASSIGNMENT_ADMENU3', 'New file format');
define('_MI_TAD_ASSIGNMENT_TEMPLATE_DESC1', 'index_tpl.html template file.');
define('_MI_TAD_ASSIGNMENT_TEMPLATE_DESC2', 'show_tpl.html template file.');
define('_MI_TAD_ASSIGNMENT_BNAME1', 'Upload');
define('_MI_TAD_ASSIGNMENT_BDESC1', 'Lists the currently open uploaded topic');
define('_MI_TAD_ASSIGNMENT_BNAME2', 'Good works display area');
define('_MI_TAD_ASSIGNMENT_BDESC2', 'Will follow the sort to take the top few results to show');
define('_MI_TAD_ASSIGNMENT_SMNAME2', 'Show works');
define('_MI_TAD_ASSIGNMENT_SMNAME3', 'Creating an Upload Job');

define('_MI_TAD_ASSIGNMENT_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TAD_ASSIGNMENT_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_TAD_ASSIGNMENT_BACK_2_ADMIN', 'Back to Administration of ');

//help
define('_MI_TAD_ASSIGNMENT_HELP_OVERVIEW', 'Overview');

define('_MI_TAD_ASSIGNMENT_CREATE_GROUP', 'Create groups for uploading jobs');
define('_MI_TAD_ASSIGNMENT_CREATE_GROUP_DESC', 'Please select the group where you want to create an upload job. Members of the group will be able to create an upload job after logging in.');
define('_MI_TAD_ASSIGNMENT_FORBIDDEN', 'Forbidden filename');
define('_MI_TAD_ASSIGNMENT_FORBIDDEN_DESC', 'For security reasons, please separate the uploaded file name with ";".');
