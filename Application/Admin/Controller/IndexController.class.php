<?php
namespace Admin\Controller;
use Admin\Controller;


require '/Public/php-sdk-7.2.6/autoload.php';
use Qiniu\Auth;


class IndexController extends BaseController{

    public function index(){
        $accessKey = 'Access_Key';
        $secretKey = 'Secret_Key';
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        $this->display();
    }


}
