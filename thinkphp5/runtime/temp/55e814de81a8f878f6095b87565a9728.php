<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./../application/index\view\base.html";i:1531313412;s:48:"./../application/index\view\shopcar\shopcar.html";i:1531151195;s:61:"D:\wo\phpstudy\WWW\thinkphp5\application\index\view\base.html";i:1531313412;}*/ ?>
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

    
    <link rel="stylesheet" href="/static/home/css/shop_cart.css">
    <!-- <script src="/static/home/js/shopcart.js"></script> -->
    

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

<div id="middle" class="clearfix">
    <div class="middle_top">
        <ul class="clearfix">
            <li class="active">
                <span>1</span>
                <p>我的购物车</p>
            </li>
            <li>
                <span>2</span>
                <p>填写核对订单信息</p>
            </li>
            <li>
                <span>3</span>
                <p>成功提交订单</p>
            </li>
        </ul>
    </div>
    <div class="middle_bottom">
        <div class="shop_head">
            <label class="ckeckall">店铺名称：papa旗航店</label>
            <input type="checkbox" class="checkAll">
        </div>
        <div class="shop_middle">
            <table cellspacing="0 " cellpadding="0">
                <thead>
                    <tr>
                        <th>商品信息</th>
                        <th>属性尺寸</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>金额</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody class="shop_content">
                <?php if($shopcar_list!=''): if(is_array($shopcar_list) || $shopcar_list instanceof \think\Collection || $shopcar_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shopcar_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <label class="check_one"></label>
                            <input type="checkbox" class="checkone">
                            <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="<?php echo $vo['p_thumb_path']; ?>" alt="shop_img1.png"></a>
                            <p><?php echo $vo['p_name']; ?></p>
                        </td>
                        <td>
                            <span> <i class="attr"><?php echo $vo['att_name_list']; ?></i></span>
                             
                        </td>
                        <td>
                            <span>¥ <i class="price"><?php echo $vo['price']; ?></i></span>
                            <b>¥ <?php echo $vo['show_price']; ?></b>
                        </td>
                        <td>
                            <input type="button" class="minus">
                            <input type="text" class="num" value="<?php echo $vo['number']; ?>">
                            <input type="button" class="plus">
                            <input type="hidden" value="<?php echo $vo['stock']; ?>" class="maxnum">
                            <input type="hidden" value="<?php echo $vo['shopcar_id']; ?>" class="shopcar_id" >
                            
                        </td>
                        <td>
                            <span class="minSpan">¥ <i class="minTotal"><?php echo $vo['price']*$vo['number']; ?></i></span>
                        </td>
                        <td>
                            
                            <a href="javascript:;" class="delete" onclick="del(<?php echo $vo['shopcar_id']; ?>)">删除</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>    
                </tbody>
            </table>
        </div>
        <div class="shop_foot">
            <p>商品总价（不含运费) <span>￥<i class="total">0.00</i></span></p>
            <?php if(\think\Session::get('username')==''): ?>
            <input type="button" value="去结算"  style="display: none" onclick="window.location.href='<?php echo url('/Index/Goorder/goorder'); ?>'">
            <?php elseif($shopcar_list==''): ?>
              <input type="button" value="去结算" style="display: none"   onclick="window.location.href='<?php echo url('/Index/Goorder/goorder'); ?>'">
            <?php else: ?>
                 <input type="button" value="去结算"  onclick="window.location.href='<?php echo url('/Index/Goorder/goorder'); ?>'">
            <?php endif; ?>
           
        </div>
    </div>
