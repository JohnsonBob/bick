<?php

namespace app\admin\controller;

class Conf extends Base
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
        $conf = model('conf');
        $res = $conf->getConf();
        if($_POST){
//            dump(input('post.'));
//            die();
            $res = $conf->getConf(input('post.'));
        }

        $this->assign('confres',$res);
        return $this->fetch();
    }

    public function add()
    {
        if($_POST){
//            dump($_POST);die();
            $data = input('post.');
            $validate = \think\Loader::validate('Conf');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $conf = model('conf');
            if($conf->addConf($data)){
                $this->success('配置项添加成功',url('lst'));
            }else{
                $this->error('配置项添加失败',url('add'));
            }
            return;
        }
        return $this->fetch();
    }

    public function edit($id)
    {
        if($_POST){
            $data = input('post.');
            $validate = \think\Loader::validate('Conf');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $link = model('conf');
            if($link->editConf($data)){
                $this->success('配置项修改成功',url('lst'));
            }else{

                $this->error('配置项修改失败');
            }
            return;
        }
        $conf = db('conf')->find($id);
        $this->assign('conf',$conf);
        return $this->fetch();
    }

    public function del($id){
        $conf = model('conf');
        if($conf->delConf($id)){
            $this->success('配置项删除成功',url('lst'));
        }else{
            $this->error('配置项删除失败');
        }
    }

    /**
     *配置配置项
     */
    public function conf(){
        $conf = model('conf');
        $res = $conf->order('sort desc')->select();
        if($_POST){
            $data = input('post.');
            $validate = \think\Loader::validate('Conf');
            if($validate->check($data)){
                $this->error($validate->getError());
            }
            if($conf->confSave($data)){
                $this->success('修改配置成功',url('conf'));
            }else{
                $this->error('修改配置成功失败');
            }
        }

        $this->assign('confres',$res);
        return $this->fetch();


    }
}
