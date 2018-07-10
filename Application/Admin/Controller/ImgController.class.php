<?php
namespace Admin\Controller;
use Admin\Controller;
vendor('Qiniu.autoload');
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class ImgController extends BaseController
{

    public function index($key="")
    {
        $model = D('Img');
        $where='';
        if($key != ""){
            $where['true_name'] = array('like',"%$key%");
        }
        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $post = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id DESC')->select();
        $this->assign('model', $post);
        $this->assign('page',$show);
        $this->display();     
    }

    public function add()
    {
        if($_POST){
            $true_name=$_POST['true_name'];

            $filePath=$_FILES['img']['tmp_name'];
            $prefix='img_';
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

                $res=M('Img')->add($data);
                if($res){
                    $this->success('上传成功',U('img/index'),2);
                    die;
                }

            }
        }
        $this->display();
    }


    public function delete($id,$name)
    {
        /*var_dump($name);
        var_dump($id);die;*/

        $model = M('Img');
        $result = $model->where("id=".$id)->delete();
        if($result){
            $accessKey = C('ACCESSKEY');
            $secretKey = C('SECRETKEY');
            $bucket = C('BUCKET');
            $key = $name;
            $auth = new Auth($accessKey, $secretKey);
            $config = new \Qiniu\Config();
            $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
            $err = $bucketManager->delete($bucket, $key);
            //print_r($err);die;
            if ($err) {
                print_r($err);
            }else{
                $this->success("删除成功", U('img/index'),2);
                die;
            }
        }else{
            $this->error("删除失败");
        }
    }
}
