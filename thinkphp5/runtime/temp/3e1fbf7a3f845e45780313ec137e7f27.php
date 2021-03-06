<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"./../application/admin\view\attribute\read.html";i:1530690388;}*/ ?>
<!DOCTYPE HTML>
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
<!-<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>-->
<!--<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" data-title="添加资讯"   href="<?php echo url('Attribute/add'); ?>"><i class="Hui-iconfont">&#xe600;</i> 添加属性</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="value_array" value=""></th>
				<th width="25">ID</th>
				<th width="80">属性名</th>
				<th width="80">分类</th>
				<th width="60">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($list as $v):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $v['n_id']?>" name="value_id"></td>
				<td><?php echo $v['id'] ?></td>
				<td class="text-l"><?php echo $v['attr'] ?></td>
				<td><?php echo $v['attr_cate_name'] ?></td>
				<td class="f-14 td-manage"><a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','/admin/Attribute/edit/id/<?php echo $v['id'];?>/attr_cate_name/<?php echo $v['attr_cate_name'];?>','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a></td>
			</tr>
		    <?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
// $('.table-sort').dataTable({
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"pading":false,
// 	"aoColumnDefs": [
// 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
// 	]
// });
		 	
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-添加*/


function attribute_add(){
    $.ajax({
			url:'<?php echo url('Attribute/add'); ?>',
			type: 'POST',
			dataType: 'json',
			success: function(data){
				if (data.code == 1) {
					 layer.msg(data.msg, {icon:1,time:1000},function(){setTimeout(window.location.href=data.url,3000 )}
                            )
					}else{
					  layer.msg(data.msg, {icon:3,time:3000})
					};
			}
		});	

};


</script> 
</body>
</html>