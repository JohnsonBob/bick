<?php

namespace app\admin\model;

use think\Model;

class Conf extends Model
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
    public function getConf($data = null)
    {
        if (!empty($data)) {
            foreach ($data as $value) {
                foreach ($value as $value2) {
                    $this->update(['id' => $value2['id'], 'sort' => $value2['sort']]);
                }
            }
        }
        return $this->order('sort desc')->paginate(5);
    }

    /**
     *  添加配置项到数据库
     */
    public function addConf($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        if($data['values']){
            $data['values'] = str_replace('，',',', $data['values']);
        }
        if ($this->allowField(['cnname', 'enname', 'type', 'values', 'sort', 'value'])->save($data)) {
            return true;
        }

        return false;
    }

    /**
     * 修改超链接
     * @param $date
     */
    public function editConf($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $res = $this->isUpdate(true)->save($data);
        if ($res) {
            return true;
        }
        return false;
    }

    /**
     *  删除id为的条目
     */
    public  function delConf($id){
        if(empty($id)){
            return 0;
        }
        $res = $this->where('id','=',$id)->delete();
        return $res;
    }

    /**
     * 保存配置
     * @param $data
     */
    public function confSave($data){
        if (empty($data) || !is_array($data)) {
            return false;
        }
        //处理复选框数据
        $ennameList=array();
        foreach ($data as $ke => $value){
            $ennameList[] =$ke;
        }
        $ennameCheckbox = $this->field('enname')->where('type','4')->select();
        foreach ($ennameCheckbox as $key=>$v){
            if(!in_array($v['enname'],$ennameList)){
                $data[$v['enname']] = '';
            }
        }
        //数据更新
        $sum=0;
        $list =array();
        foreach ($data as $key=>$v){
            $res = $this->where('enname', $key)->update(['value' => $v]);
            $sum = $sum+$res;
        }
//        dump($list);
//        die();
        if ($sum) {
            return true;
        }
        return false;
    }

}
