<?php
header("Content-type: text/html; charset=utf-8");
require_once 'autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

$accessKey = 'ntL5AciwhaAa35APXKCSlC4KoUKyN77KNPmbHW0K';
$secretKey = 'x5W3KQikAzHTBYRdezWSMY9XGn0MLR0GQLXRd6X1';
$auth = new Auth($accessKey, $secretKey);

$bucket = 'bucket';

// 设置put policy的其他参数, 上传回调
//$opts = array(
//          'callbackUrl' => 'http://www.callback.com/',  
//          'callbackBody' => 'name=$(fname)&hash=$(etag)'
//      );
//$token = $auth->uploadToken($bucket, null, 3600, $opts);

    $token = $auth->uploadToken($bucket);
$uploadMgr = new UploadManager();

list($ret, $err) = $uploadMgr->putFile($token, null, "Hydrangeas.jpg");
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
?>