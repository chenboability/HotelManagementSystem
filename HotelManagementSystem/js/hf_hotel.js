// JavaScript Document
var food_total;
//客房管理-生成订单
$(function(){
    $("tr.room_add1").click(function(){
      	var add_day1=$("#day").val();
      	var text = $(this).text();
      	var arr = splitword(text);
	    $("#mymodal").modal("toggle");
		$("#day1").val(add_day1);
		$("#roomid").val(arr[0]);
    });
  });    

//客房管理-查询
$(function(){
    $("#room_find1").click(function(){
		$("#room_find_table").append("<tr><td>name</td><td>name2</td><td>name3</td><td>name4</td><td>name5</td><td>name6</td></tr>");
	});
  });

//客房订单管理-查询
$(function(){
    $("#room_order_find1").click(function(){
		$("#room_order_find_table").append("<tr><td>name</td><td>name2</td><td>name3</td><td>name4</td><td>name5</td><td>name6</td></tr>");
	});
  });

//客房订单管理-修改订单
$(function(){
    $("tr.room_order_add1").click(function(){
		var text = $(this).text();
	    var arr = splitword(text);
		$("#mymodal_room_order").modal("toggle");
		$("#id").val(arr[0]);
		$("#roomid").val(arr[1]);
		$("#day1").val(arr[2]);
		$("#day2").val(arr[3]);
		$("#day").val(arr[4]);
		$("#sum").val(arr[5]);
		$("#customer").val(arr[6]);
		$("#type").val(arr[7]);
		$("#phone").val(arr[8]);
		$("#money").val(arr[9]);
		$("#choose").val(arr[10]);		
    });
  });   













//餐饮-点菜-模态框
$(function (){ 
	$("#food_add1").click(function(){
	$("#modaltable  tr:not(:first)").html("");
	$("#mymodal_food").modal("toggle");
	food_total=0;
	var sum=0;
	$('.hhh input[name="choose"]:checked').each(function(){
	   food_total=food_total+1;
	   var text1=$(this).parents(".hhh").find("h2").text();
	   var text2=$(this).parents(".hhh").find("h3").text();
	   var text3=$(this).parents(".hhh").find("#num").val();
	   var text4=$(this).parents(".hhh").find("p").text();
	   sum+=text3*text4;
       $('#modaltable').append("<tr><td>"+text1+
					    	" </td><td>"+text2+
					    	" </td><td>"+text3+
					    	" </td><td>"+text4+
					    	" </td></tr>"); 
      });
      $('#food_add_sum').text("合计："+sum+"元") ;
    });
   });
  

//餐饮-点菜-模态框-外卖堂食切换
$(function(){
	 showCont();
	 $("input[name=choose2]").click(function(){
	  showCont();
	 });
});
function showCont(){
 switch($("input[name=choose2]:checked").attr("id")){
  case "堂食":
   $("#p_address").hide();
   $("#p_phone").hide();
   $("#p_tablenum").show();
   break;
  case "外卖":
   $("#p_tablenum").hide();
   $("#p_address").show();
   $("#p_phone").show();
   break;
  default:
   $("#p_tablenum").hide();
   $("#p_address").hide();
   $("#p_phone").hide();
   break;
  }
}

//餐饮-点菜-模态框加载
$(function(){
    $("#food_add3").click(function(){
    	var text = $('#modaltable').text();
		//$("#modaltable  tr:not(:first)").html("");
	    var arr = splitword(text);
		var food_dep=$("#dep").val();
		var data="food_total="+food_total
		+"&food_dep="+food_dep;
	    for(var i=1;i<=food_total;i++)
	    {
			var food_id=parseInt(arr[i*4+0]);
			var food_name=arr[i*4+1];
			var food_num=parseInt(arr[i*4+2]);
			var food_pay=parseInt(arr[i*4+3]);
			data += "&food_id"+i+"="+food_id+","+food_name+","+food_num+","+food_pay;
		}
		    switch($("input[name=choose2]:checked").attr("id")){
			  case "堂食":
			   var food_tablenum=$("#tablenum").val();
			   //data += "&food_id"+i+food_id+","+food_name+","+food_num+","+food_pay+","+food_tablenum;
			   data+="&food_address="+food_tablenum;
			   break;
			  case "外卖":
			   var food_address=$("#address").val();
			   var food_phone=$("#phone").val();
			   
			   // if(i>0)data+="&";
			   data+="&food_address="+food_address+""+food_phone;
			   //data += "&food_id"+i+food_id+","+food_name+","+food_num+","+food_pay+","+food_address+food_phone;
			   break;
			  default:;
			}
			//alert(data);
			$.getJSON('add_order.php',data, function(json){
				alert("成功");
			});
			
			window.location.reload(); 
		
	});
});
	


