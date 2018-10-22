<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"C:\AppServ\www\tp5a\public/../application/index\view\show\show.html";i:1539323407;s:59:"C:\AppServ\www\tp5a\application\index\view\common\menu.html";i:1539164765;s:61:"C:\AppServ\www\tp5a\application\index\view\common\footer.html";i:1539164418;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>孔子文创</title>
		<link rel="stylesheet" type="text/css" href="/tp5a/public/static/index/css/style.css"/>
		
		<script type="text/javascript" src="/tp5a/public/static/index/js/jquery1.42.min.js"></script>
		<script type="text/javascript" src="/tp5a/public/static/index/js/jquery.SuperSlide.2.1.1.js"></script>
	</head>
	<body>
	<!--导航-->
<div class="nav">
    <ul class="clearfix">
        <img src="/tp5a/public/static/index/images/logo.png"/>
        <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($currtype == '0'): ?>class="current"<?php endif; ?>><a href="<?php echo makeurl($vo['type'],$vo['id']); ?>"><?php echo $vo['name']; ?></a></li>

        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<!--banner-->

<div id="slideBox" class="slideBox">
    <!--<div class="hd">
        <ul><li>1</li><li>2</li><li>3</li></ul>
    </div>-->

    <div class="bd">

        <ul>
            <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo $vo['url']; ?>" target="_blank"><img src="/tp5a/public/<?php echo $vo['pic']; ?>" /></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>

    </div>

    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>

</div>

<script type="text/javascript">
    jQuery(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true});
</script>

		<!--模块1-->
		<div class="pro-mk1 clearfix">
			
			<dl class="flex">
				<dd>
					<a href="<?php echo url('Show/index',['cid'=>2]); ?>"><img src="/tp5a/public/static/index/images/ico1.jpg"/></a>
					<p class="product-con"><?php echo $AllCate['1']['name']; ?></p>
					<p class="product-con2">MEET THE CREATIVES</p>
				</dd>
				<dd>
					<a href="<?php echo url('Wenju/index',['cid'=>3]); ?>"><img src="/tp5a/public/static/index/images/ico2.jpg"/></a>
					<p class="product-con"><?php echo $AllCate['2']['name']; ?></p>
					<p class="product-con2">MEET THE CREATIVES</p>
				</dd>
				<dd>
					<a href="<?php echo url('Riyong/index',['cid'=>1]); ?>"><img src="/tp5a/public/static/index/images/ico3.jpg"/></a>
					<p class="product-con"><?php echo $AllCate['0']['name']; ?></p>
					<p class="product-con2">MEET THE CREATIVES</p>
				</dd>
			</dl>
		</div>
		
		<!--模块2-->
		<div class="mk1 clearfix">
			
			<dl class="flex promk2-imgs">
				<?php if(is_array($artRes) || $artRes instanceof \think\Collection || $artRes instanceof \think\Paginator): $i = 0; $__LIST__ = $artRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<dd>
					<a href="javascript:volid(0);"><img src="/tp5a/public/<?php echo $vo['pic']['pic']; ?>"/></a>
					<p class="mk2-con"><?php echo $vo['title']; ?></p>
					<p class="mk2-con2"><?php echo $vo['desc']; ?></p>
				</dd>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</dl>
		</div>
		<!--查看更多-->
		<a href="javascript:volid(0);" class="many" id="many">查看更多 >>></a>
		<div class="mk1 clearfix" style="display: none;" id="many-div">
			<dl class="flex promk2-imgs">
				<?php if(is_array($artAllRes) || $artAllRes instanceof \think\Collection || $artAllRes instanceof \think\Paginator): $i = 0; $__LIST__ = $artAllRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<br>
				<dd>
					<a href="javascript:volid(0);"><img src="/tp5a/public/<?php echo $vo['pic']['pic']; ?>"/></a>
					<p class="mk2-con"><?php echo $vo['title']; ?></p>
					<p class="mk2-con2"><?php echo $vo['desc']; ?></p>
				</dd>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</dl>
		</div>
		<!--底部-->
<div class="foot-bj"></div>
<div class="footer">
    <ul>
        <li><img src="/tp5a/public/static/index/images/<?php echo $logoPic['logo']; ?>"/></li>

        <li <?php if($currtype == '0'): ?>class="current"<?php endif; ?>>
            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo makeurl($vo['type'],$vo['id']); ?>"><?php echo $vo['name']; ?></a>

        <?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
    </ul>
</div>
		
	</body>
	
	<script type="text/javascript">
//		$(".promk2-imgs dd img").addClass("clickimg");
//		$(".promk2-imgs dd img").click(function(){ 
//			
//			$(this).toggleClass("clickimg");
//			$(this).addClass("clickimg2");
//		});
		
		$("#many").click(function(){
			if($("#many-div").is(":hidden")){
				$("#many-div").slideDown(1000);
				$(this).html("收起 >>>");
			}else{
				
				$("#many-div").slideUp(1000);
				$(this).html("查看更多 >>>");
			}
			
		})
	</script>
</html>
