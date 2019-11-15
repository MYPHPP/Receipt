<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/vagrant_www/receipt/public/../application/admin/view/index/welcome.html";i:1571294255;s:61:"/vagrant_www/receipt/application/admin/view/common/blank.html";i:1569067409;}*/ ?>
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
<title>我的桌面</title>
<link type="text/css" rel="stylesheet" href="/static/admin/css/main.css">
</head>
<body onload="modaldemo()">
<section class="title">
	<p>欢迎 <?php echo $data['names']; ?> 使用 <?php echo config('watertext'); ?> ！<button class="btn radius btn-primary size-L gz" onClick="modaldemo()" id="gz">系统使用协议</button></p>
	<p>登录IP：<?php echo $data['last_ip']; ?>  登录次数：<?php echo $data['num']; ?>  登录时间：<?php echo $data['last_login']; ?></p>
</section>
<section class="cards">
	<div class="card card--oil">
		<div class="card__svg-container">
			<div class="card__svg-wrapper">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
					<filter id="goo">
						<fegaussianblur in="SourceGraphic" stdDeviation="10" result="blur"></fegaussianblur>
						<fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
						<feblend in="SourceGraphic" in2="goo"></feblend>
					</filter>
					<circle cx="40" cy="40" r="39" fill="#6a7a87"></circle>
					<g filter="url(#goo)">
						<path id="myTeardrop" fill="#FFFFFF" d="M48.9,43.6c0,4.9-4,8.9-8.9,8.9s-8.9-4-8.9-8.9S40,27.5,40,27.5S48.9,38.7,48.9,43.6z" data-svg-origin="31.100000381469727 27.5" style="transform: matrix(1, 0, 0, 1, 0, 0);"></path>
						<path id="TopInit" fill="#FFFFFF" d="M13,10.8c5-5.3,10.7-8.5,18.3-9.8c11.2-1.8,9.2-1.4,17.6,0C58.3,2.7,66,6,69,13.1V-2.7L13-2.8V10.8z"></path>
						<path id="TopBulb" fill="#FFFFFF" d="M13,10.8c5-5.3,14.8-4,18.3,2.3c4.3,7.7,13.8,7.6,17.6,0c3.4-7,17.1-7.1,20.1,0V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
						<path id="TopBulbSm" fill="#FFFFFF" d="M13,10.8c5-5.3,18.5-14,23.3-8.8c3.6,3.9,3.9,4.5,7.6,0c5-6,22.1,3.9,25.1,11V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
						<path id="TopRound" fill="#FFFFFF" d="M13,10.8c5-5.3,10.6-6,18.3-6.8c6.5-0.7,10.5-0.8,17.6,0C58.4,5.1,66,6,69,13.1V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
					</g>
				</svg>
			</div>
		</div>
		<div class="card__count-container">
			<div class="card__count-text">
				总<span class="card__count-text--big"><?php echo $sys_sum; ?></span> 元
				<p>提现 <?php echo $cash_sum; ?> 元</p>
				<p>用户余 <?php echo $sys_money; ?> 元</p>
			</div>
		</div>
		<div class="card__stuff-container">
			<div class="card__stuff-icon">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 13">
					<path fill="#6a7a87" d="M9.4,2L9.2,2.3v0.4v7.6v0.4L9.4,11H3.6l0.3-0.3v-0.4V2.7V2.3L3.6,2H9.4 M12,1H1l1.8,1.7v7.6L1,12h11l-1.8-1.7V2.7L12,1L12,1z"></path>
					<line fill="none" stroke="#6a7a87" class="st0" x1="3" y1="6.5" x2="10" y2="6.5"></line>
				</svg>
			</div>
			<div class="card__stuff-text">发放佣金</div>
		</div>
	</div>
	<div class="card card--water">
		<div class="card__svg-container">
			<div class="card__svg-wrapper">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
					<circle cx="40" cy="40" r="39" fill="#60cbe7"></circle>
					<g id="waveGroup" data-svg-origin="36.599998474121094 39.949997901916504" style="transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
						<path id="waveTop" fill="#FFFFFF" d="M93,34.1c-3.5,0-5.8-1.1-8.1-4.1h0c-1.6,3-4.9,4.3-8.4,4.3c-3.5,0-6.1-1.3-8.4-4.3h0c-1.6,3-5.1,4.1-8.6,4.1
	c-3.5,0-6.6-2-8.6-4.6v0c-2,2.6-4.5,4.3-8,4.3c-3.5,0-6-1.7-8-4.3v0c-2,2.6-5.1,4.5-8.6,4.5c-3.5,0-6.3-1.1-8.5-4.1h0
	c-1.6,3-4.9,4.3-8.4,4.3C6,34.3,3.3,33,1.1,30h0c-1.6,3-4.5,4.1-8,4.1c-3.5,0-6-2-8-4.6v0c-2,2.6-5.5,4.3-9,4.3c-3.5,0-6-1.7-9-4.3
	v6.6c3,1.5,5.6,2.3,8.6,2.3s6.2-0.9,8.5-2.3c2.2,1.5,5.4,2.3,8.5,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5,2.3,8,2.3s6-0.9,8-2.3v-6.6C100,32.1,96.5,34.1,93,34.1z"></path>
						<path id="waveBot" fill="#FFFFFF" d="M98,46.1c-3.5,0-5.8-1.1-8.1-4.1h0c-1.6,3-4.9,4.3-8.4,4.3c-3.5,0-6.1-1.3-8.4-4.3h0c-1.6,3-5.1,4.1-8.6,4.1
	c-3.5,0-6.6-2-8.6-4.6v0c-2,2.6-4.5,4.3-8,4.3c-3.5,0-6-1.7-8-4.3v0c-2,2.6-5.1,4.5-8.6,4.5c-3.5,0-6.3-1.1-8.5-4.1h0
	c-1.6,3-4.9,4.3-8.4,4.3C11,46.3,8.3,45,6.1,42h0c-1.6,3-4.5,4.1-8,4.1c-3.5,0-6-2-8-4.6v0c-2,2.6-5.5,4.3-9,4.3c-3.5,0-6-1.7-9-4.3
	v6.6c3,1.5,5.6,2.3,8.6,2.3s6.2-0.9,8.5-2.3c2.2,1.5,5.4,2.3,8.5,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.4,2.3,8.4,2.3c3,0,6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3
	c3,0,6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5,2.3,8,2.3s6-0.9,8-2.3v-6.6C105,44.1,101.5,46.1,98,46.1z"></path>
					</g>
				</svg>
			</div>
		</div>
		<div class="card__count-container">
			<div class="card__count-text">
				总<span class="card__count-text--big"><?php echo $order_sum; ?></span>单
				<p>通过<?php echo $order_pass; ?>单</p>
				<p>驳回<?php echo $order_offpass; ?>单</p>
			</div>
		</div>
		<div class="card__stuff-container">
			<div class="card__stuff-icon">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 13">
					<path fill="none" stroke="#6a7a87" d="M1,1.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
					<path fill="none" stroke="#6a7a87" d="M1,5.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
					<path fill="none" stroke="#6a7a87" d="M1,9.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
				</svg>
			</div>
			<div class="card__stuff-text">订单数</div>
		</div>
	</div>
	<div class="card card--tree">
		<div class="card__svg-container">
			<div class="card__svg-wrapper">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
					<circle cx="40" cy="40" r="39" fill="#6abf60"></circle>
					<g id="Branches" data-svg-origin="52 54.29999923706055" style="transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
						<polygon id="topBranches" fill="#FFFFFF" points="40.1,19.8 51.2,43.1 29,43.1" data-svg-origin="40.10000038146973 43.099998474121094" style="transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"></polygon>
						<polygon id="botBranches" fill="#FFFFFF" points="40,28 52,54.3 28,54.3" data-svg-origin="40 54.29999923706055" style="transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"></polygon>
					</g>
					<rect id="Trunk" x="37.7" y="53.8" fill="#FFFFFF" width="4.7" height="6" data-svg-origin="40.05000066757202 59.79999923706055" style="transform-origin: 0px 0px 0px; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);"></rect>
					<rect id="Particle" x="37.9" y="54.3" fill="#FFFFFF" width="2" height="2" data-svg-origin="37.900001525878906 54.29999923706055" style="transform: matrix(1, 0, 0, 1, -10, 4); visibility: hidden; opacity: 0;"></rect>
					<polygon id="Axe" fill="#FFFFFF" points="0.7,5.3 7.3,5.3 7.3,10.2 4,20.3 0.7,10.2" data-svg-origin="4.000000178813934 12.799999713897705" style="transform-origin: 0px 0px 0px; transform: matrix(0.04696, -0.99889, 0.99889, 0.04696, -18.9737, 59.1944);"></polygon>
				</svg>
			</div>
		</div>
		<div class="card__count-container">
			<div class="card__count-text">
				总 <span class="card__count-text--big"><?php echo $order_today; ?></span> 单
				<p>通过<?php echo $order_today_pass; ?>单</p>
				<p>驳回<?php echo $order_today_offpass; ?>单</p>
			</div>
		</div>
		<div class="card__stuff-container">
			<div class="card__stuff-icon">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 13">
					<polygon fill="none" stroke="#6a7a87" points="3.5,1.5 5.5,1.5 5.5,5 9.5,1.5 9.5,9 11,11.5 2,11.5 3.5,9 "></polygon>
				</svg>
			</div>
			<div class="card__stuff-text">今日数据</div>
		</div>
	</div>
	<div class="card card--water">
		<div class="card__svg-container">
			<div class="card__svg-wrapper">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
					<circle cx="40" cy="40" r="39" fill="#60cbe7"></circle>
					<g id="waveGroup" data-svg-origin="36.599998474121094 39.949997901916504" style="transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
						<path id="waveTop" fill="#FFFFFF" d="M93,34.1c-3.5,0-5.8-1.1-8.1-4.1h0c-1.6,3-4.9,4.3-8.4,4.3c-3.5,0-6.1-1.3-8.4-4.3h0c-1.6,3-5.1,4.1-8.6,4.1
	c-3.5,0-6.6-2-8.6-4.6v0c-2,2.6-4.5,4.3-8,4.3c-3.5,0-6-1.7-8-4.3v0c-2,2.6-5.1,4.5-8.6,4.5c-3.5,0-6.3-1.1-8.5-4.1h0
	c-1.6,3-4.9,4.3-8.4,4.3C6,34.3,3.3,33,1.1,30h0c-1.6,3-4.5,4.1-8,4.1c-3.5,0-6-2-8-4.6v0c-2,2.6-5.5,4.3-9,4.3c-3.5,0-6-1.7-9-4.3
	v6.6c3,1.5,5.6,2.3,8.6,2.3s6.2-0.9,8.5-2.3c2.2,1.5,5.4,2.3,8.5,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5,2.3,8,2.3s6-0.9,8-2.3v-6.6C100,32.1,96.5,34.1,93,34.1z"></path>
						<path id="waveBot" fill="#FFFFFF" d="M98,46.1c-3.5,0-5.8-1.1-8.1-4.1h0c-1.6,3-4.9,4.3-8.4,4.3c-3.5,0-6.1-1.3-8.4-4.3h0c-1.6,3-5.1,4.1-8.6,4.1
	c-3.5,0-6.6-2-8.6-4.6v0c-2,2.6-4.5,4.3-8,4.3c-3.5,0-6-1.7-8-4.3v0c-2,2.6-5.1,4.5-8.6,4.5c-3.5,0-6.3-1.1-8.5-4.1h0
	c-1.6,3-4.9,4.3-8.4,4.3C11,46.3,8.3,45,6.1,42h0c-1.6,3-4.5,4.1-8,4.1c-3.5,0-6-2-8-4.6v0c-2,2.6-5.5,4.3-9,4.3c-3.5,0-6-1.7-9-4.3
	v6.6c3,1.5,5.6,2.3,8.6,2.3s6.2-0.9,8.5-2.3c2.2,1.5,5.4,2.3,8.5,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.4,2.3,8.4,2.3s6.1-0.9,8.4-2.3
	c2.2,1.5,5.4,2.3,8.4,2.3c3,0,6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3
	c3,0,6.1-0.9,8.4-2.3c2.2,1.5,5.3,2.3,8.4,2.3s6.1-0.9,8.4-2.3c2.2,1.5,5,2.3,8,2.3s6-0.9,8-2.3v-6.6C105,44.1,101.5,46.1,98,46.1z"></path>
					</g>
				</svg>
			</div>
		</div>
		<div class="card__count-container">
			<div class="card__count-text">
				总 <span class="card__count-text--big"><?php echo $order_stoday; ?></span> 单
				<p>通过<?php echo $order_stoday_pass; ?>单</p>
				<p>驳回<?php echo $order_stoday_offpass; ?>单</p>
			</div>
		</div>
		<div class="card__stuff-container">
			<div class="card__stuff-icon">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 13">
					<path fill="none" stroke="#6a7a87" d="M1,1.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
					<path fill="none" stroke="#6a7a87" d="M1,5.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
					<path fill="none" stroke="#6a7a87" d="M1,9.5c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2c0.9,0,0.9-2,1.8-2c0.9,0,0.9,2,1.8,2s0.9-2,1.8-2"></path>
				</svg>
			</div>
			<div class="card__stuff-text">昨日数据</div>
		</div>
	</div>
	<div class="card card--oil">
		<div class="card__svg-container">
			<div class="card__svg-wrapper">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
					<filter id="goo">
						<fegaussianblur in="SourceGraphic" stdDeviation="10" result="blur"></fegaussianblur>
						<fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
						<feblend in="SourceGraphic" in2="goo"></feblend>
					</filter>
					<circle cx="40" cy="40" r="39" fill="#6a7a87"></circle>
					<g filter="url(#goo)">
						<path id="myTeardrop" fill="#FFFFFF" d="M48.9,43.6c0,4.9-4,8.9-8.9,8.9s-8.9-4-8.9-8.9S40,27.5,40,27.5S48.9,38.7,48.9,43.6z" data-svg-origin="31.100000381469727 27.5" style="transform: matrix(1, 0, 0, 1, 0, 0);"></path>
						<path id="TopInit" fill="#FFFFFF" d="M13,10.8c5-5.3,10.7-8.5,18.3-9.8c11.2-1.8,9.2-1.4,17.6,0C58.3,2.7,66,6,69,13.1V-2.7L13-2.8V10.8z"></path>
						<path id="TopBulb" fill="#FFFFFF" d="M13,10.8c5-5.3,14.8-4,18.3,2.3c4.3,7.7,13.8,7.6,17.6,0c3.4-7,17.1-7.1,20.1,0V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
						<path id="TopBulbSm" fill="#FFFFFF" d="M13,10.8c5-5.3,18.5-14,23.3-8.8c3.6,3.9,3.9,4.5,7.6,0c5-6,22.1,3.9,25.1,11V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
						<path id="TopRound" fill="#FFFFFF" d="M13,10.8c5-5.3,10.6-6,18.3-6.8c6.5-0.7,10.5-0.8,17.6,0C58.4,5.1,66,6,69,13.1V-2.7L13-2.8V10.8z" style="visibility: hidden"></path>
					</g>
				</svg>
			</div>
		</div>
		<div class="card__count-container">
			<div class="card__count-text">
				待审 <span class="card__count-text--big"><?php echo $order_today_onpass; ?></span> 单
				<p>已结算 <?php echo $order_today_money; ?> 元</p>
				<p>待提现 <?php echo $cash_today_onpass; ?> 元</p>
			</div>
		</div>
		<div class="card__stuff-container">
			<div class="card__stuff-icon">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 13">
					<path fill="#6a7a87" d="M9.4,2L9.2,2.3v0.4v7.6v0.4L9.4,11H3.6l0.3-0.3v-0.4V2.7V2.3L3.6,2H9.4 M12,1H1l1.8,1.7v7.6L1,12h11l-1.8-1.7V2.7L12,1L12,1z"></path>
					<line fill="none" stroke="#6a7a87" class="st0" x1="3" y1="6.5" x2="10" y2="6.5"></line>
				</svg>
			</div>
			<div class="card__stuff-text">今日待处理</div>
		</div>
	</div>
