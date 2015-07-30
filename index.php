<?php
require_once 'autoload.php';
require_once 'qiniu.class.php';

$accessKey = 'ntL5AciwhaAa35APXKCSlC4KoUKyN77KNPmbHW0K';
$secretKey = 'x5W3KQikAzHTBYRdezWSMY9XGn0MLR0GQLXRd6X1';

$bucket = 'bucket';
$qiniu=new qiniu($accessKey,$secretKey,$bucket);
var_dump($qiniu->download("http://7xkofd.com1.z0.glb.clouddn.com","FtmX4cN-3AWth9A2A-Mq1JXuLPzh"));
?>