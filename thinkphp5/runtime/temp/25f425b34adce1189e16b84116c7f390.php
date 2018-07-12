<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"./../application/index\view\login\login.html";i:1529918718;s:61:"D:\wo\phpstudy\WWW\thinkphp5\application\index\view\base.html";i:1531313412;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/static/home/css/public.css">
    <link rel="stylesheet" href="/static/home/css/pro_details.css">
    <link rel="stylesheet" href="/static/home/css/simple.css">
    
    <meta charset="UTF-8">
    <title>会员登录</title>
    <script src="/static/home/js/jquery-1.11.2.min.js"></script>
    <script src="/static/home/js/layer/2.4/layer.js"></script>
    <script src="/static/home/js/jquery-migrate-1.2.1.js"></script>
    <script src="/static/home/js/navSelect.js"></script>
    <script src="/static/home/js/register.js"></script>
    <script src="/static/home/js/jquery.SuperSlide.2.1.source.js"></script>
    <script src="/static/home/js/jquery.cookie.js"></script>
    <script src="/static/home/js/jquery.imagezoom.js"></script>
    <script src="/static/home/js/pro_details.js"></script>
    <script src="/static/home/js/navSelect.js"></script>
    <!-- <script src="/static/home/js/localStorge.js"></script> -->

    
    <link rel="stylesheet" href="/static/home/css/login.css">

    <style>
        .shopcart span{
            display: inline;
            color: white;
            position: absolute;
            top: 63px;
            width: 21px;
            height: 19px;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            background-color: red;
        }
    </style>
