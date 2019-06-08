<?php
namespace app\common\model;

use think\Model;

/**
 * 学生表
 */
class Student extends Model
{
	//thinkphp5内置日期设置格式
	protected $dateFormat = 'Y年年m月月d日';

	protected $type = [
		'create_time' => 'datetime',
	];

	/**thinkphp自动输出性别函数
	如果有了getSexAttr()函数，那么$student->getData('sex')仍然是返回sex的原始数据。
	如果有了getSexAttr()函数，那么$student->sex返回的是sex字段经过getSexAttr()函数处理后的数据。
	 * @param  [type] $value
	 * @return [type]
	 */
	public function getSexAttr($value)
	{
		$status = array('0' => '男','1' => '女' );
		$sex =$status[$value];
		if(isset($sex)){
			return $sex;
		}else{
			return $status[0];
		}
	}

	/**thinkphp自动获取要显示的创建时间
	 * @param  [type] $value
	 * @return [type]
	 */
	public function getCreateTimeAttr($value){
		return date('Y-m-d', $value);
	}

	/**
	 * 返回了一个Klass对象
	 */
	public function Klass(){
		//thinkphp5内置
		return $this->belongsTo('Klass');
	}

	
}