</section>
<div class="page-container welfoot">
	<div class="panel panel-danger">
		<div class="panel-header">《<?php echo config('watertext'); ?>》系统服务使用协议</div>
		<div class="panel-body">
			<p><font color="blue" size="3">使用本系统需要遵守法律法规，办理相关资质后方可从事商业活动！</font></p>
			<p><font color="blue" size="3">请推广合法合规产品！</font></p>
			<p><font size="2"><?php echo config('kf_name'); ?>仅提供专业技术支持和服务。在此提醒使用方推广合法合规产品！购买产品乙方对本项目下软件及系统的使用，包括一切经营行为均与<?php echo config('kf_name'); ?>无关，由此所导致的民事纠纷、刑事责任等均由使用运营方自行承担。</font></p>
			<p><font size="2">本系统源码不得未经授权进行二次出售转让以及使用，使用本系统需要遵守法律法规，不得从事非法活动，不得利用应用及服务发表、传送、传播、储存危害国家安全、祖国统一、社会稳定的内容，或侮辱诽谤、色情、暴力、引起他人不安及任何违反国家法律法规政策的内容，违反上述条例带来的相关责任和赔偿由运营者单独承担，与系统开发者无关，并有权收回其授权权利，保留追偿权利！（尊重开发者劳动成果，有问题能解决有保障，请购买正版系统）</font></p></p>
		</div>
	</div>
	<script type="text/javascript" src="/static/admin/mainjs/jquery.min(1).js"></script>
	<script type="text/javascript" src="/static/admin/mainjs/TweenMax.min.js"></script>
	<script type="text/javascript" src="/static/admin/mainjs/index.js"></script>
	<footer class="footer mt-20">
		<div class="container">
			<p>Copyright &copy; 2018-2019 后台管理系统 <?php echo config('version'); ?> All Rights Reserved.<br>
				本后台系统由<a href="/" target="_blank" title="<?php echo config('kf_name'); ?>"><?php echo config('kf_name'); ?></a>提供前端技术支持</p>
		</div>
	</footer>
	<div id="modal-demo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content radius">
				<div class="modal-header">
					<h3 class="modal-title">《<?php echo config('watertext'); ?>》系统服务使用协议</h3>
					<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
				</div>
				<div class="modal-body">
					<p><font color="blue" size="3">使用本系统需要遵守法律法规，办理相关资质后方可从事商业活动！</font></p>
					<p><font color="blue" size="3">请推广合法合规产品！</font></p>
					<p><font size="2">  <?php echo config('kf_name'); ?>仅提供专业技术支持和服务。在此提醒使用方推广合法合规产品！<font color="red">购买产品乙方对本项目下软件及系统的使用，包括一切经营行为均与<?php echo config('kf_name'); ?>无关，由此所导致的民事纠纷、刑事责任等均由使用运营方自行承担</font>。</font></p>
					<p><font size="2">  本系统源码不得未经授权进行二次出售转让以及使用，使用本系统需要遵守法律法规，不得从事非法活动，不得利用应用及服务发表、传送、传播、储存危害国家安全、祖国统一、社会稳定的内容，或侮辱诽谤、色情、暴力、引起他人不安及任何违反国家法律法规政策的内容，违反上述条例带来的相关责任和赔偿由运营者单独承担，与系统开发者无关，并有权收回其授权权利，保留追偿权利！（尊重开发者劳动成果，有问题能解决有保障，请购买正版系统）</font></p></p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">确定</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function modaldemo(){
		$("#modal-demo").modal("show")}
	function modalalertdemo(){
		$.Huimodalalert('我是消息框，2秒后我自动滚蛋！',2000)}
	document.getElementById("gz").onclick();

</script>
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<!--此乃百度统计代码，请自行删除-->

<!--/此乃百度统计代码，请自行删除-->
</body>
</html>