</head>
<body>
<!--header-->
<div id="header">
    <div class="header_top">
        <div class="top_con clearfix">
            <p>
                <span>你好，欢迎来到德拉斐尔 </span>
               

                <?php if(\think\Session::get('username')!=''): ?>
             
                <span><?php echo \think\Session::get('username'); ?></span>
                 <?php else: ?>
                    <a href="<?php echo url('Login/login'); ?>">请登录</a>
                    <a href="<?php echo url('Registe/registe'); ?>">免费注册</a>
                
                 <?php endif; ?>
                
            </p>
            <ul>
               <?php if(\think\Session::get('username')!=''): ?>
                 <li><a href="<?php echo url('Myorder/myorder'); ?>">我的订单</a></li>
               <?php endif; ?>
               
                <li><i></i><a href="#">企业采购</a></li>
                <li class="nav_select1"><i></i>
                    <span>客户服务</span>
                    <div class="nav_option1">
                        <ul>
                            <li><a href="#">联系我们</a></li>
                            <li><a href="#">线上客服</a></li>
                            <li><a href="#">线下客服</a></li>
                            <li><a href="#">加入我们</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav_select2"><i></i>
                    <span>网站导航</span>
                    <div class="nav_option2">
                        <ul>
                            <li><a href="<?php echo url('/Index/Index/index'); ?>">首页22</a></li>
                            <li><a href="shop_list.html">产品中心</a></li>
                            <li><a href="user.html">会员中心</a></li>
                            <li><a href="register.html">会员注册</a></li>
                            <li><a href="<?php echo url('/Index/Login/logout'); ?>">退出</a></li>
                        </ul>
                    </div>
                </li>
                <li><i></i><a href="#">联系客户</a></li>
            </ul>
        </div>
    </div>
    <div class="header_middle clearfix">
        <a href="index.html"><img src="/static/home/img/logo.png" alt="logo.png"></a>
        <div class="header_center">
            <div class="search clearfix">
                <input type="text" id="search">
                <button class="button"><i></i></button>
            </div>
            <div class="hotwords">
                <a href="<?php echo url('/Index/Index/index'); ?>">3件7折</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">玩具7折</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">婴儿床</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">99减35</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">帮宝适</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">棉服/羽绒服</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">进口奶粉</a>
                <a href="<?php echo url('/Index/Index/index'); ?>">婴儿推车</a>
            </div>
        </div>
        <div class="shopcart">
            <button class="button" onclick="window.location.href='<?php echo url('/Index/Shopcar/shopcar'); ?>'">
            <?php if(\think\Session::get('shopcarnumber')!=''): ?>
             <span class="car_number"><?php echo \think\Session::get('shopcarnumber'); ?></span>
            <?php else: ?>
             <span class="car_number">0</span>

            <?php endif; ?>
            
                <i></i>
                <a href="<?php echo url('/Index/Shopcar/shopcar'); ?>">购物车</a>
            </button>
        </div>
    </div>
    <div class="header_bottom clearfix">
        <div class="bottom_con">
            <div class="select" id="select">
                <span>全部商品分类</span>
                <div class="option" id="option">
                    <ul>
                    <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="navli">
                            <div class="nav_select clearfix">
                                <p><a href="##"><?php echo $vo['name']; ?></a></p>
                                <ul>
                                   <?php if(is_array($vo['next']) || $vo['next'] instanceof \think\Collection || $vo['next'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['next'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;if($key < 3): ?>
                                        <li>
                                            <a href="<?php echo url('/Index/Productcate/read'); ?>?id=<?php echo $voo['id']; ?>"><?php echo $voo['name']; ?></a>
                                        </li>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                                <ul class="tul">
                                    <?php if(is_array($vo['next']) || $vo['next'] instanceof \think\Collection || $vo['next'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['next'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;if($key > 2 and $key < 6): ?>
                                        <li>
                                            <a href="<?php echo url('/Index/Productcate/read'); ?>?id=<?php echo $voo['id']; ?>"><?php echo $voo['name']; ?></a>
                                        </li>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </li>
                        
                     <?php endforeach; endif; else: echo "" ;endif; ?>  
                    </ul>
                </div>
            </div>
            <ul class="top_nav">
                <li><a href="<?php echo url('/Index/index/index'); ?>">首页</a></li>
                <li><a href="<?php echo url('/Index/Index/index'); ?>">秒杀</a></li>
                <li><a href="<?php echo url('/Index/Index/index'); ?>">直邮专区</a></li>
                                <!--Dm= direct mail -->
                <li><a href="<?php echo url('/Index/Index/index'); ?>">品牌专区</a></li>
                <li><a href="<?php echo url('/Index/Index/index'); ?>">会员俱乐部</a></li>
            </ul>
        </div>
    </div>
</div>
<!--header end-->

<div id="middle">
    <div class="content">
        <h1>会员登录</h1>
        <div class="login_top">
            <form action="user.html" method="post" id="new_form">
                <table>
                    <tr>
                        <td>登录名：</td>
                        <td>
                            <input type="text" name="username"/>
                        </td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td>
                            <input type="password" name="password"/>
                        </td>
                    </tr>
                    <tr>
                        <div>
                            <td>验证码：</td>
                        <td class="clearfix">
                            <input type="text" name="code" id="code"/>
                            <a href="#"><img src="<?php echo captcha_src(); ?>" alt="login_code.png" id="isrc" onclick="this.src='<?php echo captcha_src(); ?>'"></a>
                            <a href="javascript:;" onclick="document.getElementById('isrc').setAttribute('src','<?php echo captcha_src(); ?>');" class="code">看不清，换一张</a>
                        </td>
                        </div>
                        
                    </tr>
                    <tr>
                        <td colspan="2" class="submit clearfix">
                            <input type="button" value="登录" id="submit" onclick="login()">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="td_last">
                            <a href="#">忘记密码？</a>
                            <a href="<?php echo url('Registe/registe'); ?>">免费注册</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="login_bottom">
            <p>合作伙伴账户登录：</p>
            <ul class="clearfix">
                <li>
                    <a href="#"><img src="/static/home/img/login_bottom1.png" alt="login_bottom1.png"></a>
                    <a href="#" class="partner">QQ登录</a>
                </li>
                <li>
                    <a href="#"><img src="/static/home/img/login_bottom2.png" alt="login_bottom2.png"></a>
                    <a href="#" class="partner">微信登录</a>
                </li>
                <li>
                    <a href="#"><img src="/static/home/img/login_bottom3.png" alt="login_bottom3.png"></a>
                    <a href="#" class="partner">支付宝登录</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
     function login()
        {
            // alert(22);
            // var data = new FormData($("#new_form")[0]);
            var data={

                'username':$("[name='username']").val(),
                'password':$("[name='password']").val(),
                'code':$("[name='code']").val()
            }
            // console.log(data);
            $.ajax({
            url:"<?php echo url('Login/login'); ?>",
            type:'post',
            data:data,
            dataType:'json',
            success:function(data){
//                console.log(data);
                if (data.code == 1) {
                    layer.msg(data.msg, {icon:1,time:1000,btn:['确定']},function(){setTimeout(window.location.href=data.url,3000 )}
                    )
                }else{
                    layer.msg(data.msg, {icon:2,time:6000,btn:['确定']});
                    document.getElementById('isrc').setAttribute('src','<?php echo captcha_src(); ?>')
                };

            }
        })
        }
</script>

<!--footer-->
<div id="footer">
    <div class="footer_top">
        <ul class="clearfix">
            <li>
                <img src="/static/home/img/footer_top1.png" alt="footer_top1.png">
                <h6>品质</h6>
            </li>
            <li>
                <img src="/static/home/img/footer_top2.png" alt="footer_top2.png">
                <h6>便捷</h6>
            </li>
            <li>
                <img src="/static/home/img/footer_top3.png" alt="footer_top3.png">
                <h6>专业</h6>
            </li>
            <li>
                <img src="/static/home/img/footer_top4.png" alt="footer_top4.png">
                <h6>贴心</h6>
            </li>
        </ul>
    </div>
    <div class="footer_middle clearfix">
        <dl>
            <dt><a href="#">购买指南</a></dt>
            <dd><a href="#">购物流程</a></dd>
            <dd><a href="#">常见问题</a></dd>
            <dd><a href="#">优惠码（卷）</a></dd>
        </dl>
        <dl>
            <dt><a href="#">支付方式</a></dt>
            <dd><a href="#">在线支付</a></dd>
        </dl>
        <dl>
            <dt><a href="#">配送方式</a></dt>
            <dd><a href="#">运费及时效</a></dd>
            <dd><a href="#">品牌专场配送方式</a></dd>
        </dl>
        <dl>
            <dt><a href="#">售后服务</a></dt>
            <dd><a href="#">退换货原则</a></dd>
            <dd><a href="#">退换货流程</a></dd>
            <dd><a href="#">退换货周期</a></dd>
            <dd><a href="#">品牌专场售后政策</a></dd>
        </dl>
        <dl>
            <dt><a href="#">关于我们</a></dt>
            <dd><a href="#">企业理念</a></dd>
            <dd><a href="#">网站合作</a></dd>
            <dd><a href="#">人才招聘</a></dd>
            <dd><a href="#">关于我们</a></dd>
        </dl>
        <dl>
            <dt><a href="#">联系我们</a></dt>
            <dd><a href="#">新浪微博</a></dd>
            <dd><a href="#">联系客服</a></dd>
            <dd><a href="#">我要投诉</a></dd>
        </dl>
        <div class="footer_code">
            <img src="/static/home/img/footer_code.png" alt="footer_code.png">
        </div>
    </div>
    <div class="footer_bottom">
        <p>Copyright © 2004 - 2016  德拉斐尔DLFE.com版权所有</p>
    </div>
</div>
<!--footer end-->
</body>

 

</html>