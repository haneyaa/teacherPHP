<?php
namespace app\index\controller;
use think\Request;
use app\common\model\Student;
use app\common\model\Klass;

class StudentController extends IndexController
{
    public function index()
    {
        $students = Student::paginate();
        $this->assign('students', $students);
        return $this->fetch();
    }

    public function edit(){
    	$id = Request::instance()->param('id/d');

    	//判断当前记录是否存在
    	if(is_null($Student = Student::get($id))){
    		return $this->error('未找到id为：'.$id.'的记录');
    	}

    	//取出班级列表,以下两句可以在html中用更简洁的方法替代
    	/*$klasses = Klass::all();
    	$this->assign('klasses', $klasses);*/

    	$this->assign('Student', $Student);
    	return $this->fetch();
    }
}