</div>
<script>
        //减数量操作

      $('.num').each(
        function (i) {
             $('.minus').eq(i).click(function ()
              {
                var num=$('.num').eq(i).val();

                var maxNum=$('.maxnum').eq(i).val();

                if(num<=1){

                    return ;

                }

                $('.num').eq(i).val(--num);
                    var per_price= parseFloat($('.price').eq(i).html());
                    var num= $('.num').eq(i).val();
                    $('.minTotal').eq(i).html((num*per_price).toFixed(2));
                $('.num').eq(i).trigger('change');
                
             }
            );
    
   

        //加数量操作

            $('.plus').eq(i).click(function () {

            var num=$('.num').eq(i).val();

            //var maxNum=$('.maxnum').eq(i).val();

            //if(num>=maxNum){

            //    return ;

            //}

            num++;

            $('.num').eq(i).val(num);
               var per_price= parseFloat($('.price').eq(i).html());
              var num= $('.num').eq(i).val();
              $('.minTotal').eq(i).html((num*per_price).toFixed(2));
              // alert(11)
              // console.log(per_price);
            $('.num').eq(i).trigger('change');

           

            });
        //通过输入数量改变

        //获取操作之前的数量

                var oldNum=$('.num').val();

                $(this).change(function()
                {

                    //获取最大数量
                 
                    changeData(i);
                    
                }
                  
              );

           }
        );
       //全选

    $('.ckeckall').click(function (){

         $('.check_one').next().attr('checked',!($(this).next().is(':checked')));

        $('.ckeckall').next().attr('checked',!($(this).next().is(':checked')));

        $('.ckeckall').toggleClass('checked');

             if($(this).next().is(':checked')){

                 $('.check_one').addClass('checked_one');

             }else{

                 $('.check_one').removeClass('checked_one');

             }

             calTotal();

    });
   
     //单选
     $('.check_one').click(function () {

        $(this).next().attr('checked',!($(this).next().is(':checked')));

        $(this).toggleClass('checked_one');

        $('.ckeckall').next().attr('checked',$('.check_one').length==$('.check_one').next().filter(':checked').length);

        if($('.ckeckall').next().is(':checked')){

            $('.ckeckall').addClass('checked');

        }else{

            $('.ckeckall').removeClass('checked');

        }

        calTotal();

    });
    

    function calTotal(){

    //获取当前商品状态

    var checkbox=$('.check_one');

    //获取商品单价

    // var price=$('.price');

    //获取商品数量

    var num=$('.num');

    //获取小计

    var minTotal=$('.mintotal');
    // console.log(minTotal);return

    //设置总价

    var sum=0.00;

    //设置总件数

    var numAll=0;

    // var price = 0;

    checkbox.each(function(i){

        //兼容写法

        // 
        var input = $(this).next();
        // console.log(input)

        if(input[0].checked){
            // (num[i].value*price[i].innerHTML).toFixed(2);
           var td = $(this).parent().siblings()[3];
           sum += parseFloat(td.querySelector(".minTotal").innerText); 
          
        }
         
    });
    // console.log(price);

    //总价

    $('.total').html(sum.toFixed(2));

}
function changeData(i)
{
    var per_price= parseFloat($('.price').eq(i).html());
    var number= $('.num').eq(i).val(); 
    $('.minTotal').eq(i).html((number*per_price).toFixed(2));
    var shopcar_id=$('.shopcar_id').eq(i).val();
    // console.log($('.shopcar_id').eq(i).val());
    $.ajax({
                url : "<?php echo url('Shopcar/editshopcar'); ?>",
                data : {'id':shopcar_id,'number':number},
                dataType : 'json',
                type : 'post',
                async : false,
                success : function(info){
                    if( info.code == 1 ){
                        // $(obj).parent().siblings().find(".total_price").html(price.toFixed(2));
                        // checkChange();
                    }
                }
            })
    calTotal();
} 
    function del(id)
    {
       // var shopcar_id=$('.shopcar_id').val();
        // alert(id);return
        layer.confirm('确认要删除吗？',function(index){
           $.ajax({
                    url : "<?php echo url('Shopcar/delete'); ?>",
                    data : {'id':id},
                    dataType : 'json',
                    type : 'post',
                    async : false,
                    success : function(info){
                        if( info.code == 1 ){
                            // $(obj).parent().siblings().find(".total_price").html(price.toFixed(2));
                            // checkChange();
                             window.location.reload();
                        }
                    }
                });
        
            });
    }

//嘉峡的方法
      
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