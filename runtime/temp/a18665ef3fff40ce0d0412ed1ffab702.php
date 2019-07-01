<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:61:"D:\php\shop\public/../application/backend\view\admin\add.html";i:1561973668;s:64:"D:\php\shop\public/../application/backend\view\layouts\easy.html";i:1561801639;s:64:"D:\php\shop\public/../application/backend\view\layouts\head.html";i:1561801442;s:63:"D:\php\shop\public/../application/backend\view\admin\_form.html";i:1561972478;}*/ ?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <title>管理后台</title>
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
    <body>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="x-body">
    <form class="layui-form">
    <div class="layui-form-item">
        <label for="username" class="layui-form-label">
            <span class="x-red">*</span>登录名
        </label>
        <div class="layui-input-inline">
            <input type="text" id="username" name="username" required="" lay-verify="required"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <span class="x-red">*</span>将会成为您唯一的登入名
        </div>
    </div>
    <div class="layui-form-item">
        <label for="phone" class="layui-form-label">
            <span class="x-red">*</span>手机
        </label>
        <div class="layui-input-inline">
            <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <span class="x-red">*</span>将会成为您唯一的登入名
        </div>
    </div>
    <div class="layui-form-item">
        <label for="L_email" class="layui-form-label">
            <span class="x-red">*</span>邮箱
        </label>
        <div class="layui-input-inline">
            <input type="text" id="L_email" name="email" required="" lay-verify="email"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <span class="x-red">*</span>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span class="x-red">*</span>角色</label>
        <div class="layui-input-block">
            <input type="checkbox" name="like1[write]" lay-skin="primary" title="超级管理员" checked="">
            <input type="checkbox" name="like1[read]" lay-skin="primary" title="编辑人员">
            <input type="checkbox" name="like1[write]" lay-skin="primary" title="宣传人员" checked="">
        </div>
    </div>
    <div class="layui-form-item">
        <label for="L_pass" class="layui-form-label">
            <span class="x-red">*</span>密码
        </label>
        <div class="layui-input-inline">
            <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">
            6到16个字符
        </div>
    </div>
    <div class="layui-form-item">
        <label for="L_repass" class="layui-form-label">
            <span class="x-red">*</span>确认密码
        </label>
        <div class="layui-input-inline">
            <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label for="L_repass" class="layui-form-label">
        </label>
        <button  class="layui-btn" lay-filter="add" lay-submit="">
            增加
        </button>
    </div>
</form>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
                , layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function (value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , repass: function (value) {
                if ($('#L_pass').val() != $('#L_repass').val()) {
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        form.on('submit(add)', function (data) {
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6}, function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
        });


    });
</script>
<script>var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
            </div>
        </div>
    </body>
</html>
