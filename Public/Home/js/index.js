/**
 * Created by gaoxiang on 15-5-21.
 * @function : Add car
 * @gaoxiang@vjifen118.com
 */
(function () {
	var BOM = window;
	var Addcar = function () {
		this.btn = $('#btnOK');
		this.user_id = $('#userId').text();
		this.post_session_url = '/index.php/home/ajax/setSession' || '';
		this.post_car_url = '/index.php/home/addcar';
		this.get_session = "/index.php/home/ajax/getSession";
		this.cph_input=$('.clxx_cphxx_cph input');
		this.session = {};
	};

	Addcar.prototype = {

		Getsession: function () {
			var me = this ,
				value = {
					key: "dataCache" ,
					form_submit: $("#form_submit").val() ,
					form_hash: $("#form_hash").val()
				};
			$.post(this.get_session , value , function (data) {
				var data = $.parseJSON(data) ,
					id;
				data.data.carInfo = $.parseJSON(data.data.carInfo);

				me.session.value = data.data;
				me.session.key = 'dataCache';
				console.log(me.session);
				/*ID 存入LS中，
				 *稍后在[set_carinfo]中要用到，把LS.__ID存入SEESION
				 *在[set_session] 调用成功后清除LS.__ID
				 */
				id = data.data.carInfo.data.id;
				BOM.localStorage.__id = id;
			})
		} ,
		EventBinding: function () {
			var me = this;
			this.btn.on('touchend' , me.callback);

			// 点击输入车牌号
			$("#div_car_number").on("click", me.input_car_number)

			// 键盘退格按钮
			 $("#keyboard_delete").on("touchend",me.keyboard_delete);

			// 小键盘点击事件
			$("#div_keyboard_main").on("touchend",me.keyboard_select);

			// 点击确定或下拉隐藏小键盘			
			$(".keyboard_ok").on("touchend",function(e){
				$(".keyboard-main").hide();
				e.stopPropagation();
				e.preventDefault();	
			});
			// 点击其他地方隐藏小键盘
			$(".clxx_layout").on("touchend",function(){
				 $("#div_car_number").css("border","1px solid #F1ECEC");
				$(".keyboard-main").hide();
			});
			
						
		} ,

		callback: function (e) {
			var car_number = window.Addcar.value_car_number();
			//alert('hello');
			if (car_number.length == 0) {
				alert('车牌号不能为空' , 2000 , "images/hy/warning@3x.png");
				return
			}
			window.Addcar.post_car();
		} ,
		set_keyboard_width:function(){
			var u = navigator.userAgent;
			if(!!!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/)){
				$(".keyboard-letter ul li").css("margin","1.2%");
			}
			
		},
		input_car_number:function(e){
			$("#div_car_number").css("border","1px solid #66A8E4");
			$(".keyboard-main").show();
			$("#sfxz").hide();
			e.stopPropagation();
		},
		keyboard_select:function(e){
			var target=e.target;
			if((target.nodeName.toUpperCase()=="SPAN"||target.nodeName.toUpperCase()=="LI")&&target.innerHTML.length==1)
			{
				$(target).css("color","blue");
				var text=$("#div_car_number").html();
				if(text.length<6){
					$("#div_car_number").html(text+target.innerHTML);
				}
				$(target).css("color","black");
			}
			e.stopPropagation();
		},
		keyboard_delete:function(e){

			var text=$("#div_car_number").html();
				if(text.length>0){
					var h=text.substr(0,text.length-1);
					$("#div_car_number").html(h);
				}
				e.stopPropagation();
				e.preventDefault();
		},

		toggle_keyboard:function(e){
			e.preventDefault();
			var v=document.body.offsetHeight+"/"+document.body.scrollHeight;
			window.setTimeout(function(){
				document.body.scrollTop=1000;
				window.setTimeout(function(){
					var st=document.body.scrollTop;
					document.body.scrollTop=0;
					var u = navigator.userAgent;
					if(!!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/)){
						st=st-45;
						$("#keyboard").html(st+"/"+document.body.scrollHeight);
					}	
					$("#keyboard").css("bottom",st+"px");
					
					$("#keyboard").show();	
				},500);
			},500);
			//$("#keyboard").show();
			//alert( v, 2000 , "images/hy/warning@3x.png");
		},

		post_car: function () {
			var me = this;
			var data = this.value();
			$.post(me.post_car_url , data , function (ResponseData) {
				var data = $.parseJSON(ResponseData);
				if (data.code === "0" || data.code === 0) {
					me.session.value.carInfo = $.parseJSON(me.session.value.carInfo);
					me.session.value.carInfo.data.id = data.data.id;
					me.session.value.carInfo = JSON.stringify(me.session.value.carInfo);
					me.post_session(me);
					return
				}
				alert(data.message);
				console.error('Response code is not 0 \n' + 'Response code is ' + data.code);
			});
		} ,
		post_session: function (me) {
			var session = this.session;
			console.log(session)
			console.log(session.value.carInfo);
			$.post(this.post_session_url , session , function (ResponseData) {
				var data = $.parseJSON(ResponseData);
				if (data.code === 0 || data.code === "0") {
					alert('添加成功');
					BOM.localStorage.removeItem('__id');
					me.back_to_index();
					return;
				}

			});
		} ,
		value: function () {
			var brand = $('#carName').text().split(' ')[0] ,
				model = $('#carName').text().split(' ')[1] ,
				//number = $('#car_p').text() + $('.clxx_cphxx_cph input').val() ,
				number= $('#car_p').text() + $("#div_car_number").html(),
				color = $('select').val() ,

				data = {
					userId: this.user_id ,
					brand: brand ,
					model: model ,
					number: number ,
					color: color
				};

			if (typeof this.session.value.carInfo == "string") {
				this.session.value.carInfo = $.parseJSON(this.session.value.carInfo);
			}
			if (!this.session.value) {
				this.session.value = {
					carInfo: {
						code: '' ,
						message: '' ,
						data: {}
					}
				}
			}
			this.session.value.carInfo.data.number = data.number;
			this.session.value.carInfo.data.color = data.color;
			this.session.value.carInfo.data.brand = data.brand;
			this.session.value.carInfo.data.model = data.model;
			this.session.value.carInfo.data.id = BOM.localStorage.__id;
			this.session.value.carInfo = JSON.stringify(this.session.value.carInfo);
			return data
		} ,
		value_check_null: function () {
			var brand = $('#carName').text() ,
				number = $('.clxx_cphxx_cph input').val() ,
				color = $('.clxx_cphxx_cph input').val() ,
				status , error_message;
		} ,
		value_car_number: function () {
			//return $('.clxx_cphxx_cph input').val()
			return $("#div_car_number").html();
		} ,
		back_to_index: function () {
			console.log('');
			return window.location.href = "/index.php/home/index/index";
		} ,
		init: function () {
			this.Getsession();
			this.set_keyboard_width();
			this.EventBinding();
		}

	};
	window.Addcar = new Addcar();
	window.Addcar.init()
})();

