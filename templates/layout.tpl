<!doctype html>
<html lang="cs">
<head>
	<title>{$settings.page_title} | {block name="title"}Default Page Title{/block}</title>
	<meta charset="utf-8">
	<meta name="theme-color" content="{$settings.theme_color}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{$settings.description}"/>
	<link rel="stylesheet" href="style/style.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&subset=greek-ext" rel="stylesheet">
	{block name="header"}

	{/block}
</head>
<body>
	{block name="nav"}{/block}
	{block name="body"}{/block}

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	{block name="footer"}{/block}

	<script>
		$("document").ready(function () {
			var show = 0;
			$(".mobile--btn").click(function () {
				if(show == 0) {
					$("header nav ul").slideDown();
					show = 1;
				}
				else {
					$("header nav ul").slideUp();
					show = 0;
				}
			});
		});

	</script>

</body>
</html>