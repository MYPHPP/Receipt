<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/vagrant_www/receipt/public/../application/admin/view/tasks/task-add.html";i:1571044433;s:61:"/vagrant_www/receipt/application/admin/view/common/blank.html";i:1569067409;s:62:"/vagrant_www/receipt/application/admin/view/common/footer.html";i:1540627322;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/lib/respond.min.js"></script>

<!--1-图片上传的引入文件-->
<link href="/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/static/bootstrap/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="/static/bootstrap/js/jquery-2.0.3.min.js"></script>
<script src="/static/bootstrap/js/fileinput.js" type="text/javascript"></script>
<script src="/static/bootstrap/js/fileinput_locale_de.js" type="text/javascript"></script>
<script src="/static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


<link href="/static/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/static/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>

<!--引入echarts 数据图-->
 <script src="/static/lib/echarts/echarts.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>-->
<!--<script>DD_belatedPNG.fix('*');</script>-->

<link rel="stylesheet" href="/static/lib/ydui/css/ydui.css">
<link href="/static/home/css/main.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--/meta 作为公共模版分离出去-->
<style>
    .layui-form-radio{display: none;}
    .layui-input-4{width:60%;float: left;}
</style>
<title>添加任务 - 初创网络</title>
</head>
<body>
<article class="page-container task-add">
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">任务类型</label>
            <div class="layui-input-block">
                <select name="type" lay-verify="required" lay-filter="type">
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" type="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">支持设备</label>
            <div class="layui-input-block">
                <select name="os" lay-verify="required" lay-filter="os">
                    <option value="0" selected>全部</option>
                    <option value="1">苹果</option>
                    <option value="2">安卓</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">LOGO：</label>
            <input type="hidden" name="logo" id="image">
            <div class="layui-input-block" style="overflow: hidden;">
                <div class="layui-upload">
                    <button type="button" class="layui-btn layui-btn-primary" id="logoBtn"><i class="icon icon-upload3"></i>点击上传</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" id="logoImage" width="100px">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务名称</label>
            <div class="layui-input-block cc-local">
                <input type="text" name="name" lay-verify="required" placeholder="请输入任务名称" class="layui-input" data-name="name">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务标题</label>
            <div class="layui-input-block cc-local">
                <input type="text" name="title" lay-verify="required" placeholder="请输入任务标题" class="layui-input" data-name="title">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务说明</label>
            <div class="layui-input-block cc-local">
                <input type="text" name="remark" lay-verify="required" placeholder="请输入任务名称" class="layui-input" data-name="remark">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">接单限时</label>
            <div class="layui-input-block">
                <select name="outtime" lay-verify="required" lay-filter="outtime">
                    <option value="">请选择接单限时</option>
                    <option value="1800">30分钟</option>
                    <option value="3600">1小时</option>
                    <option value="21600">6小时</option>
                    <option value="86400">1天</option>
                    <option value="259200">3天</option>
                    <option value="432000">5天</option>
                    <option value="604800">7天</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">审核时间</label>
            <div class="layui-input-block">
                <select name="passtime" lay-verify="required" lay-filter="passtime">
                    <option value="">请选择审核时间</option>
                    <option value="21600">6小时</option>
                    <option value="43200">12小时</option>
                    <option value="86400">1天</option>
                    <option value="172800">2天</option>
                    <option value="259200">3天</option>
                    <option value="345600">4天</option>
                    <option value="432000">5天</option>
                    <option value="518400">6天</option>
                    <option value="604800">7天</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务单价</label>
            <div class="layui-input-block cc-local">
                <input type="text" name="price" lay-verify="required" placeholder="不修改请留空" class="layui-input" data-name="price">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务数量</label>
            <div class="layui-input-block cc-local">
                <input type="text" name="number" lay-verify="required" placeholder="请输入任务数量" class="layui-input" data-name="number">
            </div>
        </div>
        <div class="layui-form-item ">
            <label class="layui-form-label">任务步骤</label>
            <div class="task-step-add">
                <button type="button" class="red urls">网址</button>
                <button type="button" class="red ewms">二维码</button>
                <button type="button" class="red copys">复制</button>
                <button type="button" class="red pics">说明图</button>
                <button type="button" class="red marks">验证图</button>
                <button type="button" class="red datas">收集</button>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">首页</label>
            <div class="layui-input-block">
                <input type="radio" name="is_hot" value="1" checked title="默认">
                <input type="radio" name="is_hot" value="0" title="顶置">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顶置</label>
            <div class="layui-input-block">
                <input type="radio" name="is_top" value="1" checked title="默认">
                <input type="radio" name="is_top" value="0" title="顶置">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-block">
                <input type="checkbox" name="icon[]" value="icon-bao" title="保障">
                <input type="checkbox" name="icon[]" value="icon-jian" title="推荐">
                <input type="checkbox" name="icon[]" value="icon-top" title="顶置">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="0" checked title="启用">
                <input type="radio" name="status" value="1" title="禁用">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">提交</button>
            </div>
        </div>
    </form>
