//<input type="hidden" name="userVehicleInfo.licensePlateNumber" id="licensePlateNumber">
//<input type="hidden" name="userVehicleInfo.vehicleBrand" id="vehicleBrand">
//<input type="hidden" name="userVehicleInfo.vehicleModels" id="vehicleModels">
//<input type="hidden" name="userVehicleInfo.insuranceEndTime" id="insuranceEndTime">

function step1Submit() {
	$("#inputcarcolor").val($.trim($("#carcolor").val()));
	$("#licensePlateNumber").val($.trim($("#licensePlateNumber1").val()) + $("#licensePlateNumber2").val());
	if ($("#vehicleBrand").val() == "" || $("#vehicleModels").val() == "") {
		alert("请选择品牌型号");
		return;
	}
	if (!isLicensePlateNumber($("#licensePlateNumber").val())) {
		alert("车牌格式不正确");
		return;
	}
	$("#step1Form").submit();

}

function findVIService() {
	$.ajax({
		type: "POST",
		url: "wxVI_findVRService",
		data: null,
		dataType: "json",
		success: function(data, index) {

			if (null != data["errorMsg"]) {
				alert(data["errorMsg"]);
			} else {
				var resultList = data["resultList"];
				var html = "";
				var ser = null;
				if (resultList != null) {
					for (var i = 0; i < resultList.length; i++) {
						ser = resultList[i];

						html += '<div onclick="selectSer(this,' +
							ser.id + ')" class="carAudit"><div class="title clearfix"><span class="left">' +
							ser.serviceName + '</span><span class="right">' +
							ser.facePrice + '积分</span></div><p>' +
							ser.serviceDesc + '</p></div>';
					}
				}

				$("#nianshenSer").html(html);

			}


		}
	});

}

function selectSer(obj, id) {
	$(obj).addClass("active").siblings().removeClass("active");
	$("#VNType").val(id);
}

function step2Submit() {
	if ($("#VNType").val() == "") {
		alert("请选择套餐");
		return;
	}

	$("#step2Form").submit();
}

function step3Submit() {
	if ($("#carId").val() == "" || $("#carId").val() == "other") {
		alert("请选择车辆");
		return;
	}


	$("#step3Form").submit();
}

function clickImg(clickthis) {
	$(clickthis).children('img').click();
}
$("#brand li").live('click', function() {
	$("#brand li").removeClass("current");
	$(this).addClass("current");
	loadingcar(3, $(this).attr("brand"));
});

function setCarname(car3) {
	var cartype = $("#brand li.current span").text() + " " + $(car3).text();
	$("#carName").text(cartype);

	$("#vehicleBrand").val($("#brand li.current span").text());
	$("#vehicleModels").val($(car3).text());
	//alert($("#vehicleBrand").val()+$("#vehicleModels").val())
}