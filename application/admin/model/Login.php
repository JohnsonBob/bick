<?php

namespace app\admin\model;
use think\Model;

class Login extends Model
{
    protected $table = 'bk_admin';
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    /**
     * 登录
     * @param $data
     */
    public function login($data){
        // 0代表用户名不存在 1代表密码错误 2代表验证成功
        if (empty($data || !is_array())){
            return 0;
        }
        $res =  $this->where('name', $data['name'])->find();
        if($res){
            if(md5($data['password'])==$res['password']){
                session('name',$res['name']);
                session('id',$res['id']);
                return 2;
            }
            else{
                return 1;
            }
        }else{
            return 0;
        }
    }


}
