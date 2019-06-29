<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\php\shop\public/../application/backend\view\publics\login.html";i:1561792910;}*/ ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>后台登录</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />

        <link rel="shortcut icon" href="__PUBLIC__/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="__BACKEND_STYLE__/css/font.css">
        <link rel="stylesheet" href="__BACKEND_STYLE__/css/xadmin.css">
        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="__STATIC__/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="__BACKEND_STYLE__/js/xadmin.js"></script>

    </head>
    <body class="login-bg">

        <div class="login">
            <div class="message">管理登录</div>
            <div id="darkbannerwrap"></div>

            <form method="post" class="layui-form" action='' >
                <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
                <hr class="hr15">
                <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
                <hr class="hr15">
                <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
                <hr class="hr20" >
            </form>
        </div>

        <script>
            $(function () {
                layui.use('form', function () {
                    var form = layui.form;
                    form.on('submit(login)', function (data) {
                        layer.msg('登陆中，请稍后....');
                        return true;
                    });
                });
            })
        </script>
        <!-- 底部结束 -->
    </body>
</html> 