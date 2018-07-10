<?php
namespace Admin\Controller;
use Admin\Controller;

vendor('Qiniu.autoload');
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;


class IndexController extends BaseController{

    public function index(){

        if($_POST){
            var_dump($_FILES);die;
            $true_name=$_POST['true_name'];

            $filePath=$_FILES['img']['tmp_name'];

            $prefix='video_';
            $name=$prefix.$_FILES['img']['name'];

            $type=$_FILES['img']['type'];
// 需要填写你的 Access Key 和 Secret Key
            $accessKey = C('ACCESSKEY');
            $secretKey = C('SECRETKEY');
// 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
// 要上传的空间
            $bucket = C('BUCKET');
            $domain = C('DOMAINImage');
            $token = $auth->uploadToken($bucket);
// 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new UploadManager();
// 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token,$name,$filePath,null,$type,false);
            if ($err !== null) {
                var_dump($err);die;
            } else {
                $data['url']='http://pba0rjj88.bkt.clouddn.com/'.$name;//图片连接
                $data['name']=$name;
                $data['true_name']=$true_name;

                $res=M('Video')->add($data);
                if($res){
                    $this->success('上传成功',U('index/index'),3);
                    die;
                }

            }
        }



        $this->display();
    }

    public function shangchuan(){

    }

    public function piclist(){
        $accessKey = C('ACCESSKEY');
        $secretKey = C('SECRETKEY');

        $auth = new Auth($accessKey, $secretKey);
        $bucketMgr = new BucketManager($auth);

        $bucket = C('BUCKET');

        $prefix='tp_';
        $marker='';

        $list=$bucketMgr->listFiles($bucket,$prefix,$marker);
        $list=array_filter($list);

        print_r($list);
    }

    public function del(){
        $accessKey = C('ACCESSKEY');
        $secretKey = C('SECRETKEY');
        $bucket = C('BUCKET');
        $key = "head-img.png";
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        print_r($err);die;
        if ($err) {
            print_r($err);
        }
    }


}
