<div id="searchForm">
  <!--
  <form action="<?php echo Router::url( '/threads/search/', true) ?>" name="search2" method="post">
  	<dl class="search2">
  		<dt><input type="text" name="data[Thread][search]" value="" placeholder="　アイテム名など" /></dt>
  		<dd><button>Search</button></dd>
  	</dl>
  </form>
-->
  <dl class="search2">
    <?php echo $this->Form->create(); ?>
    <dt>
      <?php echo $this->Form->input('search', array('type' => 'text', 'label' => false, 'div' => false, 'placeholder'=> '　スレッド名・投稿者・スレッド本文を検索')); ?>
    </dt>
    <dd>
      <?php echo $this->Form->end(array('label' => 'Search', 'div' => false)); ?>
    </dd>
  </dl>

</div>
<div id="addThreadForm">
  <input id="addThreadButton" type="button" value="スレッドを立てる" onClick="location.href='<?php echo Router::url( '/threads/add/', true) ?>'">
</div>
<table id="threadList">
  <tbody>
    <tr>
      <th class="no right">No.</th>
      <th class="close center">終了</th>
      <th class="threadName left">&nbsp;&nbsp;スレッド名</th>
      <th class="resCount right">投稿者<br />レス数</th>
      <th class="addTime left">作成日時<br />更新日</th>
    </tr>
    <?php for($i = 0; $i < count($threads); $i++) { ?>
      <?php $thread = $threads[$i]['Thread'] ?>
      <?php $res = $threads[$i]['Re'] ?>
      <!-- 最終更新日を探す -->
      <?php
        $lastModified = $thread['modified'];
        for($j = 0; $j < count($res); $j++) {
          if($lastModified < $res[$j]['modified']) {
            $lastModified = $res[$j]['modified'];
          }
        }
      ?>
      <!-- スレッド一覧表示 -->
      <tr>
        <td class="right"><?php echo $thread['id']; ?></td>
        <?php
          $closeText = "";
          if($thread['close']) {
            $closeText = "-終了-";
          } else {
            
          }
        ?>
        <td class="center"><?php echo $closeText; ?></td>
        <td>
          <a href="<?php echo Router::url( '/threads/view/'.$thread['id'], true) ?>">
            <?php echo $thread['title']; ?></a></td>
        <td class="right"><?php echo $thread['char_name']; ?><br /><?php echo $thread['re_count']; ?></td>
        <td><?php echo $thread['created']; ?><br />
          <?php echo $lastModified; ?></td>
        <td></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div id="pagenation">
  <?php
    //総件数
    echo $this->Paginator->counter(array(
      'format' => 'range',
      'separator' => ' / '
    ));
    echo '<br />';
    // 前ページ
    echo $this->Paginator->prev(
      '< Previous',
      null,
      null,
      array('class' => 'disabled')
    );
    // ページ番号を表示する
    echo $this->Paginator->numbers();
    // 次ページ
    echo $this->Paginator->next(
      'Next >',
      null,
      null,
      array('class' => 'disabled')
    );
  ?>
</div>
