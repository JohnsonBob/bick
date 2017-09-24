<?php

namespace app\admin\model;
use think\Model;

class Admin extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    /**
     *  获取所有管理员并分页展示
     */
    public  function getAdmin(){
        return $this->paginate(5);
    }

    /**
     *  添加管理员到数据库
     */
    public  function addAdmin($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        if($data['password']){
            $data['password'] = md5($data['password']);
            if($this->save($data)){
                return true;
            }
        }
        return false;
    }

    /**
     * 修改管理员信息
     * @param $date
     */
    public function editAdmin($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        if($data['password']){
            $data['password'] = md5($data['password']);
            $res = $this->save([
                'name'  => $data['name'],
                'password' => $data['password']
            ],['id' => $data['id']]);
            if($res){
                return true;
            }
        }
        return false;
    }


}
