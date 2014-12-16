<link rel='stylesheet' id='demo-style'  href='<?php echo THEME_URI;?>/_switcher/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='demo-minicolor'  href='<?php echo THEME_URI;?>/_switcher/miniColors/jquery.miniColors.css' type='text/css' media='all' />

<script type="text/javascript">
var template = '<?php echo THEME_URI;?>';
</script>
<div id="pl_control_panel">
	<div id="panel_control" class="control-open"></div>
	<div class="padd">
		<div class="input" id="predefined_skins">
        <h4>Example Skins</h4>
		<a href="" data-primary_color="f8a82a" data-bgcolor="eeeeee" data-pattern="bg00"></a>
        <a href="" data-primary_color="ff0094" data-bgcolor="eeeeee" data-pattern="bg01"></a>
		<a href="" data-primary_color="b733ff" data-bgcolor="eeeeee" data-pattern="bg02"></a>
		<a href="" data-primary_color="00aaad" data-bgcolor="eeeeee" data-pattern="bg03"></a>
		<a href="" data-primary_color="8cbe29" data-bgcolor="eeeeee" data-pattern="txture"></a>
		<a href="" data-primary_color="9c5100" data-bgcolor="eeeeee" data-pattern="purty_wood"></a>
		<a href="" data-primary_color="e671b5" data-bgcolor="eeeeee" data-pattern="bg06"></a>
		<a href="" data-primary_color="19a2de" data-bgcolor="eeeeee" data-pattern="bg07"></a>
		<a href="" data-primary_color="e61400" data-bgcolor="eeeeee" data-pattern="bg08"></a>
		<a href="" data-primary_color="319a31" data-bgcolor="eeeeee" data-pattern="bg09"></a>
		<div class="clear"></div>
		</div>
		
		<div class='input'>
			<div class="half">
				<h4>Primary Color</h4>
				<input type='text' value='#<?php echo of_get_option('primary_color');?>' name='primary_color' id='primary_color'/>
			</div>
			<div class="half">
				<h4>BG Color</h4>
				<input type='text' value='#<?php echo of_get_option('bg_color');?>' name='custom_bg_color' id='custom_bg_color'/>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class='input'>
			<h4>Example Patterns</h4>
			<div id='custom_bg_image' class="custom_bg_image">
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="bg00" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="bg01" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="bg02" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="bg03" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="bg04" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="retina_wood" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="purty_wood" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="triangles" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="txture" alt="demo" />
				<img src='<?php echo THEME_URI;?>/_switcher/images/_blank.png' data-img="white_brick_wall" alt="demo" />
				<div class="clear"></div>
			</div>
		</div>
		<br />
		<input type="button" id="reset_style" value="Refresh" />
		
		<!--- end -->
	</div>	
</div>	

<script src="<?php echo THEME_URI;?>/_switcher/miniColors/jquery.miniColors.min.js"></script>
<script src="<?php echo THEME_URI;?>/_switcher/script.js"></script>
