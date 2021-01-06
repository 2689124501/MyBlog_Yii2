<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '个人信息页~';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>221801310钟煜新的超简陋个人主页！</title>
	<link rel="stylesheet" href="css.css">
</head>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div style="color: aquamarine;">
		<nav>
			&nbsp;&nbsp;&nbsp;
			<a href="page2.html" target="_blank">我的主页2</a>&nbsp;|
			<sub>友情链接：</sub>
			<a href="https://www.bilibili.com/" target="_blank">bilibili视频网站</a>&nbsp;|
		</nav>
	</div>
	<hr />
	<!-- 第一面版 -->
	<div id="page1">
		<div>
			<h1 style="color: aquamarine;">个人信息页</h1><br />
		</div>
		<div>
			<div id="introduce">
				<table title="关于我" id="table">
					<caption>关于我~</caption>
					<tr>
						<th>我的名字是</th>
						<td>钟煜新</td>
					</tr>
					<tr>
						<th>我来自</th>
						<td>福建泉州</td>
					</tr>
					<tr>
						<th>我目前就读于</th>
						<td><a href="https://www.fzu.edu.cn/">福州大学</a></td>
					</tr>
					<tr>
						<th>我的学号</th>
						<td>221801310</td>
					</tr>
					<tr>
						<th>我的学院</th>
						<td> <a href="http://cmcs.fzu.edu.cn/website/f">数学与计算机科学学院</a></td>
					</tr>
					<tr>
						<th>我的专业</th>
						<td>软件工程</td>
					</tr>
					<tr>
						<th rowspan="10">最近喜欢的十首歌：</th>
						<td rowspan="10">
							<ul>
								<li><a href="page2.html">可惜没如果 - 林俊杰</a></li>						
								<li>领悟(Live) - 林俊杰</li>
								<li>信仰 - 是你的垚</li>
								<li>会不会（吉他版）- 刘大壮</li>
								<li>后来 - 刘若英</li>
								<li>Can't get you out of my head - Glimmer of blooms</li>
								<li>Everybody knows I Love You - Lovebugs</li>
								<li>慢慢喜欢你 - 莫文蔚</li>
								<li>男孩 - 梁博</li>
								<li>7 Years - Lukas Graham</li>
							</ul>
						</td>
					</tr>
				</table>
			</div>
			<div id="image">
				<img src="https://pic1.zhimg.com/v2-c1453b3fb9068c3387902d2d5ec2af6b_r.jpg?source=1940ef5c" alt="林俊杰">
			</div>
		</div>
	</div>	
	</div>
  
</div>
