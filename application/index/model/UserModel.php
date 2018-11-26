<?php
/**
 * Created by PhpStorm.
 * User: song jia xian
 * Date: 2018-10-16
 * Time: 22:35
 */

namespace app\index\model;

use think\Model;

class UserModel extends Model
{
    protected $name = 'login';
    public function posts()
    {
        /*1:N关联
         * hasMany('关联模型','外键','主键');
        关联模型（必须）：模型名或者模型类名
        外键：关联模型外键，默认的外键名规则是当前模型名+_id
        主键：当前模型主键，一般会自动获取也可以指定传入
        */
        return $this->hasMany('PostModel','uid',"id");
    }
}

?>