//餐饮-点菜-网页自动加载
$(function (){ 
	$("button.btn btn-default").click(function(){
	//alert("1");
    });
   });
  


//餐饮订单管理-查询
$(function(){
    $("#food_order_find1").click(function(){
	//	alert(1);
		$("#food_order_find_table  tr:not(:first)").html("");
		var day1=$("#i1").val();
		var day2=$("#i2").val();
		var i4=$("#i4 option:selected").text();
		var sum=$("#i3").val();
		var food_order_state2=$("#food_order_state2 option:selected").val();
		var data="day1="+day1+"&day2="+day2+"&i4="+i4+"&sum="+sum+"&food_order_state2="+food_order_state2;
		//alert(data);
		
		//$("#food_order_find_table").append("<tr><td>name</td><td>name2</td><td>name3</td><td>name4</td><td>name5</td><td>name6</td></tr>");
		$.getJSON('select.php',data, function(json){ 
		
        js = eval(json.op);
        //alert(js.length); 	
			
				for(var i=0;i<js.length;i++)
				{ 	
				//$("#food_order_find_table").append("<tr><td>"+"haha"+"</td></tr>");
				var tmp = js[i].Order_state;
				 if(js[i].Order_state==1)tmp="未结算";
				  if(js[i].Order_state==2)tmp="已结算";
				  
					$("#food_order_find_table").append("<tr><td>"+js[i].Order_time+" </td><td>"
					+js[i].Order_times+" </td><td>"+js[i].Order_id+" </td><td>"
					+js[i].Order_money+" </td><td>"+js[i].Order_people_id+" </td><td>"+tmp+" </td></tr>");
				}
		});
	});
  });

  
//餐饮-修改订单

  $(function(){
    $("#food_order_find_table").on("click","tr",function(){
		var text = $(this).text();
	    var arr = splitword(text);
		$("#mymodal_food_order").modal("toggle");
		$("#food_order_day").val(arr[0]);
		$("#food_order_time").val(arr[1]);
		$("#food_order_id").val(arr[2]);
		$("#food_order_sum").val(arr[3]);
		$("#food_order_pid").val(arr[4]);
		$("#food_order_state").val(arr[5]);	
    });
  });

//餐饮-修改订单-模态框加载
$(function(){
	$("#food_order_add2").click(function(){
		var day=$("#food_order_day").val();
		var time=$("#food_order_time").val();
		var id=$("#food_order_id").val();
		var sum=$("#food_order_sum").val();
		var pid=$("#food_order_pid").val();
		var state=$("#food_order_state").val();
		var data = "food_order_day="+day+"&food_order_time="+time+"&food_order_id="+id+"&food_order_sum="+sum+"&food_order_pid="+pid+"&food_order_state="+state;
		//alert(data);
		$.getJSON('change.php',data, function(json){ 
			
		
		});
		//location.reload(false) ;
		window.location.reload(); 
	});
}) ;


