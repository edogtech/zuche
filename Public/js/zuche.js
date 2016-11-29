$(function(){
	$("td,th").css({'text-align':'center','vertical-align':'middle'});
	//翻页按钮
	$('.next,.prev').css({'display':'block','width':'50px','height':'20px','background':'#337ab7','font-size':'20px','line-height':'20px','text-align':'center','border-radius':'3px','margin':'5px 4px 0px 0px','float':'left','color':'#DAEAFF'});
	$('.num,.current').css({'display':'block','width':'20px','height':'20px','background':'#337ab7','font-size':'14px','line-height':'20px','text-align':'center','border-radius':'3px','margin':'5px 4px 0px 0px','float':'left','color':'#DAEAFF'});
	$('.first,.end').css({'display':'block','width':'40px','height':'20px','background':'#337ab7','font-size':'14px','line-height':'20px','text-align':'center','border-radius':'3px','margin':'5px 4px 0px 0px','float':'left','color':'#DAEAFF'});
	$('.current').css({'color':'#fff','background':'#666'});
		
	$('.next,.prev,.num,.first,.end').mouseover(function(){
		$(this).css({'background':'#67c1f5','color':'#ffffff'});
	}).mouseout(function(){
		$(this).css({'background':'#337ab7','color':'#DAEAFF'});
	})
	
	$('.tab_item_overlay').mouseover(function(){
		$(this).css('border','1px solid #324A66');	
	}).mouseout(function(){
		$(this).css('border','1px solid #16202D');
	})


	// 导出
    $('#export').click(function () {
    	 var selectValue=$("#paytype option:selected").val();  //获取Select选择值
    	 var textValue = $("#ordeno").val();//获取text值
    	alert("select值："+selectValue+" text值:"+textValue);
        location.href = 'http://localhost/zuche/admin/ExportOrders/?ordernumber='+textValue+'&paytype='+selectValue;
    })

   	//弹出框(用户界面)
	$('#exampleModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//修改加入我们的传值
		var id= button.data('id');
		var idimg= button.data('idimage');
		var diimg= button.data('diimage');
		var name= button.data('name');
		var phone= button.data('phone');
		
		var modal = $(this);
		modal.find('.modal-title').text(name);//在弹出框头部输出的信息
		modal.find('#idimg').attr("src",idimg);
		modal.find('#diimg').attr("src",diimg);
		modal.find('.hidden_id').val(id);
		modal.find('.hidden_phone').val(phone);

	})


	//弹出框(品牌修改)
	$('#modify_brand').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');
		var name= button.data('name');

		var modal = $(this);
		modal.find('#brand_id').val(id);
		modal.find('#brand_name').val(name);

	})

	//弹出框(车型/品牌删除)
	$('#delete_brand').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//修改加入我们的传值
		var id= button.data('id');
		var name= button.data('name');

		var modal = $(this);
		modal.find('#del_brand_id').val(id);
		modal.find('#del_brand_name').text('您将要删除的内容：'+name);

	})
	
	//弹出框(订单列表详情)
	$('#myModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var orderno= button.data('number');//订单编号
		var id= button.data('id');
		var uname= button.data('uname');
		var start_time= button.data('start_time');
		var end_time= button.data('end_time');
		var borrow_time= button.data('borrow_time');
		var deposit= button.data('deposit');		
		var return_time= button.data('return_time');
		var fixed_use_time= button.data('fixed_use_time');				
		var actual_use_time= button.data('actual_use_time');
		var excess_use_time= button.data('excess_use_time');
		var price= button.data('price');
		var excess= button.data('excess');
		var excess_fee= button.data('excess_fee');
		var actual_total_fee= button.data('actual_total_fee');
		var payment= button.data('payment');		
				
		var modal = $(this);
		modal.find('.modal-title').text("订单编号："+orderno);//头部信息
		//内容
		modal.find('#id').text(id);
		modal.find('#uname').text(uname);
		modal.find('#start_time').text(start_time);
		modal.find('#end_time').text(end_time);
		modal.find('#borrow_time').text(borrow_time);
		modal.find('#deposit').text(deposit);
		modal.find('#return_time').text(return_time);
		modal.find('#fixed_use_time').text(fixed_use_time);		
		modal.find('#actual_use_time').text(actual_use_time);
		modal.find('#excess_use_time').text(excess_use_time);
		modal.find('#price').text(price);
		modal.find('#excess').text(excess);
		modal.find('#excess_fee').text(excess_fee);
		modal.find('#actual_total_fee').text(actual_total_fee);
		modal.find('#payment').text(payment);
	})

	//图片上传预览
	$("#upload").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120, ImgType: ["gif", "jpeg", "jpg", "bmp", "png"], Callback: function () { }});


	//省级地区选择列出城市列表
	$("#province").change(function(){
		var id=$(this).find("option:selected").attr("data");
		$.post("/zuche/index.php/Admin/Car/city",{id:id},function(msg){
			
		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['name']+"' data='"+msg[i]['id']+"'>"+msg[i]['name']+"</option>"
		    }
		    $("#city").html(connect);
		    //选择省级地区是给出市级地区同时要清空县级地区
		    $("#county").html("<option value=''>--请选择--</option>");

		},'json');


	})

	//城市地区选择列出县区列表
	$("#city").change(function(){
		var id=$(this).find("option:selected").attr("data");
		$.post("/zuche/index.php/Admin/Car/county",{id:id},function(msg){

		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['name']+"' data='"+msg[i]['guid']+"'>"+msg[i]['name']+"</option>"
		    }
		    $("#county").html(connect);
		},'json');


	})

	//最终选择县区后吧县区的city id 写入隐藏域
	$("#county").change(function(){
		var guid=$(this).find("option:selected").attr("data");
		$("#city_id").val(guid);
		

	})

	//站点修改界面是否修改地区
	$(":checkbox[name='check_area[]']").click(function(){
		//:checkbox 选取的是对象组  所以要从中取出具体的对象再进一步操作
		console.log($(this).get(0).checked);
		if($(this).get(0).checked){
			$(".check_area").css({ "display": "block"});
		}else{
			$(".check_area").css({ "display": "none"});
		}

	})
	
		//限制添加车辆的品牌下的型号
	$("#car_brand").change(function(){
		var id=$(this).find("option:selected").val();
		$.post("/zuche/index.php/Admin/Car/brand_model",{id:id},function(msg){

		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['id']+"' >"+msg[i]['name']+"</option>"
		    }
		    $("#car_model").html(connect);
			//console.log(msg);
		},'json');

	})
	
	

