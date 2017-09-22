<?php

namespace app\admin\controller;

class Admin extends Base
{
   /* public function _initialize(){
        $admin = model('admin');
    }*/
    public function lst()
    {
        return $this->fetch();
    }

    public function add()
    {
        if($_POST){
            //var_dump($_POST);
            $admin = model('admin');
            $res = $admin->save(input('post.'));
           // $res = db('admin')->insert(input('post.'));
            echo $res;
            die();
            if($res){
                $this->success('管理员添加成功',url('lst'));
            }else{

                $this->error('管理员添加失败',url('add'));
            }
            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        return $this->fetch();
    }


}
