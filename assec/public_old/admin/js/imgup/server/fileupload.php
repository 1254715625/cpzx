<?php
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

#!! IMPORTANT:
#!! this file is just an example, it doesn't incorporate any security checks and
#!! is not recommended to be used in production environment as it is. Be sure to
#!! revise it and customize to your needs.

date_default_timezone_set('PRC');
// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Support CORS
// header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // finish preflight CORS requests here
}


if ( !empty($_REQUEST[ 'debug' ]) ) {
    $random = rand(0, intval($_REQUEST[ 'debug' ]) );
    if ( $random === 0 ) {
        header("HTTP/1.0 500 Internal Server Error");
        exit;
    }
}

// header("HTTP/1.0 500 Internal Server Error");
// exit;


// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
usleep(5000);

// Settings
// $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";

define("WWWROOT",str_ireplace(str_replace("/","\\",$_SERVER['PHP_SELF']),'',__FILE__)."\\");
$url = ''; //网站所在目录

$data['id'] = $_REQUEST['id'];
$targetDir = WWWROOT.$url.'/upload/upload_tmp/'.date('ymd');
$uploadDir = WWWROOT.$url.'/upload/a/'.date('ymd');

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
    @mkdir($targetDir,0777,true);
}

// Create target dir
if (!file_exists($uploadDir)) {
    @mkdir($uploadDir,0777,true);
}

// Get a file name
$type = strtolower(substr($_REQUEST['name'],strrpos($_REQUEST['name'],'.')+1));
$fileName = date('ymdhis').rand(0,999).'.'.$type;


$md5File = @file('md5list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$md5File = $md5File ? $md5File : array();

if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
    $data['status'] = 0;
    $data['msg'] = '校验失败！';
    die(json_encode($data));
}

$filePath = $targetDir . '/' . $fileName;
$uploadPath = $uploadDir . '/' . $fileName;


// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

// Remove old temp files
if ($cleanupTargetDir) {
    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        $data['status'] = 0;
        $data['msg'] = '打开上传文件夹失败！';
        die(json_encode($data));
    }

    while (($file = readdir($dir)) !== false) {
        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

        // If temp file is current file proceed to the next
        if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
            continue;
        }

        // Remove temp file if it is older than the max age and is not the current file
        if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
            @unlink($tmpfilePath);
        }
    }
    closedir($dir);
}


// Open temp file
if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
    $data['status'] = 0;
    $data['msg'] = '打开副本文件失败，请联系管理员！';
    die(json_encode($data));
}

if (!empty($_FILES)) {
    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        $data['status'] = 0;
        $data['msg'] = '文件上传错误，请联系管理员！';
        die(json_encode($data));
    }

    // Read binary input stream and append it to temp file
    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        $data['status'] = 0;
        $data['msg'] = '副本文件打开失败，请联系管理员！';
        die(json_encode($data));
    }
} else {
    if (!$in = @fopen("php://input", "rb")) {
        $data['status'] = 0;
        $data['msg'] = '文件接收失败，请联系管理员！';
        die(json_encode($data));
    }
}


while ($buff = fread($in, 4096)) {
    fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

$index = 0;
$done = true;
for( $index = 0; $index < $chunks; $index++ ) {
    if ( !file_exists("{$filePath}_{$index}.part") ) {
        $done = false;
        break;
    }
}
if ( $done ) {
    if (!$out = @fopen($uploadPath, "wb")) {
        $data['status'] = 0;
        $data['msg'] = '读取文件内容失败，请联系管理员！';
        die(json_encode($data));
    }

    if ( flock($out, LOCK_EX) ) {
        for( $index = 0; $index < $chunks; $index++ ) {
            if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                break;
            }

            while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
            }

            @fclose($in);
            @unlink("{$filePath}_{$index}.part");
        }

        flock($out, LOCK_UN);
    }
    @fclose($out);
}

// Return Success JSON-RPC response
$data['status'] = 1;
$data['msg'] = str_replace(WWWROOT.$url,'',$uploadPath);
die(json_encode($data));