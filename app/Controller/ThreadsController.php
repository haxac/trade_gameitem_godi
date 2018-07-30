<?php
class ThreadsController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
	public $components = array('Flash', 'Paginator', 'Security');
	public $uses = array('Thread','Re');

/*
	public $hasMany = array (
		'Re' => array(
			'className' => 'Re',
			'order' => 'Re.id ASC',
		)
	);
*/
	/*
	 * ページネーション設定
	 */
	public $paginate = array(
			'fields' => array('Thread.id', 'Thread.close'
				, 'Thread.title', 'Thread.char_name', 'Thread.re_count'
				, 'Thread.created', 'Thread.modified'),
			'limit' => 20,
			'order' => array(
					'Thread.id' => 'desc'
			)
	);

/*
 * securyty callback
 */
	public function beforeFilter() {
		 $this->Security->blackHoleCallback = 'blackhole';
		 parent::beforeFilter();
 	}

	public function blackhole($type) {
		//$this->Flash->error(__('不正な送信が行われました'));
		//不正な送信のためトップに戻る
		return $this->redirect(array('action' => 'index'));
	}

	/*
	 * スレッド一覧を取得してViewへ返す
	 */
	public function index() {
		//ページネーション
		$this->Paginator->settings = $this->paginate;

		if ($this->request->is('post')) {
			//検索
			$search = $this->request->data('Thread.search');
			try {
				$data = $this->Paginator->paginate(
					'Thread',
					array(
						'or' => array(
							'Thread.title like' => '%'.$search.'%',
							'Thread.body like' => '%'.$search.'%',
							'Thread.char_name like' => '%'.$search.'%'
						)
					)
				);
				$this->set('threads', $data);
			} catch(NotFoundException $e) {
				//ページ範囲外
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			//全件表示
			try {
				$data = $this->Paginator->paginate('Thread');
				$this->set('threads', $data);
			} catch(NotFoundException $e) {
				//ページ範囲外
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	/*
	 * 指定されたスレッドの内容（本文+レス）を取得してViewに返す
	 */
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('指定されたスレッドは存在しません。'));
		}

		$thread = $this->Thread->findById($id);
		$re = $this->Re->findByThreadId($id);
		if(!$thread) {
			throw new NotFoundException(__('指定されたスレッドは存在しません。'));
		}
		$this->set('threads', $thread);
		$this->set('res', $re);
	}

	public function add() {
		if ($this->request->is('post')) {
			//クライアントのIPとIPハッシュ値を準備
			$clientIP = $this->getClientIp();
			$this->request->data['Thread']['ip'] = $clientIP;
			$this->request->data['Thread']['hash'] = $this->getIpHash($clientIP);

			$this->Thread->create();
			if ($this->Thread->save($this->request->data)) {
				$this->Flash->success(__('新規スレッドを追加しました。'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Unable to add your post.'));
		}
	}

	/* ユーザのIPアドレスを返します */
	private function getClientIp() {
		return $this->request->clientIp();
	}
	/* 引数のmd5ハッシュ値を返します */
	private function getIpHash($ip) {
		return Security::hash( $ip, 'md5', true);
	}
}
