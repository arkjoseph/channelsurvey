<div class="node <?php print $classes; ?>" id="node-<?php print $node->nid; ?>">
	<div class="node-inner">
		<p>
			<?php // National text; appears for all states
			$node = node_load('17');
			echo $node->body;
			?>
		</p>
		<div class="content">
			<?php print $content; ?>
		</div>
  </div>
</div>