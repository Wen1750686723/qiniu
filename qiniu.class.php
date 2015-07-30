<?php
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class qiniu
{
    public $_accesskey   = null;
    public $_secretKey   =null;
    public $_bucket   =null;
        /**
     * 构造函数
     *
     * @access  public
     * @param   string  $tpl
     * @return  void
     */
    function __construct($accesskey=null,$secretKey=null,$bucket   =null)
    {
        $this->_accesskey=$accesskey;
        $this->_secretKey=$secretKey;
        $this->_bucket=$bucket;
    }
    function gettoken(){
		
    	$auth = new Auth($this->_accessKey, $this->_secretKey);
		$bucket = $this->_bucket;
		$token = $auth->uploadToken($bucket);
		return $token;
    }
    function uploadstring($string){
    	//$string是字符串
       
		$auth = new Auth($this->_accesskey, $this->_secretKey);
		$bucket = $this->_bucket;
		// 设置put policy的其他参数, 上传回调
		//$opts = array(
		//          'callbackUrl' => 'http://www.callback.com/',  
		//          'callbackBody' => 'name=$(fname)&hash=$(etag)'
		//      );
		//$token = $auth->uploadToken($bucket, null, 3600, $opts);

		$token = $auth->uploadToken($bucket);
		$uploadMgr = new UploadManager();

		list($ret, $err) = $uploadMgr->put($token, null, $string);
		echo "\n====> put result: \n";
		if ($err !== null) {
		    return $err;
		} else {
		    return $ret;
		} 
    }
    function uploadfile($file=null){
    	//$file是文件路径

		$auth = new Auth($this->_accesskey, $this->_secretKey);
		$bucket = $this->_bucket;
		// 设置put policy的其他参数, 上传回调
		//$opts = array(
		//          'callbackUrl' => 'http://www.callback.com/',  
		//          'callbackBody' => 'name=$(fname)&hash=$(etag)'
		//      );
		//$token = $auth->uploadToken($bucket, null, 3600, $opts);

		$token = $auth->uploadToken($bucket);
		$uploadMgr = new UploadManager();
		list($ret, $err) = $uploadMgr->putFile($token, null, $file);
		if ($err !== null) {
		    return $err;
		} else {
		    return $ret;
		} 
    }
    function download($resource,$filecode,$tosource=null,filename="file"){

    	//$resource是bucket的网址，$filecode是文件的码，$tosource是要下载的文件夹路径
        $auth = new Auth($this->_accesskey, $this->_secretKey);
        $baseUrl = $resource.'/'.$filecode;
		$authUrl = $auth->privateDownloadUrl($baseUrl);
		$this->download_remote_file_with_curl($authUrl, $tosource.time().$filename);
		return $authUrl;
    }
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
}


?>