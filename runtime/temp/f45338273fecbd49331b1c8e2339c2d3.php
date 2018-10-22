<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"C:\AppServ\www\thinkphp\public/../application/admin\view\login\index.html";i:1533107503;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>信通太合网站管理系统</title>
    <link rel="stylesheet" href="/tp5a/public/static/admin/vendor/layui/css/layui.css">
    <link rel="stylesheet" href="/tp5a/public/static/admin/custom/css/login.css">
</head>
<body>
<div class="layui-anim layui-anim-up login-main" id="form-main">
    <form class="layui-form" action="?" method="post">
        <h3><span>信通太合</span>网站管理系统</h3>
        <div class="ly-input">
            <input type="text" name="account" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
        <div class="ly-input">
            <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="ly-input" style="position:relative;">
            <input type="text" name="code" required  lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input" style="width:100px;">
            <div><img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random();" style="position:absolute;left:110px;top:0;height:35px;cursor:pointer;"/></div>
        </div>
        <div class="ly-input">
            <button class="layui-btn layui-btn-danger ly-submit" id="ly-submit" lay-submit lay-filter="formDemo">登录</button>
        </div>
    </form>
    <p>版权所有：信通太合</p>
</div>

<script src="/tp5a/public/static/admin/vendor/js/jquery.js"></script>
<script src="/tp5a/public/static/admin/vendor/layui/layui.js"></script>
<script src="/tp5a/public/static/admin/custom/js/login.js"></script>
<script>
    //一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
        form.on('submit(formDemo)', function(data){
            $('#ly-submit').submit();
        });
    });
</script>
</body>
</html>