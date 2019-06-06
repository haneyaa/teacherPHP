<?php

namespace app\index\controller;

//use think\Db; //数据库操作类
	use app\common\model\Teacher;       // 教师模型
	
/**
 * 教师管理
 */
class Teacher{
	
	public function index(){
		//return 'hello teacher';
		
		//获取教师表中所有数据
		$teachers =Db::name('teacher')->select();
		
		//查看获取的数据
		var_dump($teachers[0]['name']);
		
		 // 用下面的语句，也可以直接返回给用户
        echo $teachers[0]['name'];
        
        // 查看获取的数据
        return $teachers[0]['name'];
	}

}
