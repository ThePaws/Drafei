<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./../application/index\view\base.html";i:1531313412;s:44:"./../application/index\view\index\index.html";i:1531219195;s:61:"D:\wo\phpstudy\WWW\thinkphp5\application\index\view\base.html";i:1531313412;}*/ ?>
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

    
<link rel="stylesheet" href="/static/home/css/index.css">

  

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

<div id="slideBox" class="slideBox">
    <div class="hd">
        <ul>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="bd">
        <ul>
            <li><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/banner.png" /></a></li>
            <li><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=2"><img src="/static/home/img/banner1.png" /></a></li>
            <li><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=3"><img src="/static/home/img/banner2.png" /></a></li>
        </ul>
    </div>
</div>

<script>
    $(function (){
          $(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
    })

</script> 
  
    <div id="middle">
        <div class="latest_product">
            <div class="latest_top clearfix">
                <h1>最新商品</h1>
                <span>Latest product</span>
                <a href="shop_list.html">more</a>
            </div>
            <div class="latest_content clearfix">
                <div class="latest_left">
                    <ul class="pic">
                      <?php if(is_array($subBanner) || $subBanner instanceof \think\Collection || $subBanner instanceof \think\Paginator): $i = 0; $__LIST__ = $subBanner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key < 3): ?>
                        <li><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=<?php echo $vo['p_id']; ?>"><img src="<?php echo $vo['path']['0']['path']; ?>"/ style="width:575px;height:522px;"></a></li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul class="pro_hd clearfix">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <script type="text/javascript">
                    $(function (){
                        jQuery(".latest_left").slide({ mainCell:".pic",titCell:".pro_hd li",effect:"left", autoPlay:true, delayTime:300});
                    });
                    </script>
                </div>
                <div class="latest_right">
                    <ul class="clearfix">
                    <?php if(is_array($subBanner) || $subBanner instanceof \think\Collection || $subBanner instanceof \think\Paginator): $i = 0; $__LIST__ = $subBanner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key >2 and $key < 5): ?>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=<?php echo $vo['p_id']; ?>"><img src="<?php echo $vo['path']['0']['path']; ?>"/ style="width:294px;height:521px;"></a>
                            <div class="details" onclick="window.location.href='pro_details.html'">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><?php echo $vo['p_name']; ?></a></p>
                                <h2>¥<?php echo $vo['show_price']; ?></h2>
                            </div>
                        </li>
                         <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>

            </div>
            <div class="latest_bottom">
                <ul class="clearfix">
                 <?php if(is_array($subBanner) || $subBanner instanceof \think\Collection || $subBanner instanceof \think\Paginator): $i = 0; $__LIST__ = $subBanner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key >4): ?>
                    <li style="text-overflow:ellipsis;width:231px;">
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=<?php echo $vo['p_id']; ?>"><img src="<?php echo $vo['path']['0']['path']; ?>" alt="index_latest_pro1.png" style="width:231px;height:260px;"></a>
                        <p class="margin_p"><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=<?php echo $vo['p_id']; ?>"><?php echo $vo['p_name']; ?></a></p>
                        <p class="clearfix"><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=<?php echo $vo['p_id']; ?>"><span>¥ <?php echo $vo['show_price']; ?></span></a></p>
                    </li>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="hot_product">
            <div class="hot_top clearfix">
                <h1>热门产品</h1>
                <span>Hot product</span>
                <a href="shop_list.html">more</a>
            </div>
            <div class="hot_content">
                <ul class="clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_img1.png" alt="index_hot_img1.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_img2.png" alt="index_hot_img2.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_img3.png" alt="index_hot_img3.png"></a>
                    </li>
                </ul>
            </div>
            <div class="hot_bottom">
                <ul class="bottom_top clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro1.png" alt="index_hot_pro1.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">美素佳儿----
                                荷兰原装进口</a></p>
                            <span>¥185.00</span>
                            <p>58501人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro2.png" alt="index_hot_pro2.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">好奇--------
                                尿不湿</a></p>
                            <span>¥399.00</span>
                            <p>28055人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro3.png" alt="index_hot_pro3.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立健--------
                                婴儿布书</a></p>
                            <span>¥45.00</span>
                            <p>388人</p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro4.png" alt="index_hot_pro4.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">贝丽可------
                                婴儿推车</a></p>
                            <span>¥389.00</span>
                            <p>1286人</p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro5.png" alt="index_hot_pro5.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">巴拉巴拉男童
                                女童羽绒服</a></p>
                            <span>¥219.00</span>
                            <p>590人</p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro6.png" alt="index_hot_pro6.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">尚恩宽口玻璃
                                奶瓶180ml</a></p>
                            <span>¥99.00</span>
                            <p>1590人</p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro7.png" alt="index_hot_pro7.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">德国儿童汽车安全座椅</a></p>
                            <span>¥1780.00</span>
                            <p>2480人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro8.png" alt="index_hot_pro8.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">童佳贝贝多功能婴儿餐椅</a></p>
                            <span>¥399.00</span>
                            <p>1070人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro9.png" alt="index_hot_pro9.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">费雪--------早教益智玩具</a></p>
                            <span>¥269.00</span>
                            <p>2954人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro10.png" alt="index_hot_pro10.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">康贝方------新生儿衣服</a></p>
                            <span>¥144.00</span>
                            <p>1030人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro11.png" alt="index_hot_pro11.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">安儿乐------纸尿裤</a></p>
                            <span>¥102.00</span>
                            <p>46691人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_hot_pro12.png" alt="index_hot_pro12.png"></a>
                        <div class="hot_pro_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">泰迪熊幼儿绘本故事书</a></p>
                            <span>¥96.00</span>
                            <p>594人 </p>
                            <p>已购买</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pick">
            <div class="pick_top clearfix">
                <h1>推荐商品</h1>
                <span>Pick of the week</span>
                <a href="shop_list.html">more</a>
            </div>
            <div class="pick_content">
                <ul class="content_top clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img1.png" alt="index_pick_img1.png"></a>
                        <div class="content_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">喜朗 婴儿手口湿巾80片带盖X9包宝宝柔棉湿纸巾</a></p>
                            <span>¥398.00</span>
                            <p>638人已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img2.png" alt="index_pick_img2.png"></a>
                        <div class="content_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">雀巢 （Nestle）NIDO速溶全脂高钙调制乳粉900g荷兰</a></p>
                            <span>¥119.00</span>
                            <p>182人已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img3.png" alt="index_pick_img3.png"></a>
                        <div class="content_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">Pigeon/贝亲 玻璃 奶瓶 奶粉盒 奶嘴 奶瓶刷 保温袋 婴儿 礼盒 新生儿礼盒 礼盒套装 OA07 </a></p>
                            <span>¥288.00</span>
                            <p>928人已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img4.png" alt="index_pick_img4.png"></a>
                        <div class="content_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">哈罗闪Sanosan德国原装礼盒7件套婴儿洗护用品套装洗发沐浴露二合一爽身粉</a></p>
                            <span>¥248.00</span>
                            <p>503人已购买</p>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img5.png" alt="index_pick_img5.png"></a>
                        <div class="content_right">
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">英国原装进口Britax宝得适 汽车儿童安全座椅头等舱白金版适合0-18kg(约0-4岁) 皇室蓝</a></p>
                            <span>¥1880.00</span>
                            <p>918人已购买</p>
                        </div>
                    </li><li>
                    <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_pick_img6.png" alt="index_pick_img6.png"></a>
                    <div class="content_right">
                        <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">慕倩秋冬季三层夹棉月子服孕妇哺乳睡衣家居服产后外出喂奶哺乳衣套装   </a></p>
                        <span>¥329.00</span>
                        <p>169人已购买</p>
                    </div>
                </li>

                </ul>
            </div>
        </div>
        <div class="explosive">
            <div class="explosive_top clearfix">
                <h1>爆款推荐商品</h1>
                <span>Explosive recommended products</span>
                <a href="shop_list.html">more</a>
            </div>
            <div class="explosive_content">
                <ul class="exp_top clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_img1.png" alt="index_explosive_img1.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small1.png" alt="index_explosive_small1.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥129.00</span>
                            <i>¥ 299.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small2.png" alt="index_explosive_small2.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥139.00</span>
                            <i>¥ 358.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small3.png" alt="index_explosive_small3.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥89.00</span>
                            <i>¥ 198.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small4.png" alt="index_explosive_small4.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥119.00</span>
                            <i>¥ 328.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                </ul>
                <ul class="exp_middle clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_img2.png" alt="index_explosive_img2.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small5.png" alt="index_explosive_small5.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥142.00</span>
                            <i>¥ 217.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small6.png" alt="index_explosive_small6.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥65.00</span>
                            <i>¥ 108.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small7.png" alt="index_explosive_small7.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥84.00</span>
                            <i>¥ 119.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small8.png" alt="index_explosive_small8.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥84.00</span>
                            <i>¥ 119.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                </ul>
                <ul class="exp_foot clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_img3.png" alt="index_explosive_img3.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small9.png" alt="index_explosive_small9.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥198.00</span>
                            <i>¥ 328.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small10.png" alt="index_explosive_small10.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥36.00</span>
                            <i>¥ 78.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small11.png" alt="index_explosive_small11.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥88.00</span>
                            <i>¥ 296.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/index_explosive_small12.png" alt="index_explosive_small12.png"></a>
                        <div class="exp_details clearfix">
                            <p>优惠价：</p>
                            <span>￥69.00</span>
                            <i>¥ 138.00</i>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">立即抢</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="like">
            <div class="like_top">
                <h1>猜你喜欢</h1>
            </div>
            <div class="like_content">
                <ul class="clearfix">
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/like_img1.png" alt="like_img1.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/like_img2.png" alt="like_img2.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/like_img3.png" alt="like_img3.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/like_img4.png" alt="like_img4.png"></a>
                    </li>
                    <li>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/like_img5.png" alt="like_img5.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!--middle end-->

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