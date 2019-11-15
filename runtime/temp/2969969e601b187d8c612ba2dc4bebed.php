<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/vagrant_www/receipt/public/../application/admin/view/tasks/task-list.html";i:1569120571;s:61:"/vagrant_www/receipt/application/admin/view/common/blank.html";i:1569067409;s:62:"/vagrant_www/receipt/application/admin/view/common/footer.html";i:1540627322;}*/ ?>
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

<![endif]-->
<title>任务管理 - 初创网络</title>
<style>
    .list_order{
        height: 24px!important;
        line-height: 24px!important;
        border: #FC6 solid 1px!important;
    }
</style>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span>
    任务管理 <span class="c-gray en">&gt;</span>
    任务列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
    <i class="Hui-iconfont">&#xe68f;</i>
</a>
</nav>
<div class="page-container">
    <div class="text-c">
        日期范围：
        <input type="text" id="logmin" name="logmin" class="input-text Wdate" style="width:120px;" readonly="">
        -
        <input type="text" id="logmax" name="logmax" class="input-text Wdate" style="width:120px;" readonly="">
        <input type="text" class="input-text" style="width:250px" placeholder="输入任务ID，名称，标题" id="keyword" name="keyword">
        <button type="button" class="btn btn-success radius" id="search" name="search"><i class="Hui-iconfont">&#xe665;</i> 搜任务</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:;" onclick="cc_add('添加任务','<?php echo url("admin/tasks/addTask"); ?>','900','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe604;
        </i> 添加任务</a>
        </span>
    </div>
    <div class="mt-20">
        <table class="layui-table" id="list" lay-filter="list"></table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<link href="/static/lib/layui/css/layui.css" rel="stylesheet">
<script type="text/javascript" src="/static/lib/layui/layui.js"></script>
<script type="text/html" id="open">
    <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="启用|禁用" lay-filter="open" {{ d.status == 0 ? 'checked' : '' }}>
</script>
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10"/>
</script>
<script type="text/html" id="action">
    <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="info">二维码</a>
    <a href="javascript:;" onclick="cc_edit('编辑','<?php echo url("admin/tasks/editTask"); ?>?id={{d.id}}','4','900','600')" class="btn btn-primary size-MINI radius">编辑</a>
    <a class="btn btn-warning size-MINI radius" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table','form','laydate'], function() {
        var table = layui.table,form = layui.form,$ = layui.jquery, laydate = layui.laydate;
        //日期范围
        laydate.render({
            elem: '#logmin'
            ,type: 'date'
            ,done: function(value, date, startDate){
            }
        });
        laydate.render({
            elem: '#logmax'
            ,type: 'date'
            ,done: function(value, date, endDate){
            }
        });
        var tableIn = table.render({
            id: 'product',
            elem: '#list',
            url: '<?php echo url("index"); ?>',
            method: 'post',
            cellMinWidth: 80,
            totalRow: true,
            page:true,
            cols: [[
                {field: 'id', title: '序号', width: 80, fixed: true},
                {field: 'tname', title: '任务类别', width:100, align: 'center'},
                {field: 'name', title: '任务名称' , align: 'center'},
                {field: 'title', title: '任务标题', align: 'center'},
                {field: 'remark', title: '任务说明', align: 'center'},
                {field: 'price', title: '单价', width:100, align: 'center'},
                {field: 'number', align: 'center', width:100 ,title: '任务数量', totalRow: true},
                {field: 'jnum', align: 'center',  width:120 ,title: '接单人数', totalRow: true},
                {field: 'add_time', align: 'center', width:200, title: '创建时间'},
                {field: 'uid', align: 'center', width:100, title: '发布人ID'},
                {field: 'sort', align: 'center', width:100, title: '排序', toolbar: '#order'},
                {field: 'status', align: 'center', width:100, title: '状态', toolbar: '#open'},
                {width: 160, align: 'center', toolbar: '#action'}
            ]],
            limit:90
        });
        //搜索
        $('#search').on('click', function () {
            var keyword = $('#keyword').val();
            var logmin = $('#logmin').val();
            var logmax = $('#logmax').val();

            tableIn.reload({ page: {page: 1}, where: {keyword: keyword,logmin:logmin,logmax:logmax}});
        });
        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'del'){
                var type = 'task';
                layer.confirm('您确定要删除该订单吗？', function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('admin/system/del'); ?>",{id:data.id,type:type},function(res){
                        layer.close(loading);
                        if(res.code == 0){
                            layer.msg(res.msg,{time:1000,icon:1});
                            tableIn.reload();
                        }else{
                            layer.msg('操作失败！',{time:1000,icon:2});
                        }
                    });
                    layer.close(index);
                });
            }else if (obj.event === 'info'){
                var out = '<img src="/admin/system/enQrcode?tid=' + data.id + '"';
                layer.open({
                    offset: 'auto',
                    title:'获取二维码',
                    content: out,
                })
            }
        });
        form.on('switch(open)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var status = obj.elem.checked===true?0:1;
            $.post('<?php echo url("system/update"); ?>',{id:id,status:status,type:'task'},function (res) {
                layer.close(loading);
                if (res.code == 0) {
                    layer.msg(res.msg,{time:1000,icon:1});
                    tableIn.reload();
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    return false;
                }
            })
        });
        $('body').on('blur','.list_order',function() {
            var id = $(this).attr('data-id');
            var sort = $(this).val();
            var loading = layer.load(1, {shade: [0.1, '#fff']});
            $.post('<?php echo url("system/update"); ?>',{id:id,sort:sort,type:'task'},function(res){
                layer.close(loading);
                if(res.code == 0){
                    layer.msg(res.msg, {time: 1000, icon: 1});
                    tableIn.reload();
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                }
            })
        });
    })
    /*产品-添加*/
    function cc_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*产品-编辑*/
    function cc_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
</script>
</body>
</html>