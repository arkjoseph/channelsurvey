<!------ Modal Area ------->
<div class="">
	<!-- Header Copy Block -->
	<p class="resultsHeader">
		Channel and programming availability subject to change without notice. Channels not available in all areas. To see the most recent channel listings in your area click below. 
	</p>
	<!-- End Header -->	
	
	<!-- List Data with column headers -->
	<ul class="resultsHeader">
		<li class="listTopLeft"><span>Result</span></li>
		<li><span>u450</span></li>
		<li><span>u300</span></li>
		<li><span>u200</span></li>
		<li><span>U-fam</span></li>
		<li><span>Intl</span></li>
		<li><span>PE/<br />Ux00Latino</span></li>
		<li><span>HD<br />Premium Tier</span></li>
		<li class="listTopRight"><span>Addt'l<br />Channels</span></li>
	</ul>
	
	<div class="resultBox">
		<?php foreach ($rows as $id => $row): ?>
		  <ul class="results">
		    <?php print $row; ?>
		  </ul>
		<?php endforeach; ?>
	</div>
	<div class="gradInd"></div>
	
	<br>
	
	<div class="form-links avail"><button class="searchZip" href="http://www.att.com/channellineup"><span class="input-submit-span">Check Availability</span></button></div>
</div>