/*By ZXD Begin*/

	//弹出框(订单列表详情)
	$('#myModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var orderno= button.data('number');//订单编号
		var id= button.data('id');
		var uname= button.data('uname');
		var start_time= button.data('start_time');
		var end_time= button.data('end_time');
		var deposit= button.data('deposit');		
		var return_time= button.data('return_time');
		var fixed_use_time= button.data('fixed_use_time');				
		var actual_use_time= button.data('actual_use_time');
		var excess_use_time= button.data('excess_use_time');
		var fixed_total_fee= button.data('fixed_total_fee');
		var excess= button.data('excess');
		var excess_fee= button.data('excess_fee');
		var actual_total_fee= button.data('actual_total_fee');
		var payment= button.data('payment');		
				
		var modal = $(this);
		modal.find('.modal-title').text("订单编号："+orderno);//头部信息
		//内容
		modal.find('#id').text(id);
		modal.find('#uname').text(uname);
		modal.find('#start_time').text(start_time);
		modal.find('#end_time').text(end_time);
		modal.find('#deposit').text(deposit);
		modal.find('#return_time').text(return_time);
		modal.find('#fixed_use_time').text(fixed_use_time);		
		modal.find('#actual_use_time').text(actual_use_time);
		modal.find('#excess_use_time').text(excess_use_time);
		modal.find('#fixed_total_fee').text(fixed_total_fee);
		modal.find('#excess').text(excess);
		modal.find('#excess_fee').text(excess_fee);
		modal.find('#actual_total_fee').text(actual_total_fee);
		modal.find('#payment').text(payment);
	})	
	
	//弹出框(退款审核)
	$('#checkModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var orderno= button.data('number');//订单编号
		var id= button.data('id');
		var uname= button.data('uname');
		var initiate_time= button.data('initiate_time');
		var refund= button.data('refund');		
		var suggestion= button.data('suggestion');
		var check_time= button.data('check_time');	
				
		var modal = $(this);
		modal.find('.modal-title').text("订单编号："+orderno);//头部信息
		//内容
		modal.find('#id').text(id);
		modal.find('#uname').text(uname);
		modal.find('#initiate_time').text(initiate_time);
		modal.find('#refund').text(refund);		
		modal.find('#suggestion').text(suggestion);
		modal.find('#check_time').text(check_time);
	})
	
	//弹出框(删除：轮播图/系统用户)
	$('#CarouselDelModal,#AdminUserDelModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');

		var modal = $(this);
		modal.find('#delCarouselId,#delAdminUserId').val(id);
	})
	
	//弹出框(轮播图编辑)
	$('#CarouselEditModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');
		var caption= button.data('caption');
		var url= button.data('url');
		var summary= button.data('summary');
		var image= button.data('image');

		var modal = $(this);
		modal.find('#editCarouselId').val(id);
		modal.find('#txtCaptionCarousel').val(caption);
		modal.find('#txtUrlCarousel').val(url);
		modal.find('#txtSummaryCarousel').val(summary);
		//modal.find('#ImgPreCarousel').src(image);
		modal.find('#ImgPreCarousel').attr('src',image); 
		//alert(image);
	})
	//弹出框(系统用户编辑)
	$('#AdminUserEditModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');
		var role= button.data('role');
		var nickname= button.data('nickname');
		var password= button.data('password');
		//var txtPwd2= button.data('txtPwd2');
		var phone= button.data('phone');
		var email= button.data('email');
		var status= button.data('status');
		var memo= button.data('memo');

		var modal = $(this);
		modal.find('#id').val(id);
		modal.find('#selRole').val(role);
		modal.find('#txtNickname').val(nickname);
		modal.find('#txtPwd').val(password);
		modal.find('#txtPwd2').val(password);
		modal.find('#txtPhone').val(phone);
		modal.find('#txtEmail').val(email); 
		modal.find('#selStatus').val(status); 
		modal.find('#txtMemo').val(memo); 
		//alert(password);
	})
	
	//弹出框(长租消费流水账单)
	$('#RentLongModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');
		var type= button.data('type');
		var number= button.data('number');
		var type= button.data('type');
		var date= button.data('date');
		var payment= button.data('payment');
		var credit= button.data('credit');
		var total= button.data('total');

		var modal = $(this);
		modal.find('#id').text(id);
		modal.find('#type').text(type);
		modal.find('#number').text(number);
		modal.find('#type').text(type);
		modal.find('#date').text(date);
		modal.find('#payment').text(payment);
		modal.find('#credit').text(credit);
		modal.find('#total').text(total);
	})	
	
		//弹出框(系统参数编辑)
	$('#ParameterEditModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//传值
		var id= button.data('id');
		var variable= button.data('variable');
		//var vars= button.data('variable');
		var value= button.data('value');
		var name= button.data('name');
		var desc= button.data('desc');
		var unit= button.data('unit');
		
		var modal = $(this);
		modal.find('#id').val(id);//hidden值
		modal.find('#lbVar').text(variable);
		modal.find('#txtValue').val(value);
		modal.find('#lbName').text(name);
		modal.find('#txtDesc').text(desc);
		modal.find('#lbUnit').text(unit);
		modal.find('#vars').val(variable);//hidden值
		
		//alert(image);
	})
	
	// 订单列表导出
    $('#order_exp').click(function () {
    	 var paytype=$("#paytype option:selected").val(); //获取Select选择值
	   	 var orderno = $("#orderno").val();//获取text值
		 var dtpicker_list = $("#dtpicker_list").val();//获取text值
		 var dtpicker_list2 = $("#dtpicker_list2").val();//获取text值
		 alert("订单值："+orderno+" 日期值1:"+dtpicker_list);
        location.href = 'http://localhost/zuche/admin/OrdersExport/index?ordernumber='+orderno+'&paytype='+paytype+'&dtpickerA='+dtpicker_list+'&dtpcikerB='+dtpicker_list2;
    	//location.href ='http://localhost/zuche/admin/OrdersExport/index';
    }) 
    
    //退款列表导出
    $('#refund_exp').click(function () {
	 var refundno = $("#refundno").val();//获取订单号text值
	 var dtpicker_check = $("#dtpicker_check").val();//获取日期text值
	 var dtpicker_check2 = $("#dtpicker_check2").val();//获取日期text值
	//alert("订单值："+refundno+" 日期值1:"+dtpicker_check);
    location.href = 'http://localhost/zuche/admin/RefundExport/index?ordernumber='+refundno+'&dtpickerA='+dtpicker_check+'&dtpickerB='+dtpicker_check2;
    })  
    
    //时间日期js选择框