//显示所有食物
$(function(){
 	$("#food_add1").ready(function(){//后台写的
		
		
		  $.getJSON('showall.php',null, function(json){ 
		 //alert(1);
         js = eval(json.op);
		 //alert(1);
         //alert(js.length);
		 
				for(var i=0;i<js.length;i++)
				{ 	
					//$("#food_item_table").append("<tr><td>"+"haha"+"</td></tr>");
					            //<div class="row" id="food_item_table">
								
			  $("#food_item_table").append("<div class='f2 col-lg-3 img-thumbnail'><div class='thumbnail'><img src='"+js[i].Food_pic+"' alt='通用的占位符缩略图' style='width :300px;height :220px; ' ></div><div class='hhh  caption'><h2 >"+js[i].Food_id+"</h2><h3 >"+js[i].Food_name+"</h3><p>"+js[i].Food_price+"</p><p><input id='num' name='num' type='number' min='1' max='20'/><div class='checkbox'><label><input type='checkbox' name='choose' id='choose'>选择</label></div></p></div></div>");
	
			  
				}
				
				
		  });
 	});
});

 
//函数-把空格都丢掉
/*
function splitword(text)
{
	var reg = /^\s+|\s+$/g;				//正则表达式 好厉害！！！！！！
    var twname = text.replace(reg,"");
    var regg = /\s+/g;
    var midname = twname.replace(regg," ");
    var arr = midname.split(" ");
	return arr;
	}
*/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//仓库财务
// JavaScript Document
//仓库-出入库-新增-出模态框
$(function(){
    $("#ware_io_add2").click(function(){
		var add_num=$("#ware_io_add_num1").val();
		var add_type=$("#ware_io_add_type1 option:selected").text();
		var add_name=$("#ware_io_add_name1 option:selected").text();
		var add_price=$("#ware_io_add_price1").val();
	//	var add_sum=$("#ware_io_add_sum1").val();
		if((add_num == "")||(add_price == ""))
		{alert('新增输入不能为空');}
		else{
      	$("#ware_io_m1").modal("toggle");
		document.getElementById("ware_io_add_num2").value = add_num;
		document.getElementById("ware_io_add_type2").value = add_type;
		document.getElementById("ware_io_add_name2").value = add_name;
		$("#ware_io_add_price2").val(add_price);
	//	$("#ware_io_add_sum2").val(add_sum);
		}
    });
  });
  
  //仓库-出入库-查询-按钮
$(function(){
    $("#ware_io_find1").click(function(){
		$("#ware_io_find_table").empty();
		//加表头
		$("#ware_io_find_table").append("<tr><td>"+"#"+"</td><td>"+"类型"+"</td><td>"+"物品名称"+"</td><td>"+"数量"+"</td><td>"+"单价"+"</td><td>"+"总额"+"</td><td>"+"时间"+"</td><td>"+"审查员"+"</td></tr>");

		var ba=$("#ware_io_find_type8 option:selected").text();
		if(ba == '入库登记')
			ba=1;
		else
			ba=2;
		var name=$("#ware_io_find_name8 option:selected").text();
		var date=$("#ware_io_find_date8").val();
        var data = "type="+ba+"&name="+name+"&day="+date;
		
		$.getJSON('query_note.php',data, function(json){   
        js = eval(json.op) 		
				for(var i=0;i<js.length;i++)
				{ 		
					$("#ware_io_find_table").append("<tr><td>"+js[i].id+" </td><td>"+js[i].type+" </td><td>"+js[i].name+" </td><td>"+js[i].num+" </td><td>"+js[i].price+" </td><td>"+js[i].rental+" </td><td>"+js[i].time+" </td><td>"+js[i].person+" </td></tr>");
				}
		});
			                                       
	});
  });
  
//仓库-物品-查询-按钮
$(function(){
    $("#ware_item_find1").click(function(){
		$("#ware_item_find_table").empty();
		//加表头
		$("#ware_item_find_table").append("<tr><td>"+"#"+"</td><td>"+"名3称"+"</td><td>"+"单价"+"</td><td>"+"规格"+"</td><td>"+"单位"+"</td><td>"+"有效期"+"</td><td>"+"最低数量"+"</td><td>"+"数量"+"</td><td>"+"位置"+"</td><td>"+"供应商"+"</td></tr>");
		
		var name=$("#ware_item_find_name3 option:selected").text();
		var position=$("#ware_item_find_locate8 option:selected").text();
		var date=$("#ware_item_find_date3").val();
		var ba=$("#ware_item_find_ba3 option:selected").text();
		if(ba == '之前')
			ba=1;
		else
			ba=2;

        var data = "name="+name+"&day="+date+"&type="+ba+"&position="+position;	
		$.getJSON('query_item.php',data, function(json){   
        js = eval(json.op)   		
				for(var i=0;i<js.length;i++)
				{ 		
					$("#ware_item_find_table").append("<tr><td>"+js[i].id+" </td><td>"+js[i].name+" </td><td>"+js[i].price+" </td><td>"+js[i].size+" </td><td>"+js[i].unit+" </td><td>"+js[i].validity+" </td><td>"+js[i].min+" </td><td>"+js[i].count+" </td><td>"+js[i].place+" </td><td>"+js[i].supplier+" </td></tr>");
				}
		});
	});
  });
  
