<?php
namespace app\common\model;
use think\Model;

/**
 * 班级
 */
Class Klass extends Model{

	private $Teacher;
	/**
	 * 获取对应的教师（辅导员）信息
	 */
	public function getTeacher()
    {
    	if(is_null($this->Teacher)){
    		echo '执行一次<br/>';
	        $teacherId = $this->getData('teacher_id');
	        $this->Teacher = Teacher::get($teacherId);
    	}
    	
       // return $Teacher;
        return $this->Teacher;
    }

    /*public function getTeacherName(){
    	
    	return $this->getTeacher()->getData('name');
    }*/
    /**
     * 返回了一个Teacher对象
     */
    public function Teacher(){
    	// echo '执行一次';
    	// $teacherId = $this->getData('teacher_id');
    	// return Teacher::get($teacherId);
        // thinkphp5内置
        return $this->belongsTo('Teacher'); 
    }

    public function validatePost(){
    	$data = [
			'name' => $this->getData('name'),
			'teacher_id' => $this->getData('teacher_id')
		];

		$validate = validate('Klass');
		if(!$validate->check($data)){
			 //return $this->error('数据添加错误：' . $validate->getError());
			 echo '数据添加错误11：' . $validate->getError();
			// $this->error('数据添加错误：' . $validate->getError());
			 return false;
		}
		return true;
    }
}