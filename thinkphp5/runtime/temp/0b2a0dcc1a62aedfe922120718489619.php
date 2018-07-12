<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"./../application/admin\view\product\edit.html";i:1531226613;}*/ ?>
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
<link rel="Shortcut Icon" href="/static/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/lib/respond.min.js"></script>

<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />

<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
  <!--引入多图片上传插件开始-->
    <!--  -->
    
    <!-- <link href="/static/file/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" /> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/static/file/css/default.css">
    <link href="/static/file/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
   <!--引入多图片上传插件结束-->
<!--[if IE 6]>
<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<link href="/static/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<style>
	.tab-base {
        list-style: none;
        display: flex;
        margin-bottom: 0;
    }
    .tab-base li {
        padding: 5px 10px;
        margin-right: -1px;
        border: solid 1px #ccc;
        border-bottom: none;
        cursor: pointer;
    }
    .fixed-bar {
       margin-left: 10%;
    }
    .table{
      width: 50%;
    margin-left: 23%;

    }
    .tab-base li{
       background-color: #E6E6E6 !important;
   }

   
</style>

</head>
<body>
<div class="fixed-bar">
        <div class="item-title">
            <ul class="tab-base 0">
                <li><a href="javascript:void(0);" data-index='1' class="tab current"><span>通用信息</span></a></li>
                <li><a href="javascript:void(0);" data-index='2' class="tab"><span>商品相册</span></a></li>
                <li><a href="javascript:void(0);" data-index='3' class="tab"><span>商品属性设置</span></a></li>
                
            </ul>
        </div>
    </div>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal" id="new_form" enctype="multipart/form-data">
	  <div class="tab_div_1">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $data['p_name']; ?>" placeholder=""   name="p_name">
			</div>
		</div>



		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="c_id" class="select">
					<?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($data['id']==$vo['id']): ?>
                         	<option value="<?php echo $vo['id']; ?>" selected="selected"><?php echo $vo['name']; ?></option>
                       <?php else: ?><option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>展示价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="show_price" id="" placeholder="" value="<?php echo $data['show_price']; ?>" class="input-text" style="width:90%">
				元</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $data['rank']; ?>" placeholder=""  name="rank">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-1 col-sm-2">上架：</label>
			<div class="formControls  col-sm-1"> <span class="select-box">
				<select class="select" name="sale"  >
				<?php if($data['sale']==1): ?>
                         	<option value="<?php echo $vo['id']; ?>" selected="selected">是</option>
                         	<option value="0">否</option>
                       <?php else: ?><option value="<?php echo $vo['id']; ?>" selected="selected">否</option>
                             <option value="1">是</option>
				<?php endif; ?>
					
					
				</select>
				</span>
			 </div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产地：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="place" id="" placeholder="" value="<?php echo $data['place']; ?>" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">材质：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="materal"  placeholder="" value="<?php echo $data['materal']; ?>" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">所属供应商：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="supllier" id="" placeholder="" value="<?php echo $data['supllier']; ?>" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品重量：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="weigth" id="" placeholder="" value="<?php echo $data['weigth']; ?>" class="input-text" style="width:90%">
				kg</div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">销售开始时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:180px;" name="start_time" value="<?php echo $data['start_time'];?>">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">销售结束时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'datemin\')}' })" id="datemax" class="input-text Wdate" style="width:180px;" name="end_time" value="<?php echo $data['end_time'];?>">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品关键字：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="key_word" id="" placeholder="多个关键字用英文逗号隔开，限10个关键字" value="" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="summary" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符"  ><?php echo $data['summary']; ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品详情页内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" name="details" type="text/plain" style="width:100%;height:400px;"><?php echo $data['details']; ?></script> 
			</div>
		</div>
	  </div>
	  <div class="tab_div_2" style="display: none">
	    <div class="row cl">
    		<label class="form-label col-xs-4 col-sm-2">产品图片：</label>
				<div class="portfolio-content" style="margin-left:210px">
				<ul class="cl portfolio-area">
				  <?php if(is_array($img_arr) || $img_arr instanceof \think\Collection || $img_arr instanceof \think\Paginator): $i = 0; $__LIST__ = $img_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<li class="item">
						<div class="portfoliobox">
						<a href="javascript:;" onclick="delImg(<?php echo $vo['id']; ?>)" style="float: right;">×</a>
							<div class="picbox"><img src="<?php echo $vo['p_thumb_path']; ?>"></div>
							<div class="textbox">客厅 </div>
						</div>
					</li>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
					
					
				</ul>
			</div>
		</div>
		<div class="row cl">
			    <label class="form-label col-xs-4 col-sm-2">产品多图上传：</label>
			    <div class="form-group formControls col-xs-8 col-sm-9" >
			        <input id="file-0" class="file" type="file" multiple data-preview-file-type="any" name="img[]" data-upload-url="#" data-preview-file-icon="">
			    </div>
		    
		</div>
		<div class="row cl">
			<label class="form-label col-xs-1 col-sm-2">添加水印：</label>
			<div class="formControls  col-sm-1"> <span class="select-box">
				<select class="select" name="water" onchange="chg(this)" >
					<option value="0">否</option>
					<option value="1">是</option>
				</select>
				</span>
			 </div>
				<lable id="city" style="display:none">
				类型：
                <select class="formControls col-sm-1" name="type"  >
		            <option value="1">图片</option>
		            <!-- <option value="0">文字</option> -->
		        </select>
		        </lable>
		        <lable id="area" style="display:none">
		        位置：
		        <select  name="position" >
		            <option value="9">右下角</option>
		            <option value="8">下居中</option>
		            <option value="7">左下角</option>
		            <option value="6">右居中</option>
		            <option value="5">居中</option>
		            <option value="4">左居中</option>
		            <option value="3">右上角</option>
		            <option value="2">上居中</option>
		            <option value="1">左上角</option>
		        </select>
		        </lable>
		        <lable id="qq" style="display:none">
		       透明度：
		        <select   name="percentage">
		            <option value="25">25</option>
		            <option value="50">50</option>
		            <option value="75">75</option>
		            <option value="100">100</option>
		        </select>
		         </lable>
		  </div>   
		</div>
		<div  class="tab_div_3" style="display: none">
				<div class="row cl">
				
					<label class="form-label col-xs-4 col-sm-2">属性: </label>
					   <div class="formControls col-xs-8 col-sm-9">
					<label class="col-sm-1">颜色: </label>
		                <?php if(is_array($product_attr_color) || $product_attr_color instanceof \think\Collection || $product_attr_color instanceof \think\Paginator): $i = 0; $__LIST__ = $product_attr_color;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		                  <span class="btn btn-primary color " data-spec_id='1' data-item_id='<?php echo $vo['id']; ?>'><?php echo $vo['attr']; ?></span>
		                  <input type="hidden" value="<?php echo $vo['id']; ?>">
		                <?php endforeach; endif; else: echo "" ;endif; ?>
				   </div>
				</div>
				<div class="row cl" >
				    <label class="form-label col-xs-1 col-sm-2"></label>
					<div class="formControls col-xs-8 col-sm-9">
					<label class=" col-sm-1">尺寸: </label>
					    <?php if(is_array($product_attr_size) || $product_attr_size instanceof \think\Collection || $product_attr_size instanceof \think\Paginator): $i = 0; $__LIST__ = $product_attr_size;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
		                  <span class="btn btn-primary size " data-spec_id='2' data-item_id='<?php echo $val['id']; ?>' ><?php echo $val['attr']; ?></span>
		                  <input type="hidden" value="<?php echo $val['id']; ?>">
		                <?php endforeach; endif; else: echo "" ;endif; ?>
						
					</div>
				</div>	
				<div id="anchor"></div>	 	
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
			     <input type="hidden" value="<?php echo $data['p_id']; ?>" name="p_id">
				<button onClick="Formadd();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				
			</div>
		</div>

	</form>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

 <!--引入多图片上传插件开始-->
