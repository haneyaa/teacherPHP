<?php

namespace app\index\controller;

//use think\Db; //数据库操作类
use think\Controller;
use app\common\model\Teacher;       // 教师模型
	
/**
 * 教师管理
 */
class TeacherController extends Controller{
	
	public function index(){
		//return 'hello teacher';
		
		/*//获取教师表中所有数据
		$teachers =Db::name('teacher')->select();
		
		//查看获取的数据
		var_dump($teachers[0]['name']);
		
		 // 用下面的语句，也可以直接返回给用户
        echo $teachers[0]['name'];
        
        // 查看获取的数据
        return $teachers[0]['name'];*/
		
		/*$Teacher = new Teacher;
		$teachers = $Teacher->select();
		$teacher = $teachers[0];
		
		var_dump($teacher->getData('name'));
		echo $teacher->getData('name');
		return $teacher->getData('name');*/
		
		//dump($teacher);
		
		//echo 'hello teacher';
		
		/*$JiaoShiBiao = new Teacher;
		$Suoyoujiaoshi = $JiaoShiBiao->select();
		$JiaoshiZhangsan = $Suoyoujiaoshi[0];
		//var_dump($JiaoShiBiao);
		echo '教师姓名：'.$JiaoshiZhangsan->getData('name').'<br/>';
		return '重复一遍，教师姓名：'.$JiaoshiZhangsan->getData('name');*/
		
		/*// $Teacher 首写字母大写，说明它是一个对象，更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
		$Teacher = new Teacher;
		
		// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
		$teachers = $Teacher->select();
		
		// 获取第0个数据
		$teacher = $teachers[0];
		// 调用上述对象的getData()方法
		var_dump($teacher->getData('name'));
		echo $teacher->getData('name');
		return $teacher->getData('name');*/
		
		$Teacher = new Teacher;
		$teachers = $Teacher->select();
		
		//像V层传数据
		$this->assign('teachers',$teachers);
		
		//取回打包后的数据
		$htmls = $this->fetch();
		
		//将数据返回给用户
		return $htmls;
	}

}
