// JavaScript Document

//客房查询结果显示
 $(function(){
        $("#room_find1").click(function(){
        	$("#room_find_table").empty();
        	$("#room_find_table").append("<tr class=' bg-success'><th><span></span>客房号<span></span></th><th><span></span>类型<span></span></th><th><span></span>金额<span></span></th><th><span></span>入住状态<span></span></th><th><span></span>预定状态<span></span></th><th><span></span>空闲状态<span></span></th></tr>");
    		var day=$("#room_day").val();
    		var roomtype=$("#room_type option:selected").text();
    		var s=$("#room_state option:selected").text();
    		if(s=="未入住"){ var state=1;}
    		else if(s=="已入住"){var state=2;}
    		else if(s=="未预定") {var state=3;}
    		else if(s=="已预定"){var state=4;}
    		else if(s=="空闲"){var state=5;}
    		else if(s=="非空闲"){var state=6;}

            var data = "day="+day+"&roomtype="+roomtype+"&state="+state;
            $.getJSON('../roomquery.php',data,function(json){
            js = eval(json.op);
    		for(var i=0;i<js.length;i++)
    		{
    			$("#room_find_table").append("<tr><td>"+js[i].room_id+" </td><td>"+js[i].room_type
    		      +" </td><td>"+js[i].price+" </td><td>"+js[i].islived+" </td><td>"+js[i].isordered+" </td><td>"+js[i].isfree+" </td></tr>");
    		}
    		});
    	 });
      });

//客房查询-点击信息-出现信息模态框
 $(function(){
     $("#room_find_table").on("click","tr",function(){
       	var add_day1=$("#room_day").val();
       	var text = $(this).text();
       	var arr = splitword(text);
 	    $("#mymodal").modal("toggle");
 		$("#room_day1").val(add_day1);
 		$("#room_id").val(arr[0]);
     });
   });


//订单查询结果显示：
$(function(){
    $("#query").click(function(){
    	$("#room_order_find_table").empty();
    	$("#room_order_find_table").append("<tr class=' bg-success'><th>订单号</th><th>客房号</th><th>入住时间</th><th>离店时间</th><th>具体时间</th><th>总金额</th><th>客户姓名</th><th>客户类型</th><th>手机号码</th><th>押金</th><th>状态</th></tr>");
		var day1=$("#i1").val();
		var day2=$("#i2").val();
		var type=$("#room_order_room_type option:selected").text();

        var data = "day1="+day1+"&day2="+day2+"&type="+type;
        //alert(data);
		$.getJSON('../orderquery.php', data, function(json){
	    //alert(1);
        js = eval(json.op);
				for(var i=0;i<js.length;i++)
				{
					$("#room_order_find_table").append("<tr><td>"+js[i].order_id+" </td><td>"+js[i].room_id
						+" </td><td>"+js[i].day1+" </td><td>"+js[i].day2+" </td><td>"+js[i].order_time+" </td><td>"+js[i].sum
						+" </td><td>"+js[i].customer_name+" </td><td>"+js[i].customer_type+" </td><td>"+js[i].telphone
						+" </td><td>"+js[i].money+" </td><td>"+js[i].state+" </td></tr>");
				}
		});
	});
  });


//订单查询-订单信息模态框
$(function(){
    $("#room_order_find_table").on("click","tr",function(){
		var text = $(this).text();
	    var arr = splitword(text);
		$("#mymodal_room_order").modal("toggle");
		$("#room_order_id").val(arr[0]);
		$("#room_order_room_id").val(arr[1]);
		$("#room_order_day1").val(arr[2]);
		$("#room_order_day2").val(arr[3]);
		$("#room_order_day").val(arr[4]);
		$("#room_order_sum").val(arr[5]);
		$("#room_order_customer").val(arr[6]);
		$("#room_order_customer_type").val(arr[7]);
		$("#room_order_phone").val(arr[8]);
		$("#room_order_money").val(arr[9]);
		$("#room_order_room_state").val(arr[10]);
    });
  });

