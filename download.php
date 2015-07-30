<?php
require_once 'autoload.php';

use Qiniu\Auth;

$accessKey = 'ntL5AciwhaAa35APXKCSlC4KoUKyN77KNPmbHW0K';
$secretKey = 'x5W3KQikAzHTBYRdezWSMY9XGn0MLR0GQLXRd6X1';
$auth = new Auth($accessKey, $secretKey);

$baseUrl = 'http://7xkofd.com1.z0.glb.clouddn.com/FjvQWf2N6wWTlBmSrAqh4OjhUyRg';
$authUrl = $auth->privateDownloadUrl($baseUrl);
function download_remote_file_with_curl($file_url, $save_to)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch,CURLOPT_URL,$file_url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$file_content = curl_exec($ch);
curl_close($ch);

$downloaded_file = fopen($save_to, 'w');
fwrite($downloaded_file, $file_content);
fclose($downloaded_file);

}
download_remote_file_with_curl($authUrl, time().'file.docx')
?>