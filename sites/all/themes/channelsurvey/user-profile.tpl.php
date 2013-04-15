<?php if($user->uid) { ?>
<div id="content-admin-links">
	<div id="view-live"><a href="/programming">View live site</a></div>
	<h3>National Text<a href="/node/17/edit">Edit</a></h3>
	<?php
 	$query = 'SELECT node.nid AS nid, node.status AS node_status, node.title AS node_title, node.uid AS node_uid, node.type AS node_type, node_revisions.format AS node_revisions_format FROM node node  LEFT JOIN node_revisions node_revisions ON node.vid = node_revisions.vid WHERE node.type in ("uverse_programming_changes_legal") ORDER BY node_title ASC';

	$result = db_query($query);

	while($row = db_fetch_object($result)) { ?>
		<h3><?echo $row->node_title;?><?php echo ($row->node_status == 0) ? '<span class="not-published">Not Published</span>' : '<span>Published</span>';?>
		<a href="/node/<?php echo $row->nid?>/edit">Edit</a></h3>
<?php } ?>
</div>
<?php } else { ?>
<a href="/user">Login to access the content administrator's homepage</a>	
<?php } ?>
