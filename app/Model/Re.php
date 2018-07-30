<?php
class Re extends AppModel {

	public $validate = array(
		'char_name' => array('rule' => 'notBlank'),
		'body' => array('rule' => 'notBlank')
	);

	public $belongsTo = array(
		'Thread' => array(
			'counterCache' => true
		)
	);

	/*
	 * 指定されたIDのスレッドに対するレスを取得します
	 */
	public function findByThreadId($threadId) {
		$sql = "
			select
				Re.id
				,Re.thread_id
				,Re.char_name
				,Re.created
				,Re.hash
				,Re.body
			from
				res as Re
			where
				Re.thread_id = :thread_id
			order by
				Re.id ASC
		";

		$params = array(
			'thread_id'=>$threadId
		);
		$r = array();
		$data = $this->query($sql,$params);
		for($i=0; $i < count($data); $i++) {
			$r['Re'][] = $data[$i]['Re'];
		}
		return $r;
	}
}
