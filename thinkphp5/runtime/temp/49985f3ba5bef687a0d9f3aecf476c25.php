<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./../application/index\view\base.html";i:1531313412;s:48:"./../application/index\view\goorder\goorder.html";i:1531151195;s:61:"D:\wo\phpstudy\WWW\thinkphp5\application\index\view\base.html";i:1531313412;}*/ ?>
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

    
    <link rel="stylesheet" href="/static/home/css/confirm_order.css">
    <script src="/static/home/js/shopcart.js"></script>
     <script src="/static/home/js/confirm_order.js"></script>
    <script src="/static/home/js/navSelect.js"></script>
    

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
    <div class="middle_top">
        <ul class="clearfix">
            <li>
                <span>1</span>
                <p>我的购物车</p>
            </li>
            <li class="active">
                <span>2</span>
                <p>填写核对订单信息</p>
            </li>
            <li>
                <span>3</span>
                <p>成功提交订单</p>
            </li>
        </ul>
    </div>
    <div class="middle_content">
        <h1>填写收货地址</h1>
        <div class="address">
            <ul class="clearfix">
            <?php if($address!=''): if(is_array($address) || $address instanceof \think\Collection || $address instanceof \think\Paginator): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="add addressd">
                    <div class="add_con">
                        <ul>
                            <input type="hidden" value="<?php echo $vo['id']; ?>">
                            <li class="clearfix">
                                <img src="/static/home/img/confirm_phone.png" alt="confirm_phone.png">
                                <p><?php echo $vo['person']; ?></p>
                            </li>
                            <li class="clearfix">
                                <img src="/static/home/img/confirm_address.png" alt="confirm_address.png">
                                <p><?php echo $vo['add']; ?></p>
                            </li>
                            <li class="clearfix">
                                <img src="/static/home/img/confirm_clock.png" alt="confirm_clock.png">
                                <p><?php echo $vo['phone']; ?></p>
                            </li>
                        </ul>
                    </div>
                </li>
             <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <li class="add">
                    <div class="add_con">
                        <ul class="add_last">
                            <li>
                                <button type="button">
                                
                                    <a href="javascript:void(0);" onclick="window.location.href='<?php echo url('/Index/Goorder/address'); ?>'"><img src="/static/home/img/address_add.png" alt="address_add.png">
                                    <span>添加地址</span></a>
                                </button>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="middle_foot clearfix">
        <div class="confirm_head">
            <h1>店铺名称：papa旗航店</h1>
        </div>
        <div class="confirm_middle">
            <table cellspacing="0 " cellpadding="0">
                <thead>
                <tr>
                    <th>商品信息</th>
                    <th>商品规格</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>金额</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                 <?php if($shopcar_list!=''): if(is_array($shopcar_list) || $shopcar_list instanceof \think\Collection || $shopcar_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shopcar_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><img src="<?php echo $vo['p_thumb_path']; ?>" alt="shop_img1.png"></a>
                        <p><a href="<?php echo url('/Index/prodetails/prodetails'); ?>?id=1"><?php echo $vo['p_name']; ?> </a></p>
                    </td>
                    <td>
                            <span> <i class="attr"><?php echo $vo['att_name_list']; ?></i></span>
                             
                        </td>
                    <td>
                        <span>¥ <i class="price"><?php echo $vo['price']; ?></i></span>
                        <b>¥ <?php echo $vo['show_price']; ?></b>
                    </td>
                    <td>
                        <input type="text" class="num" value="<?php echo $vo['number']; ?>">
                    </td>
                    <td>
                        <span class="mintotal_first">¥ <i class="mintotal"><?php echo $vo['price']*$vo['number']; ?></i></span>
                    </td>
                    <td>
                        <a href="javascript:;" onclick="del(<?php echo $vo['shopcar_id']; ?>)" >删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>  
                </tbody>
            </table>
            <div class="confirm_message">
                <div class="invoice clearfix">
                    <p>使用发票：<span>开票抬头</span></p>
                    <div class="invoice_con">
                        <label>不开票</label>
                        <input type="radio" name="invoice" class="hidden" >
                        <label>个人</label>
                        <input type="radio" name="invoice" class="hidden">
                        <label>公司</label>
                        <input type="radio" name="invoice" class="hidden">
                        <input type="text" class="invoive_add">
                    </div>
                </div>
                <script>
                    //尾部下拉样式
                    $(function(){
                        var state=true;
                        $('.select').each(function (i) {
                            $(this).click(function(){
                                if(state){
                                    if(!($(this).is(":animated"))){
                                        $(this).find('.option').slideDown();
                                    }else{
                                        $(this).find('.option').css("display","none");
                                    }
                                    state=false;
                                }else{
                                    if(!($(this).is(":animated"))){
                                        $(this).find('.option').slideUp();
                                    }else{
                                        $(this).stop(true,true);
                                        $(this).find('.option').css("display","");
                                    }
                                    state=true;
                                }
                            });
                            $(this).find('li').click(function(){
                                $(this).parents('.option').css("display","none");
                                $(this).parents('.option').prev().text($(this).html());
                                state=false;
                            });
                            $(this).find('.option').click(function(){
                                $(this).click(function(){return false;});
                            });
                        });
                    });
                </script>
                <div class="message clearfix">
                    <label for="message"> 订单留言：</label>
                    <textarea name="message" id="message" cols="30" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="confirm_foot clearfix">
        <?php if(isset($totalPrice)): ?>
         <p>商品总价（不含运费）<span>￥<i class="sum">
            <?php echo $totalPrice; ?>
            
            </i></span></p>
            <!-- <p>运费：<span>￥<i>0.00</i></span></p>
            <p>优惠：<span>￥<i>0.00</i></span></p> -->
            <p>应付金额：<span>￥<i class="sum">
            <?php echo $totalPrice; ?>
            </i></span></p>
            <input type="button" value="提交订单" onclick="commitOrder()">
        <?php else: ?>
           <p>商品总价（不含运费）<span>￥<i class="sum">
              0.00
            </i></span></p>
            <!-- <p>运费：<span>￥<i>0.00</i></span></p>
            <p>优惠：<span>￥<i>0.00</i></span></p> -->
            <p>应付金额：<span>￥<i class="sum">
             0.00
            </i></span></p>
            <input type="button" value="提交订单" style="display: none" onclick="commitOrder()">
        <?php endif; ?>
            <!-- <input type="button" value="提交订单" onclick="window.location.href='<?php echo url('/Index/Pay/pay'); ?>'"> -->
          <!--   <p>商品总价（不含运费）<span>￥<i class="sum">
             <?php if(isset($totalPrice)): ?>
            <?php echo $totalPrice; else: ?>0.00
            <?php endif; ?>
            </i></span></p>
            <!-- <p>运费：<span>￥<i>0.00</i></span></p>
            <p>优惠：<span>￥<i>0.00</i></span></p> -->
            <!-- <p>应付金额：<span>￥<i class="sum"><?php if(isset($totalPrice)): ?> -->
            <!-- <?php echo $totalPrice; ?> -->
            <!-- <?php else: ?>0.00 -->
            <!-- <?php endif; ?></i></span></p> -->
            <!-- <input type="button" value="提交订单" onclick="commitOrder()"> -->
            <!-- <input type="button" value="提交订单" onclick="window.location.href='<?php echo url('/Index/Pay/pay'); ?>'"> --> 

        </div>
    </div>
</div>
<!--middle end-->
<script>
    function commitOrder(totalPrice)
    {
        var address_id= $(".act").find('input').val();
        // var shopcar_list=$("#shopcar_list").val();

        // alert(JSON.parse(shopcar_list))
        var message=$("#message").val();
        // console.log(shopcar_list);
        if (!address_id)
        { 
            // alert(222)
             layer.msg('请勾选地址',{icon:2,time:1000});
        }
        else
        {
            $.ajax({
                    url : "<?php echo url('Goorder/commitOrder'); ?>",
                    data : {'add_id':address_id,'message':message},
                    dataType : 'json',
                    type : 'post',
                    async : false,
                    success : function(data){
                        if( data.code == 1 ){
                            window.location.href=data.url;
                            // $(obj).parent().siblings().find(".total_price").html(price.toFixed(2));
                            // check地址();
                             // window.location.reload();
                        }else{
                       layer.msg(data.msg, {icon:2,time:3000,btn:['确定']});
                        }
                            
                    }

                });
        }
       
    }
    function del(id)
    {
       // var shopcar_id=$('.shopcar_id').val();
       //  alert(shopcar_id);return
       // console.log(11);
        layer.confirm('确认要删除吗？',function(index){
           $.ajax({
                    url : "<?php echo url('Goorder/delete'); ?>",
                    data : {'id':id},
                    dataType : 'json',
                    type : 'post',
                    async : false,
                    success : function(info){
                        if( info.code == 1 ){
                            // $(obj).parent().siblings().find(".total_price").html(price.toFixed(2));
                            // check地址();
                             window.location.reload();
                        }
                    }
                });
         }); 

    }
function change()
{
   // $("#getfirst").find("ul li:first-child")
    var div= $('.address').children().children().first().next();
    console.log(div);
    var newAddress=div.clone();
     div.after(newAddress);
}
    //添加地址
    function change2(obj)
{
    // 选中a标签所在的div标签
    var div = $(obj).parent().parent();
    // 先获取i标签中的class名
    if($(obj).find("i").hasClass("true"))
    {
        // 把div克隆一份
        var newDiv = div.clone();
        // 把克隆出来的div里面的i标签变成-号
        newDiv.find("i").removeClass("true");
        newDiv.find("a").removeClass("btn-primary");
        newDiv.find("a").addClass("btn-danger");
        newDiv.find("i").html("&#xe6a1;");
        // 放在后面
        div.after(newDiv);
    }
    else
        div.remove();
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