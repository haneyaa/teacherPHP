<?php
namespace app\common\model;

use think\Model;

/**
 * 
 */
class KlassCourse extends Model
{

	public function validatePost(){
		$data = [
			//'klass_id' => $this->getData('klass_id'),
		];

		$validate = validate('KlassCourse');
		if(!validate('KlassCourse')->check($data)){
			 //return $this->error('数据添加错误：' . $validate->getError());
			 echo '数据添加错误333：' . $validate->getError();
			// $this->error('数据添加错误：' . $validate->getError());
			 return false;
		}
		return true;
	}
}