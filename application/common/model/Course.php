<?php
namespace app\common\model;

use think\Model;

class Course extends Model{

	public function validatePost(){
    	$data = [
			'name' => $this->getData('name'),
		];

		$validate = validate('Course');
		if(!validate('Course')->check($data)){
			 //return $this->error('数据添加错误：' . $validate->getError());
			 echo '数据添加错误11：' . $validate->getError();
			// $this->error('数据添加错误：' . $validate->getError());
			 return false;
		}
		return true;
    }

    // 有了这个多对多关联的Klasses()，在进行查找操作时，它会自动的对klass表进行操作；在进行数据插入、更新操作时，它又会自动对中间表klass_course进行操作。
    public function Klasses(){
    	//$this->belongsToMany('Klass', config('database.prefix') . 'klass_course');中：Klass关联的类名，config('database.prefix') . 'klass_course' = config('数据表前缀'). '表名'，指定了中间表的名称。
    	return $this->belongsToMany('Klass', Config('database.prefix').'klass_course');
    }

}