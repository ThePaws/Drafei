<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"./../application/admin\view\attribute\add.html";i:1530692466;}*/ ?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
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
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>新增文章 - 资讯管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="new_form" >
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>属性名:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $attr; ?>" placeholder=""  name="attr">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="attr_cate_id" class="select">
				<?php if(is_array($attr_cate) || $attr_cate instanceof \think\Collection || $attr_cate instanceof \think\Paginator): $i = 0; $__LIST__ = $attr_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				

				</select>
				</span> </div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" onclick="Formadd()" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>

<script type="text/javascript">
	function Formadd(){
  	var data = new FormData($("#new_form")[0]);
  	    console.log(data);
        $.ajax({
            url:'<?php echo url('Attribute/add'); ?>',
            type:'post',
            data: data,
            dataType: 'json',
           contentType:false,//不设置内容类型
			processData:false,//不处理数据
            success: function(data){
                if(data.code==1){
//                    alert(data.msg);
                    layer.msg(data.msg, {icon:1,time:1500});
                        setTimeout(function(){
                           window.location=data.url;
                        },1000)


                }else{
//                     alert(data.msg);
                    layer.msg(data.msg, {icon:2,time:1500});
                }
            }
        })
        return false;  
    }
	
	
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>