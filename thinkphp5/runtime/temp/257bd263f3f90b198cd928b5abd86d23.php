<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"./../application/index\view\prodetails\prodetails.html";i:1531313210;s:61:"D:\wo\phpstudy\WWW\thinkphp5\application\index\view\base.html";i:1531313412;}*/ ?>
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

<!--middle-->
    <div id="middle">
        <div class="nav_head clearfix">
        </div>
        <div class="pro_details clearfix">
            <div class="pro_left">
                <div class="box">
                 <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key == 0): ?>
                    <div class="tb-booth tb-pic tb-s310 ">
                        <a href="/static/home/img/01.png"><img src="<?php echo $vo['path']; ?>"  rel="/static/home/img/01.png" class="jqzoom" /></a>
                        <!--产品在购物车的小图 隐藏-->
                        <img src="<?php echo $vo['p_thumb_path']; ?>" alt="shop_img1.png" class="hidden" id="shopimg">
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <ul class="tb-thumb" id="thumblist">
                      <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key < 5): ?>
                        <li class="tb-selected"><div class="tb-pic tb-s40"><a href="javascript:"><img src="<?php echo $vo['p_thumb_path']; ?>" mid="<?php echo $vo['path']; ?>" big="<?php echo $vo['path']; ?>"></a></div></li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                       
                        
                    </ul>
                </div>
            </div>
            <div class="right_details">
                <h1 id="pro_name"><?php echo $details['p_name']; ?></h1>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>商品原价：</td>
                        <td>
                            <p class="clearfix"><b id="oldprice">￥299.00</b><span>月销量：5129</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>促销价：</td>
                        <td>
                            <p class="clearfix"><i>￥<a id="price"><?php echo $details['show_price']; ?></a></i><span>累计评价：9998</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>本次活动：</td>
                        <td><em>满299元，包邮</em></td>
                    </tr>
                    <tr>
                        <td>物流运费：</td>
                        <td>
                            <ul class="logistics clearfix">
                                <li class="arrive" >
                                    <span id="from">浙江杭州市</span>
                                    <div class="city">
                                        <ul>
                                            <li>杭州市</li>
                                            <li>北京市</li>
                                            <li>深圳市</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>至</li>
                                <li class="arrive">
                                    <span id="to">成都市</span>
                                    <div class="city">
                                        <ul>
                                            <li>成都市</li>
                                            <li>上海市</li>
                                            <li>沈阳市</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>卖家承担</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>颜色分类：</td>
                        <td class="color">
                          <?php if(is_array($color_group) || $color_group instanceof \think\Collection || $color_group instanceof \think\Paginator): $k = 0; $__LIST__ = $color_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k==1): ?>
                                <label class="on"><?php echo $vo['attr']; ?><input type="radio" name="color"  value="<?php echo $vo['id']; ?>" checked></label>
                              <?php else: ?> <label ><?php echo $vo['attr']; ?><input type="radio" name="color" value="<?php echo $vo['id']; ?>"  ></label>
                              <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">参考身高：</td>
                        <td class="height">
                         <?php if(is_array($size_group) || $size_group instanceof \think\Collection || $size_group instanceof \think\Paginator): $k = 0; $__LIST__ = $size_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k==1): ?>
                                <label class="on"><?php echo $vo['attr']; ?><input type="radio" name="height" value="<?php echo $vo['id']; ?>" checked ></label>
                              <?php else: ?> <label ><?php echo $vo['attr']; ?><input type="radio" name="height" value="<?php echo $vo['id']; ?>" ></label>
                              <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </td>
                    </tr>
                    <tr class="numtd">
                        <td>选择数量：</td>
                        <td>
                            <input type="button" id="minus">
                            <input type="text" value="1" id="num">
                            <input type="button" id="plus">
                            <input type="hidden" value="2978" class="maxnum">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buy_now" value="立即购买" >
                            <input type="hidden" name="p_id" value="<?php echo $details['p_id']; ?>">
                            <input type="button" class="join_cart" onclick="addShopCar()" value="加入购物车">  
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pro_bottom clearfix">
            <div class="bottom_left">
                <div class="left_hot">
                    <h2 class="left_title"><a href="shop_list.html">热卖推荐</a></h2>
                    <ul>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_hot1.png" alt="left_hot1.png"></a>
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬秋冬纯棉宝宝礼盒新生儿礼盒礼品8件套婴儿衣服套装0-6月</a> </p>
                            <span>¥ 139.00</span><i>¥ 298.00</i>
                            <p>总销量：<span>23616</span></p>
                        </li>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_hot2.png" alt="left_hot2.png"></a>
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬 冬款仿羊羔毛宝宝帽子婴儿加厚保暖帽子0-2岁</a></p>
                            <span>¥ 49.00</span><i>¥ 89.00</i>
                            <p>总销量：<span>3847</span></p>
                        </li>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_hot3.png" alt="left_hot3.png"></a>
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬 秋冬宝宝仿羊羔绒带帽斗篷披风 婴儿保暖加绒斗篷0-3岁</a></p>
                            <span>¥ 149.00</span><i>¥ 249.00</i>
                            <p>总销量：<span>3347</span></p>
                        </li>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_hot4.png" alt="left_hot4.png"></a>
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬 秋冬宝宝灯芯绒仿羊羔绒大PP裤婴儿加厚保暖秋款0-3岁</a></p>
                            <span>¥ 129.00</span><i>¥ 229.00</i>
                            <p>总销量：<span>6437</span></p>
                        </li>
                        <li>
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_hot5.png" alt="left_hot5.png"></a>
                            <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬冬款宝宝仿羊羔绒耳朵小鞋子 婴儿可爱保暖加厚鞋子0-1岁</a></p>
                            <span>¥ 45.00</span><i>¥ 79.00</i>
                            <p>总销量：<span>9648</span></p>
                        </li>
                    </ul>
                </div>
                <div class="left_baby">
                    <h2 class="left_title"><a href="shop_list.html">宝贝排行榜</a></h2>
                    <ul>
                        <li class="clearfix ">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_baby.png" alt="left_baby.png"></a>
                            <div class="baby_right">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa纯棉新生儿礼盒...</a></p>
                                <span>¥ 199.00</span>
                                <p>已售出<i>41203</i>笔</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_baby1.png" alt="left_baby1.png"></a>
                            <div class="baby_right">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa彩棉四季婴儿袜...</a></p>
                                <span>¥ 19.00</span>
                                <p>已售出<i>30072</i>笔</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_baby2.png" alt="left_baby2.png"></a>
                            <div class="baby_right">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬冬彩棉宝宝...</a></p>
                                <span>¥ 169.00</span>
                                <p>已售出<i>27958</i>笔</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_baby3.png" alt="left_baby3.png"></a>
                            <div class="baby_right">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa爬爬秋冬纯棉宝...</a></p>
                                <span>¥ 139.00</span>
                                <p>已售出<i>23577</i>笔</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="/static/home/img/left_baby4.png" alt="left_baby4.png"></a>
                            <div class="baby_right">
                                <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1">papa彩棉四季款轻柔...</a></p>
                                <span>¥ 129.00</span>
                                <p>已售出<i>19662</i>笔</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bottom_right" id="tab">
                <ul class="hd clearfix">
                    <li class="active">商品详情</li>
                </ul>
                <ul class="bd">
                    <li class="pro_img">
                        <?php echo $details['details']; ?>
                          
                    </li>
                    
                </ul>
            </div>
            
        </div>
    </div>
    <script>
                $("#tab").slide({ titCell:".hd li", mainCell:".bd" });
                $('.hd>li').each(function () {
                    $(this).hover(function () {
                        $(this).addClass('active');
                        $(this).siblings().removeClass('active');
                    });
                });
    </script>
    <script>

    </script>
    <script> 
    $(function(){
           queryPrice();
           
    });
    $('.color').find('label').each(function () {
        $(this).click(function () {
            if ($(this).find('input').is(':checked')) {
                 queryPrice();
            }
        })


    });

    //身高样式

    $('.height').find('label').each(function () {

        $(this).click(function () {
            if ($(this).find('input').is(':checked')) {
                     queryPrice();
                 // alert($(this).find('input').val());
            }
        })

    });
    function queryPrice()
    {
          var data= checkClick();
          var p_id=$('[name="p_id"]').val();
                   // $('[name="m_name"]').val(),
          // alert(p_id);
                $.ajax({
                    type: 'POST',
                    url:"<?php echo url('Prodetails/queryPrice'); ?>" ,
                    dataType: 'json',
                    data:{'id':data,'p_id':p_id},
                    success: function(data){
                        if (data.code == 1) {
                            $('#price').html(data.msg);
                            }
                        else{
                             layer.msg(data.msg, {icon:2,time:1000,btn:['确定']},function(){}
                                    )
                            };
                    }
                }); 
    }
    function checkClick()
    {
        var select=document.getElementsByName('color');
            for(k in select){
                if (select[k].checked) {
                  var  color=select[k].value;
                };
            };
        var select2=document.getElementsByName('height');
            for(k in select2){
                if (select2[k].checked) {
                   var size=select2[k].value;
                    // size.push(select2[k].value);
                };
            }; 
        var attr_id=[];
             attr_id.push(color);
             attr_id.push(size);
            // attr_id[0]=color;
            // attr_id[1]=size;
            return attr_id;
    }
    function GetQueryString(name)
        {
                 var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                 var r = window.location.search.substr(1).match(reg);
                 if(r!=null)return  unescape(r[2]); return null;
        }
        var product_id=GetQueryString("id");
        // if(product_id !=null && product_id.toString().length>=1)
        // {
        // }

   // $(function(){})     
    function addShopCar()
    {   
        var select=document.getElementsByName('color');
            for(k in select){
                if (select[k].checked) {
                  var  color=select[k].value;
                };
            };
        var select2=document.getElementsByName('height');
            for(k in select2){
                if (select2[k].checked) {
                   var size=select2[k].value;
                    // size.push(select2[k].value);
                };
            }; 
        var attr_id=[];
            attr_id[0]=color;
            attr_id[1]=size;
        var data=
             {
                'pro_id':product_id,
                // 'from':$("#from").html(),
                // 'to':$("#to").html(),
                'attr_id':attr_id.join(),
                'number':$('#num').val()

             }
             
        $.ajax({
            type: 'POST',
            url:"<?php echo url('Prodetails/addshopcar'); ?>" ,
            dataType: 'json',
            data:data,
            success: function(data){
                if (data.code == 1) {
                     addShopCarNumber(data.addnumber);
                      layer.msg(data.msg, {icon:1,time:1000,btn:['确定']})

                    }else{
                     layer.msg(data.msg, {icon:2,time:1000,btn:['确定']},function(){setTimeout(window.location.href=data.url,3000 )}
                            )
                    };
            }
        }); 
    }
        function addShopCarNumber(addnumber)
        {
              //获取最大数量
              var maxnum=$('.maxnum').val();
             
              // alert(222)
                var t = $('.car_number').html();
                     // console.log(parseInt(t))
                     // console.log(parseInt(addnumber))
                     // console.log(parseInt(t)+parseInt(addnumber))
                     var sum=parseInt(t)+parseInt(addnumber);
                     // console.log(maxnum);
                $('.car_number').html(sum);
              
                if(parseInt(t)>=maxnum){

                    $('.car_number').html(maxnum);

                }

            
        }
            

      
    </script>
  
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