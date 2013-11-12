<?php
// +------------------------------------------------------------------------+
// | class.upload.xx_XX.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) xxxxxx 200x. All rights reserved.                        |
// | Version       0.25                                                     |
// | Last modified xx/xx/200x                                               |
// | Email         xxx@xxx.xxx                                              |
// | Web           http://www.xxxx.xxx                                      |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify   |
// | it under the terms of the GNU General Public License version 2 as      |
// | published by the Free Software Foundation.                             |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the                          |
// |   Free Software Foundation, Inc., 59 Temple Place, Suite 330,          |
// |   Boston, MA 02111-1307 USA                                            |
// |                                                                        |
// | Please give credit on sites that use class.upload and submit changes   |
// | of the script so other people can use them as well.                    |
// | This script is free to use, don't abuse.                               |
// +------------------------------------------------------------------------+

/**
 * Class upload xxxxxx translation
 *
 * @version   0.25
 * @author    xxxxxxxx (xxx@xxx.xxx)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright xxxxxxxx
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = '檔案錯誤，請重試！';
    $translation['local_file_missing']          = '檔案不存在。';
    $translation['local_file_not_readable']     = '檔案無法讀取。';
    $translation['uploaded_too_big_ini']        = '檔案上傳錯誤 （上傳的檔案超過php.ini中 upload_max_filesize 的上限）';
    $translation['uploaded_too_big_html']       = '檔案上傳錯誤 （上傳的檔案超過表單中 MAX_FILE_SIZE 的上限）';
    $translation['uploaded_partial']            = '檔案上傳錯誤 （檔案上傳不完整）';
    $translation['uploaded_missing']            = '檔案上傳錯誤 （沒有任何檔案被上傳）';
    $translation['uploaded_unknown']            = '檔案上傳錯誤 （原因不明～）';
    $translation['try_again']                   = '檔案上傳錯誤，請重試！';
    $translation['file_too_big']                = '檔案太大。';
    $translation['no_mime']                     = '無法偵測檔案的 MIME 類型';
    $translation['incorrect_file']              = '不正確的檔案類型。';
    $translation['image_too_wide']              = '圖片太寬。';
    $translation['image_too_narrow']            = '圖片太窄。';
    $translation['image_too_high']              = '圖片太高。';
    $translation['image_too_short']             = '圖片太低。';
    $translation['ratio_too_high']              = '圖片比例太高 （圖片太寬）。';
    $translation['ratio_too_low']               = '圖片比例太低 （圖片太高）。';
    $translation['too_many_pixels']             = '圖片太多像素。';
    $translation['not_enough_pixels']           = '圖片像素不足。';
    $translation['file_not_uploaded']           = '檔案沒有上傳，無法繼續進行。';
    $translation['already_exists']              = '%s 已存在，請變更檔名。';
    $translation['temp_file_missing']           = 'No correct temp source file. Can\'t carry on a process.';
    $translation['source_missing']              = 'No correct uploaded source file. Can\'t carry on a process.';
    $translation['destination_dir']             = 'Destination directory can\'t be created. Can\'t carry on a process.';
    $translation['destination_dir_missing']     = 'Destination directory doesn\'t exist. Can\'t carry on a process.';
    $translation['destination_path_not_dir']    = 'Destination path is not a directory. Can\'t carry on a process.';
    $translation['destination_dir_write']       = 'Destination directory can\'t be made writeable. Can\'t carry on a process.';
    $translation['destination_path_write']      = 'Destination path is not a writeable. Can\'t carry on a process.';
    $translation['temp_file']                   = 'Can\'t create the temporary file. Can\'t carry on a process.';
    $translation['source_not_readable']         = 'Source file is not readable. Can\'t carry on a process.';
    $translation['no_create_support']           = 'No create from %s support.';
    $translation['create_error']                = 'Error in creating %s image from source.';
    $translation['source_invalid']              = '無法讀取圖片來源，檢查是否為圖片？';
    $translation['gd_missing']                  = 'GD 似乎無法運作。';
    $translation['watermark_no_create_support'] = '不支援 %s 格式的建立，無法讀取浮水印。';
    $translation['watermark_create_error']      = '不支援 %s 格式的讀取，無法建立浮水印。';
    $translation['watermark_invalid']           = '未知的圖檔格式，無法讀取浮水印。';
    $translation['file_create']                 = '沒有支援建立 %s 。';
    $translation['no_conversion_type']          = '沒有定義轉檔類型。';
    $translation['copy_failed']                 = '複製主機上的檔案失敗！copy() 無法運作。';
    $translation['reading_failed']              = '檔案讀取錯誤。';   
        
?>