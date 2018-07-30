<?php
class Thread extends AppModel {

	public $validate = array(
		'title' => array('rule' => 'notBlank'),
		'char_name' => array('rule' => 'notBlank'),
		'body' => array('rule' => 'notBlank')
	);

	//アソシエーション
	//1つのスレッドは複数のレスを保持
	public $hasMany = array(
		'Re' => array(
			'className' => 'Re',
			//↓テーブルのカラム名がCakeの命名規則に沿っているので外部キーの指定は省略可能
			//'foreignKey' => 'thread_id',
			'order' => array('Re.id' => 'ASC')
		)
	);

	/*
	 * 指定されたIDのスレッドを1件取得します
	 */
	public function findById($id) {
		$sql = "
			select
				Thread.id
				,Thread.title
				,Thread.char_name
				,Thread.created
				,Thread.hash
				,Thread.body
			from
				threads as Thread
			where
				Thread.id = :id
			limit 1
		";

		$params = array(
			'id'=>$id
		);
		$data = $this->query($sql,$params);
		return $data[0];
	}
}