<script src="/static/file/js/2.1.1/jquery.min.js"></script>
<script src="/static/file/js/fileinput.js" type="text/javascript"></script>
<script src="/static/file/js/fileinput_locale_zh.js" type="text/javascript"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.js"></script>
 <!--引入多图片上传插件结束-->
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
 	var ue = UE.getEditor('editor');
 </script>
 <script>
	    $(document).ready(function(){    
        //插件切换列表
        $('.tab-base').find('.tab').click(function(){
            $('.tab-base').find('.tab').each(function(){
                $(this).removeClass('current');
            });
            $(this).addClass('current');
			var tab_index = $(this).data('index');			
			$(".tab_div_1, .tab_div_2, .tab_div_3, .tab_div_4,.tab_div_5").hide();			
			$(".tab_div_"+tab_index).show();
		});		
            
    });
</script>
 <script>
 	 $(".btn").click(function(){
	   if($(this).hasClass('btn-danger'))
	   {
		   $(this).removeClass('btn-danger');
	   }else{
		   $(this).addClass('btn-danger');
	   }
	   ajaxGetSpecInput();	  	   	 
});
	

/**
*  点击商品规格触发下面输入框显示
*/
function ajaxGetSpecInput()
{
//	  var spec_arr = {1:[1,2]};// 用户选择的规格数组 	  
//	  spec_arr[2] = [3,4]; 
	  var spec_arr = {};// 用户选择的规格数组 	  	  
	// 选中了哪些属性	  
	$(".btn").each(function(){
	    if($(this).hasClass('btn-danger'))	
		{
			var spec_id = $(this).data('spec_id');
			var item_id = $(this).data('item_id');
			if(!spec_arr.hasOwnProperty(spec_id))
				spec_arr[spec_id] = [];
		    spec_arr[spec_id].push(item_id);
			
		}	
	});  
		ajaxGetSpecInput2(spec_arr); // 显示下面的输入框
	// console.log(spec_arr);
}
/**
* 根据用户选择的不同规格选项 
* 返回 不同的输入框选项
*/
function ajaxGetSpecInput2(spec_arr)
{		

    var goods_id = $("input[name='p_id']").val();
	$.ajax({
			type:'POST',
			data:{spec_arr:spec_arr,goods_id:goods_id},
			url:"/index.php/admin/Product/ajaxGetSpecInput",
			success:function(data){                            
				   $("#anchor").html(data);
				   hbdyg();  // 合并单元格
			}
	});
}
 // 合并单元格
 function hbdyg() {
            var tab = document.getElementById("spec_input_tab"); //要合并的tableID
            var maxCol = 2, val, count, start;  //maxCol：合并单元格作用到多少列  
            if (tab != null) {
                for (var col = maxCol - 1; col >= 0; col--) {
                    count = 1;
                    val = "";
                    for (var i = 0; i < tab.rows.length; i++) {
                        if (val == tab.rows[i].cells[col].innerHTML) {
                            count++;
                        } else {
                            if (count > 1) { //合并
                                start = i - count;
                                tab.rows[start].cells[col].rowSpan = count;
                                for (var j = start + 1; j < i; j++) {
                                    tab.rows[j].cells[col].style.display = "none";
                                }
                                count = 1;
                            }
                            val = tab.rows[i].cells[col].innerHTML;
                        }
                    }
                    if (count > 1) { //合并，最后几行相同的情况下
                        start = i - count;
                        tab.rows[start].cells[col].rowSpan = count;
                        for (var j = start + 1; j < i; j++) {
                            tab.rows[j].cells[col].style.display = "none";
                        }
                    }
                }
            }
        }
 </script>