</article>
<div class="task-mobile">
    <header class="m-navbar detail-bar no-bar">
        <a href="javascript:;" class="navbar-item">
            <i class="back-ico"></i>
        </a>
        <div class="navbar-center">
            <span class="navbar-title">任务预览</span>
        </div>
        <a href="javascript:;" class="navbar-item">
            <i class="Hui-iconfont">&#xe6f9;</i>
        </a>
    </header>
    <div class="detail-top" style="width: 100%;">
        <div class="task-info">
            <img src="/static/home/img/avatar.jpg">
            <h3><span id="title"></span><em><span id="price"></span>元</em></h3>
            <p id="name"></p>
            <ul>
                <li>
                    <h4 id="number"></h4>
                    <span>剩余数量</span>
                </li>
                <li>
                    <h4>0</h4>
                    <span>完成数量</span>
                </li>
                <li>
                    <h4 id="outtime"></h4>
                    <span>做单时间</span>
                </li>
                <li>
                    <h4 id="passtime"></h4>
                    <span>审核时间</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="detail-body">
        <h3>任务说明</h3>
        <p id="remark"></p>
    </div>
    <div class="detail-content">
        <h3>做单步骤<span>（建议网址和二维码放在第一步）</span></h3>
        <ul class="push-data">
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type'] == 'url'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <p>
                                <a href="javascript:;" class="detail-btn link">打开链接</a>
                                <a href="javascript:;" class="detail-btn copy" data-clipboard-action="copy" data-clipboard-text="<?php echo $vo['txt']; ?>">复制链接</a>
                            </p>
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; if($vo['type'] == 'ewm'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <img src="<?php echo $vo['txt']; ?>" id="ewm">
                            <a href="javascript:;" data-ewm="<?php echo $vo['txt']; ?>" class="detail-btn ewm">保存扫码</a>
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; if($vo['type'] == 'copy'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <input type="text" value="<?php echo $vo['txt']; ?>" class="cc-input" disabled>
                            <a href="javascript:;" class="detail-btn copy" data-clipboard-action="copy" data-clipboard-text="<?php echo $vo['txt']; ?>">复制数据</a>
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; if($vo['type'] == 'pic'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <div class="pic">
                                <div class="remark">说明图</div>
                                <img src="<?php echo $vo['txt']; ?>">
                            </div>
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; if($vo['type'] == 'mark'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <div class="pic">
                                <div class="remark">验证图</div>
                                <img src="<?php echo $vo['txt']; ?>">
                            </div>
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; if($vo['type'] == 'data'): ?>
                    <li class="num<?php echo $vo['id']; ?>">
                        <div class="left">
                            <span id="num<?php echo $i; ?>" data-id="<?php echo $vo['id']; ?>"><?php echo $i; ?></span>
                        </div>
                        <div class="right">
                            <h3><?php echo $vo['mark']; ?></h3>
                            <input type="text" class="yztxt cc-input" id="yztxt" placeholder="请按要求输入文字内容">
                        </div>
                        <div class="task-detail">
                            <ul>
                                <li id="click<?php echo $i; ?>" onclick="delstep(<?php echo $vo['id']; ?>,<?php echo $i; ?>)"><i class="Hui-iconfont Hui-iconfont-del2"></i> 删除</li>
                                <li class="edit" data-id="<?php echo $vo['id']; ?>" data-type="<?php echo $vo['type']; ?>" data-title="<?php echo $vo['mark']; ?>" data-txt="<?php echo $vo['txt']; ?>"><i class="Hui-iconfont Hui-iconfont-edit2"></i> 编辑</li>
                            </ul>
                        </div>
                    </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<script src="/static/lib/ydui/js/ydui.flexible.js"></script>
<script type="text/javascript" src="/static/admin/js/cctask.admin.js?1010"></script>
<script type="text/javascript" src="/static/admin/js/ccui.admin.js?1010"></script>
<link href="/static/admin/css/cc.admin.css" media="all" rel="stylesheet" type="text/css">
<link href="/static/lib/layui/css/layui.css" media="all" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/lib/layui/layui.js"></script>
<script>
    layui.use(['form', 'layer','upload'], function () {
        var form = layui.form, layer = layui.layer,$= layui.jquery,upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#logoBtn',
            url: '<?php echo url("Upfiles/upload"); ?>',
            done: function(res){
                if(res.code>0){
                    $('#image').val(res.url);
                    $('#logoImage').attr('src', res.url);
                }else{
                    //如果上传失败
                    return layer.msg('上传失败');
                }
            },
            error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
        form.on('submit(submit)', function (data) {
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post("", data.field, function (res) {
                layer.close(loading);
                if (res.code == 0) {
                    layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                        window.localStorage.removeItem('formHistory');
                        var index = parent.layer.getFrameIndex(window.name);
                        window.parent.location.reload();
                        parent.layer.close(index);
                    });
                } else {
                    layer.msg(res.msg, {time: 1800, icon: 2});
                }
            });
        });
        form.on('select(passtime)', function(data){
            $('#passtime').html(formatSeconds(data.value));
            console.log(data.value); //得到被选中的值
        });
        form.on('select(outtime)', function(data){
            $('#outtime').html(formatSeconds(data.value));
            console.log(data.value); //得到被选中的值
        });
        $('body').on('blur','.layui-input',function() {
            var name = $(this).data('name');
            $('#' + name).html($(this).val());
        });
    });
    function formatSeconds(value) {
        var theTime = parseInt(value);// 需要转换的时间秒
        var theTime1 = 0;// 分
        var theTime2 = 0;// 小时
        var theTime3 = 0;// 天
        if(theTime > 60) {
            theTime1 = parseInt(theTime/60);
            theTime = parseInt(theTime%60);
            if(theTime1 > 60) {
                theTime2 = parseInt(theTime1/60);
                theTime1 = parseInt(theTime1%60);
                if(theTime2 > 24){
                    //大于24小时
                    theTime3 = parseInt(theTime2/24);
                    theTime2 = parseInt(theTime2%24);
                }
            }
        }
        var result = '';
        if(theTime > 0){
            result = ""+parseInt(theTime)+"秒";
        }
        if(theTime1 > 0) {
            result = ""+parseInt(theTime1)+"分"+result;
        }
        if(theTime2 > 0) {
            result = ""+parseInt(theTime2)+"小时"+result;
        }
        if(theTime3 > 0) {
            result = ""+parseInt(theTime3)+"天"+result;
        }
        return result;
    }
    function delstep(id,num) {
        var nums = $(".push-data").children().length;
        $.post("<?php echo url('tasks/delStep'); ?>",{id:id},function (res) {
            if(res.code == 0){
                $(".num" + id).remove();
                for(var i=num;i<nums;i++){
                    var step = $('#num' + [i+1]).data('id');
                    $('#num' + [i+1]).html(i);
                    $('#num' + [i+1]).attr('id','num' + i);
                    $('#click' + [i+1]).attr('onclick','delstep(' + step + ',' + i + ')');
                    $('#click' + [i+1]).attr('id','click' + i);
                }
            }else{
                layer.msg(res.msg,{icon:2,time:1000});
            }
        })
    }
</script>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
</body>
</html>