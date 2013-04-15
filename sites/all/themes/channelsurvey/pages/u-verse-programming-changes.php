<div class="img_cache">
	<img src="/sites/all/themes/channelsurvey/images/optionBg.png" />
</div>
<h3>AT&amp;T U-verse Programming Changes</h3>
<p>AT&amp;T's agreements with programmers expire from time to time. We are usually able to obtain renewals or extensions of such agreements, but in rare cases we may be required to cease carriage of channels. For more information on upcoming expirations or other programming changes see below or re-visit this page (http://uversechannels.att.com).</p>
<div class="webform-component-select" id="webform-component-state">
	<div class="form-item" id="edit-submitted-state-wrapper">
 		<label for="edit-submitted-state">State</label>
		<select name="submitted[state]" class="form-select" id="edit-submitted-state" >
			<option value="" selected="selected">Choose Your State</option>
			<?php // Get published state legal descriptions
			
			$query = 'SELECT node.nid AS nid, node.title AS node_title, node.uid AS node_uid, node.type AS node_type, node_revisions.format AS node_revisions_format FROM node node  LEFT JOIN node_revisions node_revisions ON node.vid = node_revisions.vid WHERE (node.type in ("uverse_programming_changes_legal")) AND (node.status <> 0) ORDER BY node_title ASC';

			$result = db_query($query);

			while($row = db_fetch_object($result)) {
				$path = str_replace(' ', '-', strtolower($row->node_title));
				echo '<option value="' . $path . ' ">' . $row->node_title . '</option>';
			
			}			
			
			// html:
			// <option value="AL "> Alabama</option>
			// <option value="AK "> Alaska</option>
			// <option value="AZ "> Arizona</option>
			// <option value="AR "> Arkansas</option>
			// <option value="CA "> California</option>
			// <option value="CO "> Colorado</option>
			// <option value="CT "> Connecticut</option>
			// <option value="DE "> Delaware</option>
			// <option value="FL "> Florida</option>
			// <option value="GA "> Georgia</option>
			// <option value="HI "> Hawaii</option>
			// <option value="ID "> Idaho</option>
			// <option value="IL "> Illinois</option>
			// <option value="IN "> Indiana</option>
			// <option value="IA "> Iowa</option>
			// <option value="KS "> Kansas</option>
			// <option value="KY "> Kentucky</option>
			// <option value="LA "> Louisiana</option>
			// <option value="ME "> Maine</option>
			// <option value="MD "> Maryland</option>
			// <option value="MA "> Massachusetts</option>
			// <option value="MI "> Michigan</option>
			// <option value="MN "> Minnesota</option>
			// <option value="MS "> Mississippi</option>
			// <option value="MO "> Missouri</option>
			// <option value="MT "> Montana</option>
			// <option value="NE "> Nebraska</option>
			// <option value="NV "> Nevada</option>
			// <option value="NH "> New Hampshire</option>
			// <option value="NJ "> New Jersey</option>
			// <option value="NM "> New Mexico</option>
			// <option value="NY "> New York</option>
			// <option value="NC "> North Carolina</option>
			// <option value="ND "> North Dakota</option>
			// <option value="OH "> Ohio</option>
			// <option value="OK "> Oklahoma</option>
			// <option value="OR "> Oregon</option>
			// <option value="PA "> Pennsylvania</option>
			// <option value="RI "> Rhode Island</option>
			// <option value="SC "> South Carolina</option>
			// <option value="SD "> South Dakota</option>
			// <option value="TN "> Tennessee</option>
			// <option value="TX "> Texas</option>
			// <option value="UT "> Utah</option>
			// <option value="VT "> Vermont</option>
			// <option value="VA "> Virginia</option>
			// <option value="WA "> Washington</option>
			// <option value="WV "> West Virginia</option>
			// <option value="WI "> Wisconsin</option>
			// <option value="WY "> Wyoming</option>
			?>
		</select>
 		<div class="description">
			<p>Choose Your State</p>
		</div>
	</div>
</div>

<div id="legal-deploy-area">
	&nbsp;
</div>
<div id="legal-print">
	<a href="javascript:window.print()">Print Legal</a>
</div>
<script type="text/javascript">
// Style menu
$('select').selectmenu({
	style: 'dropdown',
	menuWidth: 220,
	width: 220,
	maxHeight: 310,
	change: function() {
		
		if(this.value != '') {
			// $('#legal-print').fadeOut();
			$("#legal-deploy-area").load("/programming-changes/legal/" + this.value + ".node-inner", null, function(){				
					$('#legal-print').fadeIn();
				}
			);
		}	
	}
});		
</script>