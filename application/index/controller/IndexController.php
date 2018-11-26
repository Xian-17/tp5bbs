<?php
namespace app\index\controller;

use app\index\model\PostModel;
use app\index\model\UserModel;
use think\App;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class IndexController extends Controller
{
    // 实例化request
    protected $request = null;
    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
    }

    public function index()
    {
        /*用于测试$user是否能传值至index.html页面
         * $user = [
            'id' => 1,
            'username' => 'zhangsan'
        ];
        session('user',$user);
        */
        return $this->fetch();
    }

    //登录的业务逻辑
    public function login()
    {
        $username = $this->request->post('username');
        $userpwd = $this->request->post('userpwa');
        if($username !=='' && $userpwd !== ''){
            $user = UserModel::where('username',$username)->field('id,userpwd,usersalt')->find();
            $upwd = md5($userpwd.$user['usersalt']);
            if($upwd == $user["userpwd"]){
                $user = [
                    "id"=>$user["id"],
                    "username"=>$username
                ];
                session("user",$user);//已保存user便于使用username和uid.
                return $this->fetch('post');//登录成功后跳转
            }
        }else{
            return $this->fetch('index');
        }
    }

    //退出的业务逻辑
    public function quit()
    {
        session(null);
        return $this->fetch('index');
    }

    // 转至注册页面
    public function register()
    {
        return $this->fetch('register');
    }

    //注册业务逻辑
    public function registerForm()
    {
        $username = $this->request->post('username');//从注册页面获取username/userpwd/cfmpwd进行判断
        $userpwd = $this->request->post('userpwd');
        $usercfmpwd = $this->request->post('cfmpwd');
        if($username !== '' && $userpwd == $usercfmpwd){
            //数据库的动态查询方法，根据username字段查询用户。
            //若用户存在，则以数组形式返回用户信息，否则返回null。
            $user = UserModel::getByusername($username);
            if($user == null){
                $count = '';
                for($i = 0;$i < 5;$i++){
                    $cot = mt_rand(0,9);//从0-9之间产生一个随机数
                    $count .= $cot; //数字和字符串的拼接，js是+=，php是.=
                }
                $enuserpwd = md5($userpwd.$count);
                $user = [
                    'username' => $username,
                    'userpwd' => $enuserpwd,
                    'usersalt' => $count
                ];
                Db::name('login')
                    ->data($user)
                    ->insert();
                echo "<script>alert('注册成功')</script>";
                return $this->fetch('login');
            }else{
                echo "<script>alert('用户已存在或密码不正确')</script>";
                return $this->fetch('register');
            }
        }else{
            echo "<script>alert('用户已存在或密码不正确')</script>";
            return $this->fetch('register');
        }
    }

    //转至发表帖子页面
    public function post()
    {
        return $this->fetch('post');
    }

    //发表帖子业务逻辑
    public function postForm()
    {
        $ptitle = $this->request->post('ptitle');
        $pcontent = $this->request->post('pcontent');
        if($ptitle !== '' && $pcontent !== ''){
            $sessionuser = session('user');
            $username = $sessionuser['username'];
            $user = UserModel::where('username',$username)->field('id')->find();
            $userpost = [
                'uid' => $user['id'],
                'ptitle' => $ptitle,
                'pcontent' => $pcontent
            ];
            Db::name('post')
                ->data($userpost)
                ->insert();
            return $this->success('帖子发表成功','/scan');
        }else{
            echo "<script>alert('不能为空')</script>";
            return $this->fetch('post');
        }
    }

    //浏览帖子页面业务逻辑
    public function scan()
    {
        //获取post表里的所有帖子信息。
        $list = PostModel::field('*')->order('id','desc')->paginate(5);
        $page = $list->render();

        //把数据传至浏览页面
       return $this->fetch('scan',['list'=>$list,'page'=>$page]);
    }

    //删除帖子逻辑
    public function delete()
    {
        //接收从scan页面传过来需要删除的帖子的id
        $delId = $_GET['id'];
        //找到需要删除的帖子信息并删除
        PostModel::where('id','=',$delId)->delete();
        return $this->success('帖子删除成功','/scan');
    }

    //修改帖子页面
    public function alter(){
        //接收从scan页面传过来需要修改的帖子的id
        $alterId = $_GET['id'];
        //根据id在数据表post内找到title和content
        $alterInfo = PostModel::where('id','=',$alterId)->select();
        foreach($alterInfo as $value){}
        session('alterInfo',$value);
        return $this->fetch('alter');
    }

    //修改帖子业务逻辑
    public function alterForm(){
        //接收从alter页面传过来的title和content
        $ptitle = $this->request->post('ptitle');
        $pcontent = $this->request->post('pcontent');
        //取出session里面的id用于查找对应的title和content便于对其修改
        $idInfo = session('alterInfo')['id'];
        if($ptitle !== '' && $pcontent !== ''){
            //查找与id对应的title和content
            $alterData = PostModel::where('id','=',$idInfo)->find();
            //更新并保存title和content
            $alterData->ptitle = $ptitle;
            $alterData->pcontent = $pcontent;
            $alterData->save();
            return $this->success('帖子修改成功','/scan');
        }else{
            echo "<script>alert('不能为空')</script>";
            return $this->fetch('alter');
        }

    }

    //主页面
    public function mainPage(){
        return $this->fetch('mainPage');
    }

    //主页面逻辑
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( '../uploads');
        var_dump($info);
//        if($info){
//            // 成功上传后 获取上传信息
//            // 输出 jpg
//            echo $info->getExtension();
//            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getSaveName();
//            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
//        }else{
//            // 上传失败获取错误信息
//            echo $file->getError();
//        }
    }
}