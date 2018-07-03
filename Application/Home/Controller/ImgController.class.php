<?php

namespace Home\Controller;

use Think\Controller;
vendor('Qiniu.autoload');
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class ImgController extends Controller{
    public function index(){

        $accessKey = C('ACCESSKEY');
        $secretKey = C('SECRETKEY');

        $auth = new Auth($accessKey, $secretKey);
        $bucketMgr = new BucketManager($auth);

        $bucket = C('BUCKET');

        $prefix='tp_';
        $marker='';

        $list=$bucketMgr->listFiles($bucket,$prefix,$marker);
        $list=array_filter($list);

        $img[0]='http://pba0rjj88.bkt.clouddn.com/'.$list[0]['items'][0]['key'];
//        print_r($list);
        $this->assign('img',$img[0]);

        $this->display();
    }
}