//仓库-出入库-加载
$(function(){
    $("#ware_io_add2").ready(function(e) {
		$.getJSON('init_note.php',null, function(json){		
                js = eval(json.op)     				
				for(var i=0;i<js.length;i++)
				{
					$("#ware_io_add_name1").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
					$("#ware_io_find_name8").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
				}
            });
		
    });
  });
  
//仓库-供应商-加载
$(function(){
    $("#ware_supply_add1").ready(function(e) {
		
		$.getJSON('query_supplier.php',null, function(json){  
        js = eval(json.op) 		
				for(var i=0;i<js.length;i++)
				{ 		
					$("#ware_supply_table").append("<tr class='ware_supply_find'><td>"+js[i].id+" </td><td>"+
					js[i].name+" </td><td>"+js[i].pricipal+" </td><td>"+js[i].phone+" </td><td>"+js[i].adderss+" </td></tr>");
				}
		});
    });
  });
  
  //仓库-物品-加载
$(function(){
    $("#ware_item_add2").ready(function(e) {
      var data = ""; 
		$.getJSON('init_note.php',null, function(json){		
                js = eval(json.op)     				
				for(var i=0;i<js.length;i++)
				{
					$("#ware_item_find_name3").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
				}
            });
			$.getJSON('init_locate.php',null, function(json){		
                js = eval(json.op)     				
				for(var i=0;i<js.length;i++)
				{
					$("#ware_item_find_locate8").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
					$("#ware_item_add_locate1").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
				}
            });
			$.getJSON('init_applier.php',null, function(json){		
                js = eval(json.op)     				
				for(var i=0;i<js.length;i++)
				{
					$("#ware_item_add_supply1").append("<option value="+json.op[i]+">"+(json.op[i])+"</option>");
				}
            });
		
    });
  });
//仓库-供应商-表格-点击出模态ok
$(function(){
    $("#ware_supply_table").on("click","tr",function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#ware_supply_m2").modal("toggle");
	$("#ware_supply_find_id2").val(arr[0]);
	$("#ware_supply_find_sup2").val(arr[1]);
	$("#ware_supply_find_name2").val(arr[2]);
	$("#ware_supply_find_tel2").val(arr[3]);
	$("#ware_supply_find_add2").val(arr[4]);
	$("#ware_supply_find_id8").val(arr[0]);
	});
  });
  
//函数-把空格都丢掉
function splitword(text)
{
	var reg = /^\s+|\s+$/g;				//正则表达式 好厉害！！！！！！
    var twname = text.replace(reg,"");
    var regg = /\s+/g;
    var midname = twname.replace(regg," ");
    var arr = midname.split(" ");
	return arr;
	}

//仓库-出入库-表格-点击出模态
$(function(){
    $("#ware_io_find_table").on("click","tr",function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#ware_io_m2").modal("toggle");
	$("#ware_io_find_id2").val(arr[0]);
	$("#ware_io_find_type2").val(arr[1]);
	$("#ware_io_find_name2").val(arr[2]);
	$("#ware_io_find_num2").val(arr[3]);
	$("#ware_io_find_price2").val(arr[4]);
	$("#ware_io_find_sum2").val(arr[5]);
	$("#ware_io_find_date2").val(arr[6]);
	$("#ware_io_find_uid2").val(arr[7]);
	});
  });
  
//仓库-物品-新增-出模态框
$(function(){
    $("#ware_item_add2").click(function(){
		var t1=$("#ware_item_add_name1").val();
		var t2=$("#ware_item_add_price1").val();
		var t3=$("#ware_item_add_standard1").val();
		var t4=$("#ware_item_add_dw1").val();
		var t5=$("#ware_item_add_date1").val();
		var t6=$("#ware_item_add_lnum1").val();
		var t7=$("#ware_item_add_locate1 option:selected").text();
		var t8=$("#ware_item_add_supply1 option:selected").text();
		if((t1 == "")||(t2 == "")||(t3 == "")||(t4 == "")||(t5 == "")||(t6 == ""))
		{alert('新增输入不能为空');}
		else{
      	$("#ware_item_m1").modal("toggle");
		$("#ware_item_add_name2").val(t1);
		$("#ware_item_add_price2").val(t2);
		$("#ware_item_add_standard2").val(t3);
		$("#ware_item_add_dw2").val(t4);
		$("#ware_item_add_date2").val(t5);
		$("#ware_item_add_lnum2").val(t6);
		$("#ware_item_add_locate2").val(t7);
		$("#ware_item_add_supply2").val(t8);
		}
    });
  });
  

