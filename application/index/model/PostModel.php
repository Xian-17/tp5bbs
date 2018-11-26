<?php
/**
 * Created by PhpStorm.
 * User: song jia xian
 * Date: 2018-10-17
 * Time: 23:03
 */


namespace app\index\model;

use think\Model;

class PostModel extends Model
{
    protected $name = 'post';
    public function user()
    {
        return $this->belongsTo('UserModel',"uid","id");
    }
}


?>