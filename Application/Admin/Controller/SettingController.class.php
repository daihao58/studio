<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 字段管理
 */
class SettingController extends BaseController
{

    public function index()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            $old_pwd=$_POST['old_pwd'];
            $new_pwd=$_POST['new_pwd'];
            $q_new_pwd=$_POST['q_new_pwd'];

            if($new_pwd != $q_new_pwd){
                $this->error('两次密码不一致',U('setting/index',2));
                die;
            }else{
                $old_old_pwd=M('Member')->where("username = 'admin'")->getField('password');
                if(md5($old_pwd) != $old_old_pwd){
                    $this->error('旧密码错误',U('setting/index',2));
                }else{
                    $data['password']=md5($new_pwd);
                    $res=M('Member')->where("username = 'admin'")->save($data);
                    if($res){
                        $this->success('修改密码成功',U('setting/index',2));
                        die;
                    }else{
                        $this->error('修改密码失败',U('setting/index',2));
                        die;
                    }
                }
            }

        }
    }



}
