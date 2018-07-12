<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"./../application/index\view\base.html";i:1531313412;}*/ ?>
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