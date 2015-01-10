<?php
/**
 * Template Name: 门派app
 */
get_header();
?>

<div class="slide">
  <a href="javascript:void(0)" data-dialog="somedialog" class="trigger">
    <img style="margin-top:187px;margin-left:549px;" src="<?php echo get_template_directory_uri();?>/images/app_d.png" />
  </a>
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

<div id="content" >
  <h1 class="f40 cyan" style="margin-top:130px;font-size:33px;">免费下载，创建属于你们的门派  </h1>
  
  <div class="section area1">
  
  <div class="wrap">
          <h1 class="f36" style="font-size:30px;margin-top:100px;">
            社区功能<br />
            <span style="font-size:22px;line-height:50px;">支持图片、文字、语音、位置分享</span>
          </h1>
          
          <div class="icon">
           <table width="460" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_08.png" width="77" height="77" alt=""/></td>
            <td align="center" width="50"><img src="<?php echo get_template_directory_uri();?>/images/app2_17.png" width="11" height="11" alt=""/></td>
            <td align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_10.png" width="77" height="77" alt=""/></td>
            <td align="center" width="50"><img src="<?php echo get_template_directory_uri();?>/images/app2_17.png" width="11" height="11" alt=""/></td>
            <td align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_12.png" width="77" height="77" alt=""/></td>
            <td align="center" width="50"><img src="<?php echo get_template_directory_uri();?>/images/app2_17.png" width="11" height="11" alt=""/></td>
            <td align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_14.png" width="77" height="77" alt=""/></td>
          </tr>
          <tr>
            <td align="center">文本</td>
            <td align="center">&nbsp;</td>
            <td align="center">图片</td>
            <td align="center">&nbsp;</td>
            <td align="center">语音</td>
            <td align="center">&nbsp;</td>
            <td align="center">位置</td>
          </tr>
        </table>
        
          
          </div>
    </div>
  </div>

  
  <div class="section area2 clear">
     <div class="wrap">
     <h1 class="f36" style="font-size:30px;">行动管理功能</h1>
     <h2 class="f22">轻松管理聚会、抽奖、筹款、雷法呼叫</h2>
     
     
     <dl>
       <dt><img src="<?php echo get_template_directory_uri();?>/images/app2_22.png" alt=""></dt>
       <dd class="f22">聚会</dd>
       <dd>统计报名，推送活动</dd>
       <dd>一键管理集体行动</dd>
     </dl>
     
       <dl>
       <dt><img src="<?php echo get_template_directory_uri();?>/images/app2_25.png" alt=""></dt>
       <dd  class="f22">抽奖</dd>
      <dd>不定时好礼袭击</dd>
       <dd>试吃试玩赢大礼</dd>
     </dl>
     
       <dl>
       <dt><img src="<?php echo get_template_directory_uri();?>/images/app2_27.png" alt=""></dt>
         <dd  class="f22">筹款</dd>
      <dd>聚餐团购必备神器</dd>
       <dd>线上也能玩AA</dd>
     </dl>
     
       <dl>
       <dt><img src="<?php echo get_template_directory_uri();?>/images/app2_29.png" alt=""></dt>
       <dd  class="f22">雷达</dd>
       <dd>一方召唤，八方呼应</dd>
         <dd>同门坐标齐分享</dd>
     </dl>
     </div>
  </div>
  
  
  
  <div class="banner ">
  <div class="wrap">
  <img src="<?php echo get_template_directory_uri();?>/images/app2_36.png" alt="">
  </div>
  </div>
  
  
  
  <div class="section area3">
  <div class="wrap">
      <h1 class="f36" style="font-size:30px;">门派基金会</h1>
      <h2 class="f22">利于社群成员签收各类线上、线下福利，<br/>为集体筹集经费、获得收入</h2>
          
  </div>
  </div>
  
  
  
  
  
  
  <div class="section area4">
  
      <div class="wrap">
          <dl>
          <dt class="f22 purple">福利</dt>
          <dd>免费加油、免费吃喝、免费玩乐，</dd>
          <dd style="margin-top:15px;">满足一切社群所需！</dd>
          </dl>
          
          
          <dl>
          <dt class="f22 orange">活动经费</dt>
          <dd>在线轻松点击，经费叮咚入账！</dd>
          </dl>
          
          
          <dl>
          <dt class="f22 blue">特供商品</dt>
          <dd>订制商品，惊喜特价、奇味特产、新品尝鲜，</dd>
          <dd style="margin-top:15px;">一切尽在赞助商精选特供！</dd>
          </dl>

          <dl>
          <dd style="font-size:12px;color:#bbb;">* 建议社群管理者(GM)将“门派”与QQ群、微信组合使用。</dd>
          <dd style="font-size:12px;color:#bbb;">获得门派“+V”认证，开通社群官方网站，立即后的品牌赞助商的支持</dd>
          </dl>
      </div>
  </div>
  

  <!-- <div class="section area5 clear">
      <div class="wrap">
      <h1 class="f40 green">获得门派SPT认证，获得赞助商的支持</h1>
     <div class="pic"> <img src="<?php echo get_template_directory_uri();?>/images/app2_48.png" alt=""></div>
      <div class="fl">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td><img src="<?php echo get_template_directory_uri();?>/images/app2_54.png" alt=""></td>
        <td width="110" align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_62.png" alt=""></td>
        <td><img src="<?php echo get_template_directory_uri();?>/images/app2_56.png" alt=""></td>
        <td width="110" align="center"><img src="<?php echo get_template_directory_uri();?>/images/app2_65.png" alt=""></td>
        <td><img src="<?php echo get_template_directory_uri();?>/images/app2_58.png" alt=""></td>
      </tr>
      <tr>
        <td>群主实名认证</td>
        <td>&nbsp;</td>
        <td>拥有5名以上成员</td>
        <td>&nbsp;</td>
        <td>获得认证</td>
      </tr>
    </table>
    
      </div>
      
      <div class="fr">
      <ul>
      <li class="i1">接受赞助商提供的福利与活动经费</li>
      <li class="i2">享受超级优惠的订制特供商品与服务</li>
      <li class="i3">各种惊喜与奖品随时发送</li>  </ul>
      </div>
      </div>
  </div> -->
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

<?php get_footer();