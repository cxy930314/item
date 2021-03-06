<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>orderInfo</title>
		<link rel="stylesheet" type="text/css" href="css/orderInfo.css" />
		<link rel="stylesheet" type="text/css" href="css/cityLayout.css" />
		<script src="js/angular.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/cityselect.js"></script>
		<!--<script>
			/* 用途: 接收地直栏参数 取id=1 根据ID的值 */
			urlinfo = window.location.href; //获取当前页面的url
			len = urlinfo.length; //获取url的长度
			offset = urlinfo.indexOf("?"); //设置参数字符串开始的位置
			newsidinfo = urlinfo.substr(offset, len) //取出参数字符串 这里会获得类似“id=1”这样的字符串
			newsids = newsidinfo.split("&"); //对获得的参数字符串按照“=”进行分割
			newsid = newsids[1]; //得到参数值
			newsname = newsids[0]; //得到参数名字
			newsids = newsid.split("=");
			newsname = newsname.split("=");
			console.log(newsids[1]);
			console.log(newsname[1]);
		</script>-->
	</head>

	<body ng-app="zxx" ng-controller="zxxController">
		<div class="orderBox">
			<div class="order1">
				<div class="order1_1">
					<a href="#">
						<img class="logo" src="img/logo.jpg" />
					</a>
				</div>
				<div class="order1_2">
					<a href="php/login.php">登录</a> |
					<a href="register.html">注册会员</a> |
					<a href="#">注销</a>
					<a href="index.html">网站首页</a> |
					<a href="#">帮助中心</a>
				</div>
			</div>
			<div class="order2">
				<img src="img/buyliucheng2.gif" />
			</div>
			<div class="order3">
				<strong>收货人信息</strong>
				<span>(带*号为必填项)</span>
			</div>
			<?php
					include_once("php/common.php");
					session_start();
					$userId="";
					if(isset($_SESSION["userId"])){
						$userId=$_SESSION["userId"];
					}
					$query = "select * from user where userId = '$userId'";
					$result = mysql_query($query);
					if(mysql_num_rows($result)==1){
						$row = mysql_fetch_assoc($result);
					}
				?>
			<div class="order4"><?php echo $row["name"];?><?php echo $row["address"];?><?php echo $row["street"];?></div>
		
			<div class="order5">
				<a onclick="openShutManager(this,'box2')" style="cursor: pointer;">
					<img src="img/jiantou2.gif" width="4" height="7" border="0">
					<span>请输入您的收货地址</span>
				</a>
			</div>

			<form name="shouhuoxxc" method="post" action="php/orderInfo_server.php">
				<div class="order6" id="box2" style="display:block">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12%" height="35" align="right"><span class="order6_1">*</span>收货人姓名：</td>
							<td width="88%" height="35">
								<input name="userid2" type="hidden" value="250911">
								<input type="text" name="name" id="name" class="inputcss" style="width:220px; height: 25px;" /></td>
						</tr>
						<tr>
							<td height="35" align="right"><span class="order6_1">*</span>收货地址：</td>
							<td height="35">
								<input name="sell" id="sel1" type="text" class="city_input" readonly="readonly" style="width:220px;height: 25px;">
							</td>
						</tr>
						<tr>
							<td height="35" align="right"><span class="order6_1">*</span>街道：</td>
							<td height="35"><input type="text" name="sjadd" id="textfield2" class="inputcss" style="width:220px;height: 25px;" /></td>
						</tr>
						<tr>
							<td height="35" align="right"><span class="order6_1">*</span>收货人手机：</td>
							<td height="35"><input type="text" name="mobile" id="textfield4" class="inputcss" style="width:220px;height: 25px;" /></td>
						</tr>
						<tr>
							<td height="35" align="right">固定电话：</td>
							<td height="35"><input type="text" name="phone2" id="textfield3" class="inputcss" style="width:220px;height: 25px;" /></td>
						</tr>
						<tr>
							<td height="35" align="right"></td>
							<td height="35"><input class="go-wenbenkuang" type="submit" name="Submit42" value="提交地址" onclick='subAddress();'> </td>
						</tr>
					</table>
				</div>
			</form>
			<div class="order7">
				<div class="order7_1">
					<strong>送货方式</strong>
				</div>
				<div class="order7_2">
					<input name="" type="radio" value="" checked="checked" />快递<span>（中通、宅急送、申通、圆通、EMS、 等，我们会根椐您的地址为您发最快的送货物流公司） </span>
				</div>
			</div>
			<div class="order8">
				<div class="order8_1">
					<strong>付款方式</strong>
				</div>
				<div class="order8_2">
					<input name="" type="radio" value="" checked="checked" />网上付款
				</div>
			</div>
			<div class="order9">
				<div>
					<strong>购物清单</strong>
				</div>
				<div style="text-align: right;float: right;font-size: 18px;color: blue;" ng-click="back()">
					<a href="#">
						<<<返回购物车</a>
				</div>
			</div>
			<div class="order10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13%" height="35" align="center" valign="middle" class="order10_1">图片</td>
						<td width="39%" valign="middle" class="order10_1">商品名称</td>
						<td width="15%" align="center" valign="middle" class="order10_1">单品优惠券</td>
						<td width="9%" align="center" valign="middle" class="order10_1">单价</td>
						<td width="9%" align="center" valign="middle" class="order10_1">返现/优惠</td>
						<td width="7%" align="center" valign="middle" class="order10_1">数量</td>
						<td width="8%" align="center" valign="middle" class="order10_1">小计</td>
					</tr>
					<tr ng-repeat="x in orderinfoArr">
						<td width="13%" align="center" valign="middle" class="buy3_1"><img ng-src="{{x.smallImg}}" style="width: 50px;height: 50px;margin-top: 7px;" /></td>
						<td width="39%" valign="middle" class="order10_1">{{x.productName}}</td>
						<td width="15%" align="center" valign="middle" class="order10_1">---</td>
						<td width="9%" align="center" valign="middle" class="order10_1">￥{{x.currentPrice}}</td>
						<td width="9%" align="center" valign="middle" class="order10_1">{{x.fanxian}}</td>
						<td width="7%" align="center" valign="middle" class="order10_1">{{x.shuliang}}</td>
						<td width="8%" align="center" valign="middle" class="order10_1">{{x.sum}}</td>
					</tr>
				</table>
			</div>
			<div class="order11">
				<div class="order11_1">
					<div class="order11_1_1">
						<strong>使用优惠券：</strong>(
						<a id="ticket" onclick="openTicket()" style="cursor:pointer">你有优惠券请到这里激活</a> )
					</div>
					<div class="order11_1_2" id="box" style="display:none">
						券号：<input type="text" name="cardid" id="textfield4" class="inputcss" style="width:100px; height:20px; padding-bottom:0px; line-height:20px;" /> 密码：
						<input type="text" name="carpws" id="textfield4" class="inputcss" style="width:50px; height:20px; padding-bottom:0px; line-height:20px;" />
						<input name="" type="button" value="激活使用" onFocus="this.blur()" onClick="this.form.action='?action=jh';this.form.submit()" />
					</div>
					<div class="order11_1_3"><strong><span class="font14">留言</span></strong></div>
					<div class="order11_1_4">
						<textarea name="liuyan" id="liuyan" class="inputcss" style="width:300px; height:60px;"></textarea>
					</div>
				</div>
				<div class="order11_1_2" style="float:right; width:400px; font-size:12px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="72%" height="28" align="right">商品金额总计:</td>
							<td width="28%" height="28" align="right" class="w009dce" style="font-size: 16px;"><strong>￥{{gettotal(orderinfoArr)}}</strong></td>
						</tr>
						<tr>
							<td height="14" align="right">赠送积分:</td>
							<td height="28" align="right">{{gettotal(orderinfoArr)}}</td>
						</tr>
						<tr>
							<td height="28" align="right">商城返现/优惠：</td>
							<td height="14" align="right"><span class="cff4500 font14">0</span>元</td>
						</tr>
						<tr>
							<td height="28" align="right">运费：</td>
							<td height="28" align="right"><span class="cff4500 font14"><strong>+0</strong></span>元</td>
						</tr>
						<tr>
							<td height="28" align="right">优惠券：</td>
							<td height="28" align="right"><span class="cff4500 font14"><strong>-0元</strong></span></td>
						</tr>
						<tr>
							<td height="28" align="right">您需支付：</td>
							<td height="28" align="right"><span class="cff4500" style="font-size:24px; font-weight:bold;">{{gettotal(orderinfoArr)}}</span></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="dingdan" style="text-align: right;">
				<input type="image" name="" id="" value="" src="img/buy_btn2.jpg" />
			</div>
			<div class="order12">
				<div>
					<span>Copyright 2016</span>
					<a href="#">一优品</a>
					<span> All Rights Reserved </span>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</body>
	<script src="js/JQuery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(function() {
			init_city_select($("#sel1"));
		});
		var num = 0;

		function openTicket() {
			num++;
			if(num % 2 == 1) {
				$("#box").css('display', 'block');
			} else if(num % 2 == 0) {
				$("#box").css('display', 'none');
			}
		}
		function openShutManager(){
			num++;
			if(num%2==1){
				$("#box2").hide();
			}else{
				$("#box2").show();
			}
		}
	</script>
	<script>
	var app = angular.module("zxx", []);
	app.controller("zxxController", function($scope, $http) {
		$http({
				method: "get",
				url: "php/orderinfo_sql.php",
			}).success(function(data) {
				console.log(data)
				$scope.orderinfoArr = data;
			});

	 $scope.gettotal = function(argu) {
				var total = 0;
				for(var i = 0; i < argu.length; i++) {
					total += parseInt(argu[i].sum);
				}
				return total;
			}
//    $scope.back=function(){
//		  $.ajax({
//			type:"get",
//			url:"php/car_back.php",
//			dataType:"json",
//			success:function(data){
//				console.log(data);
//			},
//			error:function(errors){
//				console.log("失败")
//			},
//		  async:true
//       });
//		}
		

		})
	</script>

</html>