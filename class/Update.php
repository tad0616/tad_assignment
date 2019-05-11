<?php

use XoopsModules\Tadtools\Utility;

namespace XoopsModules\Tad_assignment;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{
    public static function chk_chk1()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tad_assignment_types');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return false;
        }

        return true;
    }

    public static function go_update1()
    {
        global $xoopsDB;
        $sql = 'CREATE TABLE ' . $xoopsDB->prefix('tad_assignment_types') . ' (
        `type` VARCHAR( 255 ) NOT NULL ,
        PRIMARY KEY ( `type` )
        );';
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'INSERT INTO ' . $xoopsDB->prefix('tad_assignment_types') . " (`type`) VALUES
        ('application/rar'),
        ('application/x-rar-compressed'),
        ('application/arj'),
        ('application/excel'),
        ('application/gnutar'),
        ('application/octet-stream'),
        ('application/pdf'),
        ('application/powerpoint'),
        ('application/postscript'),
        ('application/plain'),
        ('application/rtf'),
        ('application/vocaltec-media-file'),
        ('application/wordperfect'),
        ('application/x-bzip'),
        ('application/x-bzip2'),
        ('application/x-compressed'),
        ('application/x-excel'),
        ('application/x-gzip'),
        ('application/x-latex'),
        ('application/x-midi'),
        ('application/x-msexcel'),
        ('application/x-rtf'),
        ('application/x-sit'),
        ('application/x-stuffit'),
        ('application/x-shockwave-flash'),
        ('application/x-troff-msvideo'),
        ('application/x-zip-compressed'),
        ('application/xml'),
        ('application/zip'),
        ('application/msword'),
        ('application/mspowerpoint'),
        ('application/vnd.ms-excel'),
        ('application/vnd.ms-powerpoint'),
        ('application/vnd.ms-word'),
        ('application/vnd.ms-word.document.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ('application/vnd.ms-word.template.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.wordprocessingml.template'),
        ('application/vnd.ms-powerpoint.template.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.presentationml.template'),
        ('application/vnd.ms-powerpoint.addin.macroEnabled.12'),
        ('application/vnd.ms-powerpoint.slideshow.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.presentationml.slideshow'),
        ('application/vnd.ms-powerpoint.presentation.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.presentationml.presentation'),
        ('application/vnd.ms-excel.addin.macroEnabled.12'),
        ('application/vnd.ms-excel.sheet.binary.macroEnabled.12'),
        ('application/vnd.ms-excel.sheet.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
        ('application/vnd.ms-excel.template.macroEnabled.12'),
        ('application/vnd.openxmlformats-officedocument.spreadsheetml.template'),
        ('audio/*'),
        ('image/*'),
        ('image/png'),
        ('image/jpg'),
        ('image/gif'),
        ('video/*'),
        ('multipart/x-zip'),
        ('multipart/x-gzip'),
        ('text/richtext'),
        ('text/plain'),
        ('text/xml'),
        ('application/vnd.oasis.opendocument.spreadsheet'),
        ('application/x-vnd.oasis.opendocument.spreadsheet')";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        return true;
    }

    //檢查某欄位是否存在
    public static function chk_chk2()
    {
        global $xoopsDB;
        $sql = 'SELECT count(`up_time`) FROM ' . $xoopsDB->prefix('tad_assignment_file');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return false;
        }

        return true;
    }

    //執行更新
    public static function go_update2()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_assignment_file') . ' ADD `up_time` DATETIME';
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        return true;
    }

    //修正uid欄位
    public static function chk_uid()
    {
        global $xoopsDB;
        $sql = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS
  WHERE table_name = '" . $xoopsDB->prefix('tad_assignment') . "' AND COLUMN_NAME = 'uid'";
        $result = $xoopsDB->query($sql);
        list($type) = $xoopsDB->fetchRow($result);
        if ('smallint' === $type) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update_uid()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_assignment') . '` CHANGE `uid` `uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0';
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        return true;
    }

}
