<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2017/10/19
 * Time: 0:19
 */
namespace app\admin\validate;
use think\Validate;

class Conf extends Validate
{
    protected $rule = [
        'cnname'  =>  'require|unique:conf|max:60',
        'enname' => 'require|unique:conf|max:60',
        'type' => 'require',
    ];

    protected $message =[
        'cnname.require' => '中文名称不能为空',
        'enname.require' => '英文名称不能为空',
        'cnname.unique' => '中文名称不能重复',
        'enname.unique' => '英文名称不能重复',
        'cnname.max' => '中文名称不能大于60个字符',
        'enname.max' => '英文名称不能大于60个字符',
        'type.require' => '配置类型不能为空',
    ];

    protected $scene = [
        'edit' => ['cnname','enname'],
    ];

}