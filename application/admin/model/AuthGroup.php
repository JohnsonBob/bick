<?php

namespace app\admin\model;

use think\Model;

class AuthGroup extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    /**
     *  获取所有超链接
     */
    public function getLink($data = null)
    {
        if (!empty($data)) {
            foreach ($data as $value) {
                foreach ($value as $value2) {
                    $this->update(['id' => $value2['id'], 'sort' => $value2['sort']]);
                }
            }
        }
        return $this->order('sort')->select();
    }

    /**
     *  添加用户组到数据库
     */
    public function addAuthGroup($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }

        //$data['password'] = md5($data['password']);
        if ($this->allowField(['title', 'desc', 'url'])->save($data)) {
            return true;
        }

        return false;
    }

    /**
     * 修改超链接
     * @param $date
     */
    public function editLink($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $res = $this->save([
            'title' => $data['title'],
            'url' => $data['url'],
            'desc' => $data['desc']
        ], ['id' => $data['id']]);
        if ($res) {
            return true;
        }
        return false;
    }

    /**
     *  删除id为的条目
     */
    public  function del($id){
        if(empty($id)){
            return 0;
        }
        $res = $this->where('id','=',$id)->delete();
        return $res;
    }

}
