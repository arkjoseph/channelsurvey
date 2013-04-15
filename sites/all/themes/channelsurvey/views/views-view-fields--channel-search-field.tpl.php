<?php foreach ($fields as $id => $field): ?>
  <li class="<?php print $field->class; ?>">
		<?php if($field->content): ?>
				<div class="checked">
					<?php print $field->content; ?>
				</div>
  	<?php endif; ?>
  </li>
<?php endforeach; ?>