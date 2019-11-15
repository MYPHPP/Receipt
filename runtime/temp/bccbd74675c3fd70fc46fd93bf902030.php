<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:70:"/vagrant_www/receipt/public/../application/admin/view/index/index.html";i:1569090831;s:61:"/vagrant_www/receipt/application/admin/view/common/blank.html";i:1569067409;s:62:"/vagrant_www/receipt/application/admin/view/common/header.html";i:1569090782;s:60:"/vagrant_www/receipt/application/admin/view/common/menu.html";i:1540627322;s:62:"/vagrant_www/receipt/application/admin/view/common/footer.html";i:1540627322;}*/ ?>
﻿﻿<!DOCTYPE HTML>
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
<title><?php echo config('kf_name'); ?> - 初创网络 - v1.0.0</title>
<meta name="keywords" content="<?php echo config('kf_name'); ?> - <?php echo config('sys_name'); ?> - <?php echo config('version'); ?>">
<meta name="description" content="<?php echo config('kf_name'); ?> - <?php echo config('sys_name'); ?>">
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl">
			<a class="logo navbar-logo f-l mr-10 hidden-xs" href="/"><?php echo config('kf_name'); ?> - <?php echo config('sys_name'); ?></a>
			<a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/"><?php echo config('kf_name'); ?></a>
			<span class="logo navbar-slogan f-l mr-10 hidden-xs"><?php echo config('version'); ?></span>
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<!--nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
			</nav-->
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li id="Hui-msg"> <a href="/" target="_blank" title="查看站点"><i class="Hui-iconfont" style="font-size:18px">&#xe625;</i></a></li>
					<li><a href="javascript::void(0)" onclick="clearPhp(this)" data-GetUrl="<?php echo url('admin/base/clear'); ?>"><i class="Hui-iconfont">&#xe609;</i>清空缓存</a></li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo $admin; ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="<?php echo url('admin/login/loginout'); ?>">退出</a></li>
						</ul>
					</li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<script>
	function clearPhp(obj) {
		var url=obj.getAttribute('data-GetUrl');
		//询问框
		layer.confirm('您确定要清除吗？', {
					btn: ['确定','取消'] //按钮
				},
				function(){
					$.get(url,function(info){
						console.log(info);
						if(info.code === 1){
							setTimeout(function () {location.href = info.url;}, 1000);
						}
						layer.msg(info.msg);
					});
				});
	}
</script>

<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<?php if(is_array($menuInfo) || $menuInfo instanceof \think\Collection || $menuInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $menuInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont"><?php echo $vo['ico']; ?></i> <?php echo $vo['name']; ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<?php if(!empty($vo['cmenu']) == true): if(is_array($vo['cmenu']) || $vo['cmenu'] instanceof \think\Collection || $vo['cmenu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['cmenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
					<li><a data-href="<?php echo url($vv['url']); ?>" data-title="<?php echo $vv['name']; ?>" href="javascript:void(0)"><?php echo $vv['name']; ?></a></li>
					<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</ul>
			</dd>
		</dl>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="welcome.html">我的桌面</span>
					<em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo url('admin/index/welcome'); ?>"></iframe>
		</div>
	</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
	</ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">

	/*个人信息*/
	function myselfinfo(){
		layer.open({
			type: 1,
			area: ['300px','200px'],
			fix: false, //不固定
			maxmin: true,
			shade:0.4,
			title: '查看信息',
			content: '<div>管理员信息</div>'
		});
	}

	/*资讯-添加*/
	function article_add(title,url){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	/*图片-添加*/
	function picture_add(title,url){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	/*产品-添加*/
	function product_add(title,url){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	/*用户-添加*/
	function member_add(title,url,w,h){
		layer_show(title,url,w,h);
	}


</script>

<!--此乃百度统计代码，请自行删除-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})();
</script>
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>