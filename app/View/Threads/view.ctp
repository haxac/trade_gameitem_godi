<?php $thread = $threads['Thread']; ?>
<?php $res = $res['Re']; ?>
<div id="thread">
	<h2 id="threadTitle"><?php echo $thread['title']; ?></h2>
	<div id="threadAuther">
		<?php echo $thread['id']; ?>&nbsp;&nbsp;
		投稿者:<?php echo $thread['char_name']; ?>&nbsp;&nbsp;
		<?php echo $thread['created']; ?>&nbsp;&nbsp;
		<?php echo $thread['hash']; ?>
	</div>
	<div id="threadText">
		<p>
			<?php echo nl2br($thread['body']); ?>
		</p>
	</div>
</div>
<?php for($i = 0; $i < count($res); $i++) { ?>
	<div class="res">
		<div class="resTitle">Re:</div>
		<div class="resAuther">
			<?php echo $thread['id']; ?>-<?php echo $res[$i]['id']; ?>&nbsp;&nbsp;
			投稿者:<?php echo $res[$i]['char_name'] ?>&nbsp;&nbsp;
			<?php echo $res[$i]['created'] ?>&nbsp;&nbsp;
			ID:<?php echo $res[$i]['hash'] ?>
		</div>
		<div class="resText">
			<p><?php echo nl2br($res[$i]['body']) ?></p>
		</div>
	</div> <!-- res -->
<?php } ?>
<div id="commentForm">
	このスレッドにコメントする
  <?php
  	echo $this->Form->create('Re', array('url' => '/res/add', 'onsubmit'=>'return confirm("コメントを投稿します。")'));
    echo $this->Form->input('char_name', array('label'=>'キャラクタ名'));
    echo $this->Form->input('body', array('rows' => '15', 'cols' => '80', 'label'=>'本文'));
		echo $this->Form->hidden('thread_id' ,array('value' => $thread['id']));
  	echo $this->Form->end('投稿する');
  ?>
</div>
<div id="pagenation">

</div>
