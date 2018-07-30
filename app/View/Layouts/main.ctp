<?php $systemName = 'ガディウス交換掲示板'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $systemName ?>:
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->script('jquery-3.0.0.min.js');
		echo $this->Html->script('g.js');
		echo $this->Html->css('g');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-80444754-1', 'auto');
	  ga('send', 'pageview');

	</script>
  <header>
    <div id="header">
      <h1><?php echo $this->Html->link($systemName, Router::url( '/', true)); ?></h1>
    </div>
    <div id="menu">
      <nav>
        <?php echo $this->Html->link("スレッド一覧", Router::url( '/', true)); ?>
        <?php echo $this->Html->link("使い方", Router::url( '/pages/about/', true)); ?>
        <?php echo $this->Html->link("利用規約", Router::url( '/pages/kiyaku/', true)); ?>
				<?php echo $this->Html->link("お問合せ", Router::url( '/threads/view/1', true)); ?>
      </nav>
    </div>
  </header>

	<div id="container">
		<div id="contents">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div><!-- contents -->
    <div id="sidebar">
			<div class='c'>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- godius_sidebar -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-7213763041320887"
				     data-ad-slot="6435266919"
				     data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
		</div><!-- c -->
		<div class='d'>

		</div><!-- d -->
    </div><!-- sidebar -->
	</div><!-- container -->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- godius_foot -->
	<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-7213763041320887"
			 data-ad-slot="1373258912"
			 data-ad-format="auto"></ins>
	<script>
	$(document).ready(function(){(adsbygoogle = window.adsbygoogle || []).push({})});
	</script>
  <footer>
    <div id="footer">
    &copy; 2016 3ketu.com
    <?php
			/* SQL dump
			echo $this->element('sql_dump');
			*/
		?>
    </div>
  </footer>
</body>
</html>
