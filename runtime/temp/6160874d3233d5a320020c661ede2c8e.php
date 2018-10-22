<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"C:\AppServ\www\thinkphp\public/../application/index\view\index\indexs.html";i:1539303076;s:63:"C:\AppServ\www\thinkphp\application\index\view\common\menu.html";i:1539164765;s:65:"C:\AppServ\www\thinkphp\application\index\view\common\footer.html";i:1539164418;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>孔子文创</title>
		<link rel="stylesheet" type="text/css" href="/tp5a/public/static/index/css/style.css"/>
		<!--<script src="./js/jquery.js"></script>-->
		<script type="text/javascript" src="/tp5a/public/static/index/js/jquery1.42.min.js"></script>
		<script type="text/javascript" src="/tp5a/public/static/index/js/jquery.SuperSlide.2.1.1.js"></script>
	</head>
	<body>
		<!--导航-->
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
		<div class="mk1 clearfix">
			<p class="tit1">PRODUCE   STROY</p>
			<p class="tit2">产品<span class="bold">故事</span></p>
			<dl class="flex mk1-imgs">
				<dd><a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/main.jpg"/></a></dd>
				<dd><a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/main.jpg"/></a></dd>
				<dd><a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/main.jpg"/></a></dd>
				<dd><a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/main.jpg"/></a></dd>
				<dd><a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/main.jpg"/></a></dd>
			</dl>
		</div>
		<!--通栏banner-->
		<div class="main-banner">
			<a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/banner1.jpg"/></a>
		</div>

		<?php if(is_array($cateResult) || $cateResult instanceof \think\Collection || $cateResult instanceof \think\Paginator): $i = 0; $__LIST__ = $cateResult;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<!--模块2-->
		<div class="mk1 clearfix">
			<p class="tit1">MEET THE CREATIVES</p>
			<p class="tit2"><?php echo $vo['name']; ?></p>
			<dl class="flex mk2-imgs">
			<?php $i=0; foreach($artAll as $key => $value):  if($value['cid'] == $vo['id']): $i++; if($i >3 ) break; ?>
				<dd>
					<a href="javascript:volid(0);" onmousedown="this.className'aaa'"><img src="/tp5a/public/<?php echo $value['pic']?>"/></a>
					<p class="mk2-con"><?php echo $value['title']?></p>
					<p class="mk2-con2"><?php echo $value['desc']?></p>

				</dd>
			<?php   endif;  endforeach; ?>
			</dl>
		</div>
		<!--通栏banner-->
		<div class="main-banner">
			<a href="javascript:volid(0);"><img src="/tp5a/public/static/index/images/<?php if($vo['id'] == '1'): ?>banner3.jpg <?php endif; if($vo['id'] == '2'): ?>banner1.jpg <?php endif; if($vo['id'] == '3'): ?>banner2.jpg <?php endif; ?>" /></a>
		</div>
		<!--模块2-->
		<?php endforeach; endif; else: echo "" ;endif; ?>
		
		<!--底部-->
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
</html>
