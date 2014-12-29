<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php if(isset($pageTitle)): ?>
		<title><?=$pageTitle?></title>
	<?php endif; ?>

	<link href='http://fonts.googleapis.com/css?family=Ek+Mukta:300,800|Vollkorn:400,400italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=base_url('/static/styles/yannlandry.css')?>" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 760px)" href="<?=base_url('/static/styles/yannlandry760.css')?>" />

</head>


<body>
<!-- START BODY -->

<header>

	<div id="menu-trigger">
		<a href="">Menu</a>
	</div>

	<div id="icon">
		<a href="<?=base_url()?>">
			<img src="<?=base_url('/static/images/website_icon_small.jpg')?>" alt="YL" />
			<span>Yann Landry</span>
		</a>
	</div>

	<nav>
		<ul>
			<li><a href="<?=base_url()?>"
				<?php empty($category) and print(' class="active"');?>>All</a></li>
			<?php foreach($categories as $slug => $title): ?>
				<li><a href="<?=base_url('/'.$slug)?>"
					<?php isset($category) && $category == $slug and print(' class="active"');?>><?=$title?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>

</header>

<script type="text/javascript">
document.getElementById('menu-trigger').getElementsByTagName('a')[0].onclick = function(e) {
	e.preventDefault();

	var header = document.getElementsByTagName('header')[0];

	if(header.className == 'open') {
		header.className = '';
		this.className = '';
	}
	else {
		header.className = 'open';
		this.className = 'active';
	}
};
</script>

<div id="body">