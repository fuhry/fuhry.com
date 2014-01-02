<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>
		<title>fuhry.com{if $title} &raquo; {$title}{/if}</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="{$baseurl}vendor/fortawesome/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="{$themeurl}/res/fuhry.com.css?13.12.1" />
		
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-1716052-3']);
			_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</head>
	<body class="page">
		<div class="left-panel">
			<ul class="links">
				{internal_link href="" title="Home"}
				{internal_link href="bio" title="Bio"}
				{internal_link href="work" title="Work"}
				{internal_link href="projects" title="Projects"}
				<li class="ext"><a href="http://twitter.com/danfuhry">Twitter</a></li>
				<li class="ext"><a href="http://www.youtube.com/user/danfuhry">YouTube</a></li>
				<li class="ext"><a href="http://www.facebook.com/fuhry">Facebook</a></li>
				<li class="ext"><a href="http://gplus.to/fuhry">Google+</a></li>
				<li class="ext"><a href="http://www.reddit.com/u/fuhry">Reddit</a></li>
				<li class="ext"><a href="https://github.com/fuhry">Github</a></li>
				{internal_link href="contact" title="Contact"}
			</ul>
			<div class="copyright">
				{include file="copyright.tpl"}
			</div>
		</div>
		
		<div class="body">
			{$content}
		</div>
	</body>
</html>
