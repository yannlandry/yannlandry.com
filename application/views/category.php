<div class="container">
	<div id="category-posts">
		<?=$postsHTML?>
	</div>

	<div id="category-controls">
		<?php if(empty($postsHTML)): ?>
			This category is empty
		<?php else: ?>
			<img src="<?=base_url('/static/images/loader.gif')?>" alt="Loading..." id="load-more-loader" style="display:none" />
			<a href="" id="load-more-button">Load more</a>
		<?php endif; ?>
	</div>
</div>

<!-- ajax script -->
<script type="text/javascript" src="<?=base_url('/static/javascript/atomic.min.js')?>"></script>
<script type="text/javascript">
var load_more_button = document.getElementById('load-more-button');
if(load_more_button) {
	load_more_button.onclick = function(e) {
		e.preventDefault();

		// display
		this.style.display = 'none';
		document.getElementById('load-more-loader').style.display = 'inline-block';

		// some vars
		var category_posts = document.getElementById('category-posts').getElementsByClassName('multiple');
		var category = '<?=$category?>';
		var before = category_posts[category_posts.length - 1].getAttribute('data-id');

		// prepare query string
		var query_string = '';
		if(category.length)
			query_string+= '/'+category;
		query_string+= '/'+before;

		// gaow
		atomic.get('<?=base_url('/api')?>'+query_string)
		.success(function(data, xhr) {
			if(data.length) {
				category_posts[category_posts.length - 1].insertAdjacentHTML('afterend', data);
				document.getElementById('load-more-button').style.display = 'inline-block';
				document.getElementById('load-more-loader').style.display = 'none';
			}
			else {
				document.getElementById('category-controls').innerHTML = "No more posts to show";
			}
		})
		.error(function(data, xhr) {
			document.getElementById('category-controls').innerHTML = "An error occured; unable to load posts";
		});
	}
}
</script>