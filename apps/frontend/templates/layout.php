<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="all"/>
	
	<!-- Section Specific -->	
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0 &mdash; Plugins" href="<?php echo url_for('recentfeed', array('format' => 'atom1'), array('absolute' => true)) ?>" />	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 &mdash; Plugins" href="<?php echo url_for('recentfeed', array('format' => 'rss201'), array('absolute' => true)) ?>" />	
	<link rel="alternate" type="text/xml" title="RSS .91 &mdash; Plugins" href="<?php echo url_for('recentfeed', array('format' => 'rss091'), array('absolute' => true)) ?>" />	
	
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>	

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-1122274-8']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script');
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			ga.setAttribute('async', 'true');
			document.documentElement.firstChild.appendChild(ga);
		})();	
	</script>
</head>
<body>
	
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/">MooTools</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><a href="/">Home</a></li>
					<li class="divider-vertical"></li>
					<li><a href="/docs/">Documentation</a></li>
					<li><a href="/learn/">Learn More</a></li>
					<li class="divider-vertical"></li>
					<li><a href="/download/">Download</a></li>
				</ul>
			</div>
			<form class="navbar-search pull-right" action="search/">
				<input type="text" class="search-query span2" placeholder="Search">
			</form>
			<ul class="nav pull-right">
				<li class="active"><a href="/plugins/">Plugins</a></li>
				<li class="divider-vertical"></li>
				<li><a href="/blog/">Blog</a></li>
				<li class="divider-vertical"></li>
				<li><a href="/community/">Community</a></li>
				<li class="divider-vertical"></li>
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span9">
			<?php if ($sf_user->hasFlash('notice')): ?>
				<div class="notice"><?php echo $sf_user->getFlash('notice') ?></div>
			<?php endif; ?>
			<?php echo $sf_content ?>		
		</div>
		<div class="span3">
			<?php include_component('default', 'sidebar') ?>
		</div>
	</div>	
	<br />
	<br />
	<br />
	<br />
	<br />
	<footer>
		<p>
			<a href="/community/developers">MooTools Development Team</a>
			<span class="footerCopy">© 2006 — 2012 <a href="http://mad4milk.net" rel="nofollow">Valerio Proietti</a></span>
		</p>
	</footer>
</div>

</body>
</html>
