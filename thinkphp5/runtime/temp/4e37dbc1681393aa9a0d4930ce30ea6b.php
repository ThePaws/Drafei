<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"./../application/admin\view\product\read.html";i:1530618338;s:69:"D:\wo\phpstudy\WWW\thinkphp5\application\admin\view\product\base.html";i:1530586378;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>建材列表</title>
<link rel="stylesheet" href="/static/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body class="pos-r">
<div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5; overflow:auto;">
	<ul id="treeDemo" class="ztree"></ul>
</div>
<div style="margin-left:200px;">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="text-c">
		    
			<input type="text" name="search" id="" placeholder=" 产品名称" style="width:250px" class="input-text">
			<button    class="btn btn-success" onclick="search()" type="button"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
			
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="article_del()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="product_add('添加产品','add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
		<div class="mt-20" id="addlist">
			﻿ 			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="value_id" value=""></th>
						<th width="20">ID</th>
						<th width="60">产品名称</th>
						<th width="120">缩略图</th>
						<th width="80">添加时间</th>
						<th width="120">售价</th>
						<th width="80">成本价</th>
						<th width="60">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			    <tr class="text-c">
				<td><input type="checkbox" value="<?php echo $vo['p_id']; ?>" name="value_id"></td>
				<td><?php echo $vo['p_id']; ?></td>
				<td class="text-l"><?php echo $vo['p_name']; ?></td>
				<td>
					<img src="<?php echo $vo['p_thumb_path']; ?>" alt=""></td>
				<td>   <?php echo date("y/m/d h:i",$vo['create_time']); ?></td>
				<td title="<?php echo $vo['market_price']; ?>">
				   <?php echo $vo['show_price']; ?>
				   </td>
				<td><?php echo $vo['cost_price']; ?></td>
				<td class="f-14 td-manage"><a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','/admin/product/edit/p_id/<?php echo $vo['p_id']; ?>/p_name/<?php echo $vo['p_name']; ?>','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del_one(<?php echo $vo['p_id']; ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			  </tr>
               <?php endforeach; endif; else: echo "" ;endif; ?> 
				</tbody>
			</table>
			<?php echo $page; ?>
	 
	
		</div>
	</div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script>
	function search()
{
	var data ={
		'name':$('[name="search"]').val()
	}
	 $.ajax({
	 	url:"<?php echo url('product/search'); ?>",
	 	data:data,
	 	dataType:'json',
	 	type:'post',
	 	success:function(data)
	 	{
           if (data.code==1)
           {
           	$('#addlist').html(data.msg);
           }
           else
           {
           	   layer.msg(data.msg);
           }
	 	}
	 });
}
</script>
<script type="text/javascript">

var zNodes; 
	$.ajax({
		url:"<?php echo url('product/classify'); ?>",
		type: 'get',
		dataType:'json',
		async:false,

		success:function(data){
			zNodes = data;
		
		}
	});
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "f_id",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			// console.log(treeNode.id)
			if (treeNode.id!=1) {
				   $.ajax({
				        type: 'post',
				        url: "<?php echo url('admin/product/classify_Cate'); ?>",
				        dataType:'json',
				        data:'id='+treeNode.id,
			            success: function(data)
			            {
				            if (data.code == 1) {
				              // $("#addlist").innerHTML = "";
				               $("#addlist").html(data.msg);
				                   
				            }else{
				                layer.msg(data.msg);
				            };
			           }
		          });
            }
		}
	}
};

// function nextPage(){

// }
		
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	//demoIframe = $("#testIframe");
	//demoIframe.on("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
});


/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}


/*产品-申请上线*/
function product_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*产品-编辑*/
function article_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
function article_del(){
	layer.confirm('确认要删除吗？',function(index)
  { 
	var select=document.getElementsByName('value_id');
	  var check_val = [];
	  for(k in select){
	  	if (select[k].checked) {
	  		check_val.push(select[k].value);
	  	};
	  };
    $.ajax({
			type: 'POST',
			url: "<?php echo url('product/delete'); ?>",
			dataType: 'json',
			data:'id='+check_val.join(","),
			success: function(data){
				if (data.code == 1) {
					 layer.msg(data.msg, {icon:1,time:6000,btn:['确定']},function(){window.location.href=data.url}
                            )
					}else{
					  layer.msg(data.msg, {icon:2,time:3000})
					};
			}
		});	
    });
};
/*产品-删除*/
function article_del_one(id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('product/delete'); ?>",
			dataType: 'json',
			data:'id='+id,
			success: function(data){
				layer.msg(data.msg, {icon:1,time:1000,btn:['确定']},function(){
					 	
					 	window.location.href=data.url}
                            )
			},
			error:function(data) {
				layer.msg(data.msg, {icon:2,time:1000,btn:['确定']},function(){
					 	
					 	}
                            )
			},
		});		
	});
}

</script>
</body>
</html>