//仓库-物品-表格-点击出模态
$(function(){
    $("#ware_item_find_table").on("click","tr",function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#ware_item_m2").modal("toggle");
	$("#ware_item_find_id2").val(arr[0]);
	$("#ware_item_find_name2").val(arr[1]);
	$("#ware_item_find_price2").val(arr[2]);
	$("#ware_item_find_standard2").val(arr[3]);
	$("#ware_item_find_dw2").val(arr[4]);
	$("#ware_item_find_date2").val(arr[5]);
	$("#ware_item_find_lnum2").val(arr[6]);
	$("#ware_item_find_num2").val(arr[7]);
	$("#ware_item_find_locate2").val(arr[8]);
	$("#ware_item_find_supply2").val(arr[9]);
	$("#ware_item_find_id8").val(arr[0]);
	});
  });
//仓库-供应商-新增-出模态框
$(function(){
    $("#ware_supply_add1").click(function(){
		var t1=$("#ware_supply_add_sup1").val();
		var t2=$("#ware_supply_add_name1").val();
		var t3=$("#ware_supply_add_tel1").val();
		var t4=$("#ware_supply_add_add1").val();
		if((t1 == "")||(t2 == "")||(t3 == "")||(t4 == ""))
		{alert('新增输入不能为空');}
		else{
      	$("#ware_supply_m1").modal("toggle");
		$("#ware_supply_add_sup2").val(t1);
		$("#ware_supply_add_name2").val(t2);
		$("#ware_supply_add_tel2").val(t3);
		$("#ware_supply_add_add2").val(t4);
		}
    });
  });
  

  //财务-审批-表格-点击出模态
$(function(){
    $("#check_table").on("click","tr",function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#money_check_m1").modal("toggle");
	$("#money_check_find_id2").val(arr[0]);
	$("#money_check_find_dep2").val(arr[1]);
	$("#money_check_find_user2").val(arr[2]);
	$("#money_check_find_date2").val(arr[3]);
	$("#money_check_find_sum2").val(arr[4]);
	$("#money_check_find_rea2").val(arr[5]);
	$("#money_check_find_state2").val(arr[6]);
	});
  });
  
//财务-结算-新增-出模态框
$(function(){
    $("#money_acc_add1").click(function(){
		var t1=$("#money_acc_add_jstype1 option:selected").text();
		var t3=$("#money_acc_add_dep1 option:selected").text();
		var t4=$("#money_acc_add_date1").val();
		var t5=$("#money_acc_add_isum1").val();
		var t6=$("#money_acc_add_osum1").val();
		if((t5 == "")||(t4 == "")||(t6 == ""))
		{alert('新增输入不能为空');}
		else{
      	$("#money_acc_m1").modal("toggle");
		$("#money_acc_add_jstype2").val(t1);
		$("#money_acc_add_dep2").val(t3);
		$("#money_acc_add_date2").val(t4);
		$("#money_acc_add_isum2").val(t5);
		$("#money_acc_add_osum2").val(t6);
		}
    });
  });
  
//财务-结算-表格-点击出模态
$(function(){
    $("#money_acc_table").on("click","tr",function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#money_acc_m2").modal("toggle");
	$("#money_acc_find_jstype2").val(arr[0]);
	$("#money_acc_find_dep2").val(arr[1]);
	$("#money_acc_find_date2").val(arr[2]);
	$("#money_acc_find_isum2").val(arr[3]);
	$("#money_acc_find_osum2").val(arr[4]);
	$("#money_acc_find_sum2").val(arr[5]);
	});
  });
  
//??财务-结算-表格-点击出模态
$(function(){
    $("tr.user_email_find").click(function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#user_email_m1").modal("toggle");
	$("#user_email_find_title2").text(arr[2]);
	$("#user_email_find_name2").text(arr[1]);
	$("#user_email_find_time2").text(arr[3]);
	});
  });
  //财务-结算-查询-按钮
