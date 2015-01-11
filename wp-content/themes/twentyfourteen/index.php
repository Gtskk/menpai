<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div style="padding-top:60px;background-color:#f0f0f0;">
	<p style="text-align:center">
		<img src="<?php echo get_template_directory_uri();?>/images/index_top1.png" alt="top1">
		<br />
		<img src="<?php echo get_template_directory_uri();?>/images/index_top2.png" alt="top2">
	</p>
	
</div>
<div id="content" class="index">
     
    <h1 class="f36" style="margin-top:50px;margin-bottom:10px;font-size:24px;">门派，一起玩出新花样</h1>
    <h2 class="f28" style="font-size:16px;">YOUY WORLD, YOUR GUYS</h2>
	<?php query_posts(array('cat'=>10, 'post__in'=>get_option('sticky_posts')));if(have_posts()):?>
    <div class="flexslider">
		<ul class="slides">
		<?php while(have_posts()):the_post();?>
	        <li>
	        	<a href="<?php the_permalink();?>">
	        		<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'post-thumbnail');
	        			$image = $thumb ? $thumb[0] : '<?php echo get_template_directory_uri(); ?>/images/i_06.jpg';
	        		?>
	        		<img src="<?php echo $image;?>" alt="j">
					<h2><?php echo get_the_date('m月d日');?> <?php echo mb_substr(get_the_title(), 0, 40);?></h2>
	        	</a>
	        </li>
	    <?php endwhile;?>
	    </ul>
    	
    </div>
	<?php endif;wp_reset_postdata();?>
</div>
<div style="background-color:#f0f0f0;">
	<div id="content" class="index">
	    <h1 class="f36" style="padding-top:80px;font-size:29px;margin-top:120px;">
	     	在南京，至少存在6500个社群，325000名成员
	    </h1>
	    <div class="banner" style="margin-bottom:12px;">
	    	<img src="<?php echo get_template_directory_uri(); ?>/images/ii_05.jpg" alt="">
		</div>
	     
	    <?php
	     	$query = new WP_Query('cat=11&post_per_page=3');
	     	if($query->have_posts()):
	 	?>
	    <div class="col3 spec clear" style="padding-bottom:110px;">
	    	<?php while($query->have_posts()):$query->the_post();?>
	        <ul>
	            <li>
	            	<?php $logos = rwmb_meta('gtskk_grouplogo', 'type=image_advanced', get_the_id());
	            		foreach ($logos as $logo):
	            	?>
		            <img style="margin-top:30px;" src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>">
			        <?php endforeach;?>
		            <h3><?php the_title();?>
		            	<em><?php echo rwmb_meta('gtskk_groupname', 'type=text', get_the_id());?></em>
		            </h3>
		            <p style="padding:0 25px 30px;"><?php echo get_the_excerpt();?></p>
		            <?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'medium');?>
					<img src="<?php echo isset($img[0]) ? $img[0] : '';?>" alt="">
	            
	            </li>
	        </ul>
		    <?php endwhile;?>
	    </div>
		<?php endif;?>
	</div>
</div>

<div class="download">
    <div class="wrap">
	    <h1 class="f36">免费下载门派APP<br />
	创建属于你们的门派</h1>
	    <h2 class="f16">新一代移动社区+穿心行动管理功能+海量福利赞助</h2>
	    <a href="javascript:void(0)" data-dialog="somedialog" class="trigger down_btn">
	       <img src="<?php echo get_template_directory_uri(); ?>/images/ii_26.jpg" alt="">
	    </a>
    </div>
</div>

<div id="somedialog" class="dialog">
  <div class="dialog__overlay"></div>
  <div class="dialog__content">
    <img class="action" style="position:absolute;top:5px;right:5px;cursor:pointer;" src="<?php echo get_template_directory_uri();?>/images/close_bt.png" alt="close" data-dialog-close>

    <div style="float:left;width:700px;text-align:left;" class="gtskkll">
      <p style="font-size:12pt;color:rgb(0,200,200);">
        <span style="font-size:9pt;color:rgb(120,120,120);line-height:35px;">感谢您对门派的支持</span>
        <br />
        门派APP正在内测中，请输入邀请码
      </p>
      <style type="text/css">
        .gtskkll a{background-color:rgb(150,150,150);vertical-align: middle;}
        .gtskkll a:hover{background-color: rgb(120,120,120);}
        .gtskkll a:active{background-color: rgb(0,200,200);}
        .down_hide,.error_code{display: none;}
      </style>
      <input style="width:474px;height:34px;margin-top:35px;background-color:rgb(245,245,245);border:rgb(220,220,220);" type="text" name="invite_code" />
      <a href="javascript:void(0);" style="padding:9px 20px;color:#fff;border: rgb(220,220,220) 1px solid;">确&nbsp;&nbsp;认</a>
      <p style="font-size:9pt;color:rgb(120,120,120);line-height:35px;" class="error_code">
        您输入的邀请码有误
      </p>
    </div>
    <div class="down_hide">
      <img src="<?php echo get_template_directory_uri();?>/images/d_erweima.png" alt="下载二维码" />
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/dialogFx.js"></script>
<script>
  (function() {

    var dlgtrigger = document.querySelector( '[data-dialog]' ),
      somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
      dlg = new DialogFx( somedialog );

    dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

  })();
  <?php 
  	$admin_url=admin_url( 'admin-ajax.php' );?>
  $(document).ready(function(){
  	$('.gtskkll a').click(function(){
  		var data = {
  			action: 'invite_code',
  			invite: $('input[name="invite_code"]').val()
  		};
  		$.post('<?php echo $admin_url;?>', data, function(resp){
  			if(resp == 'ok')
  			{
  				$('.down_hide').show();
  				$('.error_code').hide();
  			}
  			else if(resp == 'error')
  			{
  				$('.down_hide').hide();
  				$('.error_code').show();
  			}
  		});
  	});
  });
</script>

<?php
get_footer();