//    $('#dtpicker_check,#dtpicker_check2,#dtpicker_list,#dtpicker_list2,#dtpicker_carousel,#dtpicker_carousel2').datetimepicker({
//    	autoclose:true
//    })

    //图片上传（轮播图）
	$("#fileImgCarouselEdit").uploadPreview({ Img: "ImgPrEdit", Width: 120, Height: 120, ImgType: ["gif", "jpeg", "jpg", "bmp", "png"], Callback: function () { }});
	$("#fileImgCarouselAdd").uploadPreview({ Img: "ImgPrAdd", Width: 120, Height: 120, ImgType: ["gif", "jpeg", "jpg", "bmp", "png"], Callback: function () { }});
/*By ZXD End*/


/*长租业务界面开始*/

	//长租业务办理选择省级单位列出市级单位
	$("#prov").change(function(){
		var province=$(this).find("option:selected").val();
		$.post("/index.php/Admin/Business/citylist",{province:province},function(msg){
		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['city']+"' >"+msg[i]['city']+"</option>"
		    }
		    $("#cit").html(connect);
		    //选择省级地区是给出市级地区同时要清空县级地区和站点信息
		    $("#coun").html("<option value=''>--请选择--</option>");
		    $("#station").html("<option value=''>--请选择--</option>");
		    $("#car_id").html("<option value=''>--请选择--</option>");
		    $("#car_rent").html("");
		},'json');

	})

	//长租业务办理选择市级单位列出区级单位
	$("#cit").change(function(){
		var city=$(this).find("option:selected").val();
		var province=$("#prov").find("option:selected").val()
		$.post("/index.php/Admin/Business/countylist",{city:city,province:province},function(msg){
		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['county']+"' >"+msg[i]['county']+"</option>"
		    }
		    $("#coun").html(connect);
		    
		    $("#station").html("<option value=''>--请选择--</option>");
		    $("#car_id").html("<option value=''>--请选择--</option>");
		    $("#car_rent").html("");
		},'json');

	})

	//长租业务办理选择区级单位列出车站
	$("#coun").change(function(){
		var province=$("#prov").find("option:selected").val()
		var county=$(this).find("option:selected").val();
		$.post("/index.php/Admin/Business/stationlist",{county:county,province:province},function(msg){
		    var count=msg.length;
		    var connect="<option value=''>--请选择--</option>";
		    for(var i=0;i<count;i++){
		    	connect+="<option value='"+msg[i]['id']+"' >"+msg[i]['name']+"</option>"
		    }
		    $("#station").html(connect);

		    $("#car_id").html("<option value=''>--请选择--</option>");
		    $("#car_rent").html("");
		},'json');

	})

	//选择站点列出具体车辆信息
	$("#station").change(function(){
		var id=$(this).find("option:selected").val()
		$.post("/index.php/Admin/Business/carlist",{id:id},function(msg){

			if(msg==null){
				$("#car_id").html("<option value=''>此站点暂无车辆信息</option>");
			}else{		
			    var count=msg.length;
			    var connect="<option value=''>--请选择--</option>";
			    for(var i=0;i<count;i++){
			    	connect+="<option value='"+msg[i]['id']+"' plate='"+msg[i]['plate']+"' >"+msg[i]['brand']+msg[i]['model']+"&nbsp;&nbsp;&nbsp;&nbsp;车牌号:"+msg[i]['plate']+"</option>"
			    }
			    $("#car_id").html(connect);
			    $("#car_rent").html("");
			}

		},'json');

	})

	//选择句车辆列出车辆出租的信息(把车牌号写入隐藏域)
	$("#car_id").change(function(){
		var id=$(this).find("option:selected").val()
		var plate=$(this).find("option:selected").attr('plate')
		$.post("/index.php/Admin/Business/car_rent",{id:id},function(msg){
			if(msg==null){
				$("#car_rent").html("<p>此车辆目前没有出租信息</p>");
			}else{		
			    var count=msg.length;
			    var connect="";
			    for(var i=0;i<count;i++){
			    	connect+="<p>"+msg[i]['start_time']+"至"+msg[i]['end_time']+"</p>";
			    }
			    $("#car_rent").html(connect);
			}
			//隐藏域中写入选中的车牌号
			$("#plate").val(plate);
		},'json');

	})
	
	$("#reckon_price").click(function(){
		var start_time=$("input[name='start_time']").val();
		var end_time=$("input[name='end_time']").val();
		$.post("/index.php/Admin/Business/reckon_price",{start_time:start_time,end_time:end_time},function(msg){
			$("input[name='price']").val(msg);
		});

	})

/*长租业务界面结束*/



})

