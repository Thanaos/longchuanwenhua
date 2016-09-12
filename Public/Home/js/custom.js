// JavaScript Document
$(".carAudit").click(function(){
	$(this).addClass("active").siblings(".carAudit").removeClass("active");
	});
function showAuditConfirmInfo(){
	$("#auditConfirmInfo").show();
	$(".carAuditWrap").hide();
}
function showChoose(){
	$(".incomplete").hide();
	$("#clxx")&&$("#clxx").hide();
	$(".carAuditWrap").show();
}

$("#choosecar").click(function(){
		$("#carType").show();
		$("#main").hide();
		$("#clxx")&&$("#clxx").hide();
		$(".incomplete").hide();
	});
$("#brand li").live('click',function(){
	//alert(1)
		$("#cars").show();
		$("#brand").hide();
	});
$("#car1 li").live('click', function() {
		$("#cars").hide();
		$("#brand").show();
	});
$("#car3 li").live('click', function(e) {
		$("#carType").hide();
		$("#main").show();
		$("#clxx")&&$("#clxx").show();
		$(".incomplete").show();
	});
function changeValue(change){
		var selectValue=$(change).find("option:selected").text();
		//alert(selectValue);
		$(change).siblings('.L-selected-select').html(selectValue);		
}

function mouseDownFun(addclass){
	$(addclass).addClass("active");
}
function mouseUpFun(removeclass){
	$(removeclass).removeClass("active");
}
function toggleCarType(){
	$("#cars").hide();
	$("#brand").show();
}