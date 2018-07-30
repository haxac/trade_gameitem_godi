<div id="commentForm">
  スレッドを立てる
  <?php
  	echo $this->Form->create('Thread', array('onsubmit'=>'return confirm("新しいスレッドを投稿します。")'));
  	echo $this->Form->input('title', array('label'=>'スレッド名', 'size' => '75'));
    echo $this->Form->input('char_name', array('label'=>'キャラクタ名'));
    echo $this->Form->input('body', array('rows' => '15', 'cols' => '80', 'label'=>'本文'));
  	echo $this->Form->end('投稿する');
  ?>
</div>
