<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>
		<title>fuhry.com{if $title} &raquo; {$title}{/if}</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="{$baseurl}vendor/fortawesome/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="{$themeurl}/res/fuhry.com.css?13.12.1" />
		<link rel="stylesheet" type="text/css" href="{$themeurl}/res/fuhry.com.responsive.css?13.12.1" />
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		
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
	<body class="home">
		<div class="body-wrapper">
			{$content}
		</div>
		<div class="footer">
			<div class="footer-inside">
				{include file="copyright.tpl"}
			</div>
		</div>
	</body>
</html>
