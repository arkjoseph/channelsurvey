<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
	<head>
		<title><?php echo $title; ?></title>
  		<?php print $head; ?>
  		<?php print $styles; ?>
  		<?php print $scripts; ?>
		<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/channelsurvey/css/reset.css" />
		<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/channelsurvey/css/style.css" />			
		
		<script type="text/javascript" src="/sites/default/files/scripts-and-libraries/menu/jquery-ui-1.7.3.custom.min.js"></script>
		<script type="text/javascript" src="/sites/default/files/scripts-and-libraries/menu/ui.core.min.js"></script>
		<script type="text/javascript" src="/sites/default/files/scripts-and-libraries/menu/ui.selectmenu.js"></script>
		<!-- <script type="text/javascript">
			if(navigator.userAgent.toLowerCase().indexOf('safari') != -1) {
				document.write('<style type="text/css"> .radios label {float: right}</style>');
			}
		</script> -->
		<link type="text/css" rel="stylesheet" media="all" href="/sites/default/files/scripts-and-libraries/menu/ui.selectmenu.css" />			
		<link type="text/css" rel="stylesheet" media="all" href="/sites/default/files/scripts-and-libraries/menu/css/ui-lightness/jquery-ui-1.7.3.custom.css" />			
	</head>
	<body class="<?php print $body_classes; ?>">
  		<div id="page">
    		<div id="header">
				<a id="logo" href="http://uverseonline.att.net">
					<img src="/sites/all/themes/channelsurvey/images/logo.png" />
				</a>
				<?php if ($header): ?>
					<?php print $header; ?>
				<?php endif; ?>
	    	</div>
	    	<div id="main">
      			<div id="content">
					<div id="content-header">
						<?php print $messages; ?>          					
	          			<?php print $help; ?>
	        		</div>					
					<?php // print $content; ?>
					<h1>We're currently performing maintenance and will return shortly. Sorry for any inconvenience.</h1>
					
				</div>
			</div>			
			<?php if ($footer || $footer_message): ?>
	      	<div id="footer">
				<div id="footer-inner" class="region region-footer">
					<?php if ($footer_message): ?>
						<div id="footer-message">
							<?php print $footer_message; ?>
						</div>
	        		<?php endif; ?>
       				<?php print $footer; ?>
	      		</div>	
			</div>
	    	<?php endif; ?>	
		</div>		
		<?php if ($closure_region): ?>
			<div id="closure-blocks" class="region region-closure"><?php print $closure_region; ?></div>
		<?php endif; ?>		
		<?php print $closure; ?>		
		<script type="text/javascript">
		// Default Text
		$("input[type=text]").focus(function() {
			handle_default_text(this);			
			$(this).parent("span").parent("span").addClass("focus");
		});	
		$("input[type=text]").blur(function() {
			handle_default_text(this);
			$(this).parent("span").parent("span").removeClass("focus");
		});

		// Highlight/un-highlight on focus/de-focus
		$("textarea").focus(function() {
			$(this).parents("span").addClass("focus");
		});	
		$("textarea").blur(function() {
			$(this).parents("span").removeClass("focus");
		});

// Check/un-check radio buttons

		// // For Safari and Chrome
		// $("input[type=radio]").mouseup(function(e){
		// 	e.preventDefault();
		// });

		// Check/un-check radio buttons
		$("input[type=radio]").click(function() {
			$(this).parents("div.form-radios").find("span.radio").removeClass('checked');
			$(this).prev("span").addClass("checked");
		})



		// Style menu
		$('select').selectmenu({
			style: 'dropdown',
			menuWidth: 220,
			width: 220,
			maxHeight: 310
			}
		);		

		if($('#content-header div').hasClass('error')) {
			$('#content .content').addClass('form-error');
		}

		function handle_default_text(field) {

			if(field.defaultValue == field.value) {
				field.value = '';
			} else if(field.value == '') {
				field.value = field.defaultValue;
			} 
		}
		</script>
		<script type="text/javascript">
		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-17841321-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
	</body>
</html>