$(function(){
    $("#money_acc_find1").click(function(){
		$("#money_acc_table").empty();
		//加表头
		$("#money_acc_table").append("<tr><td>"+"结算类型"+"</td><td>"+"部门"+"</td><td>"+"时间"+"</td><td>"+"收入金额"+"</td><td>"+"支出金额"+"</td><td>"+"总金额"+"</td></tr>");
		
		var t1=$("#money_acc_find_jstype1 option:selected").text();
		var t2=$("#money_acc_find_dep1 option:selected").text();
		var t3=$("#money_acc_find_ftime1").val();
		var t4=$("#money_acc_find_ttime1").val();
        var data = "jstype="+t1+"&dep="+t2+"&ftime="+t3+"&ttime="+t4;
		
		$.getJSON('query_count.php',data, function(json){ 	
        js = eval(json.op)   		
				for(var i=0;i<js.length;i++)
				{ 		
					$("#money_acc_table").append("<tr><td>"+js[i].Rjs_t+" </td><td>"+js[i].Rjs_bm+" </td><td>"+js[i].Rjs_rq+" </td><td>"+js[i].Rjs_sr+" </td><td>"+js[i].Rjs_zc+" </td><td>"+js[i].Rjs_zong+" </td></tr>");
				}
		});
		
	});
  });
  
//财务-收支-查询-按钮
$(function(){
    $("#money_check_find").click(function(){
		$("#money_tab_find").empty();
		//加表头
		$("#money_tab_find").append("<tr><td>"+"#"+"</td><td>"+"时间"+"</td><td>"+"部门"+"</td><td>"+"金额"+"</td></tr>");
		var t2=$("#money_io_find_dep1 option:selected").text();
		var t1=$("#money_io_find_date1").val();
		
		var data = "date="+t1+"&department="+t2;
		$.getJSON('query_io.php',data, function(json){				
        js = eval(json.op) 
        var co = 0;
		var coint = parseInt(co);
				for(var i=0;i<js.length;i++)
				{ 		
					$("#money_tab_find").append("<tr><td>"+js[i].Sz_id+"</td><td>"+js[i].Sz_rq+"</td><td>"+js[i].Sz_bm+"</td><td>"+js[i].Sz_je+"</td></tr>");
					coint+=parseInt(js[i].Sz_je);
				}
				
				$("#money_check_find_date1").val(coint);
		});
	});
  });
//财务-工资-查询-按钮
$(function(){
    $("#money_check_find").click(function(){
		$("#money_sa_find").empty();
		//加表头
		$("#money_sa_find").append("<tr><td>"+"#"+"</td><td>"+"姓名"+"</td><td>"+"部门"+"</td><td>"+"工资"+"</td></tr>");
		var t1=$("#money_check_find_dep1 option:selected").text();
		var data = "department="+t1;
		$.getJSON('query_salary.php',data, function(json){  
        	
        js = eval(json.op);			
				for(var i=0;i<js.length;i++)
				{ 		
					$("#money_sa_find").append("<tr><td>"+js[i].id+" </td><td>"+js[i].name+" </td><td>"+js[i].bm+" </td><td>"+js[i].gz+" </td></tr>");
				}
		});
	});
  });
  //财务-审查-查询-按钮
$(function(){
    $("#money_check_find1").click(function(){
		$("#check_table").empty();
		//加表头
		$("#check_table").append("<tr><td>"+"#"+"</td><td>"+"部门"+"</td><td>"+"姓名"+"</td><td>"+"日期"+"</td><td>"+"金额"+"</td><td>"+"理由"+"</td><td>"+"状态"+"</td></tr>");
		var t2=$("#money_check_find_dep1 option:selected").text();
		var t1=$("#money_check_find_date1").val();
		
		var data = "date="+t1+"&department="+t2;
		$.getJSON('query_check.php',data, function(json){   
        js = eval(json.op);			
				for(var i=0;i<js.length;i++)
				{ 		
					$("#check_table").append("<tr><td>"+js[i].Sq_id+" </td><td>"+js[i].Sq_bm+" </td><td>"+js[i].Sq_user+" </td><td>"+js[i].Sq_rq+" </td><td>"+js[i].Sq_je+" </td><td>"+js[i].Sq_ly+" </td><td>"+js[i].Sq_sp+" </td></tr>");
				}
		});
		
	});
  });
  
  function food_load(){
	  var a= account();
	     if(a){
	     }else{

			  window.location="../../huangzeqin/login/login.html";
	     }
	     $("#user_name5").text(a);
}

function account()
{
	var result = "";
	$.ajaxSettings.async = false;
	$.getJSON('../../huangzeqin/send_acc.php',null, function(json){
     var js=json.op;
     result=js;
	});
	return result;
}