<script>

    initFileInput("file-0","<?php echo url('Product/edit'); ?>");
    function initFileInput(ctrlName,uploadUrl) {      
        var control = $('#' + ctrlName);   
        control.fileinput({  
            language: 'zh', //设置语言  
            uploadUrl: uploadUrl,  //上传地址  
            showUpload: true, //是否显示上传按钮  
            showRemove:true,  //显示删除/情况按钮，默认值true
            dropZoneEnabled: true,  //是否显示拖拽区域
            showCaption: true,//是否显示标题 
            showPreview:true, //是否显示文件的预览图
            uploadAsync: false, //设置上传同步异步 此为同步(一次提交4张，如果为true则分4次提交)
            allowedPreviewTypes: ['image'],  
            allowedFileTypes: ['image'],  
            allowedFileExtensions:  ['jpg', 'png','gif','jpeg'], //接收的文件后缀
            maxFileCount: 5,//允许同时上传的最大文件数  
            initialPreviewConfig:{
                caption:ctrlName,
                width:'120px',
                url:uploadUrl,
                key:101,
                success:function(data){ 
                   
                }
            }   
        })   
    }
     function delImg(id)
    {
    	layer.confirm('确认要删除吗？',function(index){
            $.ajax({
				type: 'POST',
				url: "<?php echo url('product/deleImg'); ?>",
				dataType: 'json',
				data:'id='+id,
				success: function(data){
					if (data.code==1) {
						layer.msg(data.msg, {icon:1,time:1000,btn:['确定']},function(){
						 	
						 	window.location.reload()})
					}
					else
					{
						layer.msg(data.msg, {icon:1,time:1000,btn:['确定']},function(){
						 	
						 	location.href=data.url})
					}
					
	                            
				},
				error:function(data) {
					layer.msg(data.msg, {icon:2,time:1000,btn:['确定']},function(){
						 	
						 	})
	                            
				},
		    });		
    	});
    }
  function Formadd(id){
  	var data = new FormData($("#new_form")[0]);
        $.ajax({
            url:'<?php echo url('Product/edit'); ?>',
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
                          parent.location.href=data.url;
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
<script type="text/javascript">
//是否添加水印
 function chg(obj)
   {
            if (obj.value == 0) {
                $('#city').css('display','none');
                $('#area').css('display','none');
                $('#qq').css('display','none');
                cityEle.options.length = 0;
                areaEle.options.length = 0;
                qqEle.options.length = 0;
            }
            else
            {
                $('#city').css('display','inline');
                $('#area').css('display','inline');
                $('#qq').css('display','inline');
            }
    }
  
</script>
</body>
</html>