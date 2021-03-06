<?php

namespace app\admin\controller;

class Admin extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /* public function _initialize(){
         $admin = model('admin');
     }*/

    public function lst()
    {
        $admin = model('admin');
        $res = $admin->getAdmin();
//        dump($res) ;
//        die();
        $this->assign('adminres',$res);

        return $this->fetch();
    }

    public function add()
    {
        if($_POST){
            //var_dump($_POST);
            $admin = model('admin');
            if($admin->addAdmin($_POST)){
                $this->success('管理员添加成功',url('lst'));
            }else{

                $this->error('管理员添加失败',url('add'));
            }
            return;
        }
        return $this->fetch();
    }

    public function edit($id)
    {
        if($_POST){
            $admin = model('admin');
            if($admin->editAdmin(input('post.'))){
                $this->success('管理员密码修改成功',url('lst'));
            }else{

                $this->error('管理员密码修改失败',url('edit'));
            }
            return;
        }
        $admin = db('admin')->find($id);
        $this->assign('admin',$admin);
        return $this->fetch();
    }

    public function logout(){
        session(null);
        $this->success('退出系统成功',url('login/index'));
    }


}
