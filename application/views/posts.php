<?php foreach($posts as $P): ?>

	<div class="multiple" data-id="<?=$P->ID?>">
		<h1><a href="<?=base_url('/'.$P->CategorySlug.'/'.$P->Slug)?>"><?=$P->Title?></a></h1>
		<div class="content">
			<p><?=$P->Abstract?></p>
			<p class="datetime">Posted in <a href="<?=base_url('/'.$P->CategorySlug)?>"><?=$P->CategoryTitle?></a>
				on <?=date("M. n Y \a\\t H:i", strtotime($P->Creation))?></p>
		</div>
	</div>

<?php endforeach; ?>