//仓库-出入库-新增-出模态框
$(function(){
    $("#ware_io_add2").click(function(){
		var add_num=$("#ware_io_add_num1").val();
		var add_type=$("#ware_io_add_type1 option:selected").text();
		var add_name=$("#ware_io_add_name1 option:selected").text();
		var add_price=$("#ware_io_add_price1").val();
		var add_sum=$("#ware_io_add_sum1").val();
		if((add_num == "")||(add_price == "")||(add_sum == ""))
		{alert('新增输入不能为空');}
		else{
      	$("#ware_io_m1").modal("toggle");
		document.getElementById("ware_io_add_num2").value = add_num;
		document.getElementById("ware_io_add_type2").value = add_type;
		document.getElementById("ware_io_add_name2").value = add_name;
		$("#ware_io_add_price2").val(add_price);
		$("#ware_io_add_sum2").val(add_sum);
		}
    });
  });
//仓库-出入库-新增-后台
$(function(){
    $("#ware_io_add3").click(function(){
	$.ajax({
        type:'POST',
        target:'../View/text.php',
        data: "people="+ 'a',
        success: function(data){ alert(people);} //显示操作提示
    });
	});
  });
//仓库-供应商-表格-点击出模态
$(function(){
    $("tr.ware_supply_find").click(function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#ware_supply_m2").modal("toggle");
	$("#ware_supply_find_id2").val(arr[0]);
	$("#ware_supply_find_sup2").val(arr[1]);
	$("#ware_supply_find_name2").val(arr[2]);
	$("#ware_supply_find_tel2").val(arr[3]);
	$("#ware_supply_find_add2").val(arr[4]);
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
    $("tr.ware_io_find").click(function(){
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
    $("tr.ware_item_find").click(function(){
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
	$("#ware_item_find_locate2").val(arr[7]);
	$("#ware_item_find_supply2").val(arr[8]);
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
    $("tr.money_check_find").click(function(){
	var text = $(this).text();
    var arr = splitword(text);
	$("#money_check_m1").modal("toggle");
	$("#money_check_find_id2").val(arr[0]);
	$("#money_check_find_dep2").val(arr[1]);
	$("#money_check_find_date2").val(arr[2]);
	$("#money_check_find_sum2").val(arr[3]);
	$("#money_check_find_rea2").val(arr[4]);
	$("#money_check_find_sp2").val(arr[5]);
	$("#money_check_find_ty2").val(arr[6]);
	$("#money_check_find_ff2").val(arr[7]);
	});
  });

//用户-中心-加载
function user_cen_load(){
		var a= account();
		//alert(a);
	if(a){
			$("#user_name5").text(a);
        var data="a="+a;
        $.getJSON('../show_per_info.php',data,function(json){
        	    js = eval(json.op);
				//alert(1);
				$("#user_cen_name1").val(js.name);
				$("#user_cen_sex1").val(js.sex);
				$("#user_cen_birth1").val(js.birth);
				$("#user_cen_date1").val(js.date);
				$("#user_cen_dep1").val(js.dep);
				$("#user_cen_job1").val(js.job);
				$("#user_cen_card1").val(js.card);
				//alert(js.haha);
        });
		}else{
			  window.location="../login/login.html";
	     }
	     $("#user_name5").text(a);
}

//用户-资金-加载
//function user_money_load(){
//        alert("1234");
//}

//返回当前用户的账号
function account()
{
	var result = "";
	$.ajaxSettings.async = false;
	$.getJSON('../send_acc.php',null, function(json){
     var js=json.op;
     result=js;
	});
	return result;
}

//申请资金：刷新页面-插入数据库-查询当前插入的记录附加在右边
function user_money_load(){
	  var a= account();
     if(a){
    	 var data="a="+a;
	      $.getJSON('../apply_money.php',data,function(json){
	         js=eval(json.op);
	        for(var i=0;i<js.length;i++){
	         $("#apply_table").append("<tr><td>"+js[i].id+" </td><td>"+js[i].time+" </td><td>"
	        		 +js[i].money+" </td><td>"+js[i].reason+" </td><td>"+js[i].state+" </td></tr>");
			}
		});
     }else{
		  window.location="../login/login.html";
     }
     $("#user_name5").text(a);
}

//用户-修改密码-加载
function user_pw_load(){
	  var a= account();
	     if(a){
	     }else{
			  window.location="../login/login.html";
	     }
	     $("#user_name5").text(a);
}

function room_load(){
	  var a= account();
	     if(a){
	     }else{

			  window.location="../login/login.html";
	     }
	     $("#user_name5").text(a);
}
