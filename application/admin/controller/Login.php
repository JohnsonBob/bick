<?php
namespace app\admin\controller;
class Login extends Base
{
    protected function _initialize()
    {
        //parent::_initialize(); // TODO: Change the autogenerated stub
        //$this->index();
    }

    public function index()
    {
        if($_POST){
            $login = model('login');
            //dump($login->login(input('post.')));
//            dump(input('post.'));
//            die();
            if(!captcha_check(input('post.')['code'])){
                //验证失败
                $this->error('验证码错误，请重新输入！');
            };
            switch ($login->login(input('post.'))){
                case 0:
                    $this->error('用户不存在，请重新输入！');
                    break;
                case 1:
                    $this->error('密码错误，请重新输入！');
                    break;
                case 2:
                    $this->success('登录成功',url('index/index'));
                    break;
                default:
                    $this->error('用户不存在，请重新输入！');
                    break;
            }

            die();
        }
        return $this->fetch();
    }




}
