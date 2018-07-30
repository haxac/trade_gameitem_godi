<?php
class ResController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
	public $components = array('Flash', 'Paginator', 'Security');
	public $uses = array('Re');

	public function add() {

		if ($this->request->is('post')) {
			//親スレッド
			$thread_id = $this->request->data['Re']['thread_id'];
			//とりあえずage
			$this->request->data['Re']['age_flag'] = 1;

			//クライアントのIPとIPハッシュ値を準備
			$clientIP = $this->getClientIp();
			$this->request->data['Re']['ip'] = $clientIP;
			$this->request->data['Re']['hash'] = $this->getIpHash($clientIP);

			$this->Re->create();
			if ($this->Re->save($this->request->data)) {
				$this->Flash->success(__('コメントを追加しました。'));
				return $this->redirect(['controller'=>'threads','action'=>'view',$thread_id]);
			}
			$this->Flash->error(__('Unable to add your post.'));
		}
	}

	private function getClientIp() {
		return $this->request->clientIp();
	}
	private function getIpHash($ip) {
		return Security::hash( $ip, 'md5', true);
	}
}
