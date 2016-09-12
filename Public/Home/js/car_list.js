/**
 * Created by gaoxiang on 15-5-25.
 * @function : get car list
 * @gaoxiang@vjifen118.com
 */
(function () {

	var Carlist = function () {
		this.url = '/index.php/home/ajax/carList' || '',
			this.url_get_session = "/index.php/home/ajax/getSession",
			this.url_post_session = '/index.php/home/ajax/setSession' || '',
			this.data_session = {
				key: "dataCache"
			}  ,
			this.session = {},
			this.data = {
				userId: $('#userId').text()
			} || '',
			this.dom = $('.qclb_list ul');
			this.add = $('.icon-doubt');
			this.count=0;
	};

	Carlist.prototype = {
		/************************************************************************************
		* 提交SESSION
		**************************************************************************************/
		post_session: function () {
			$.post(this.url_post_session , this.session , function (Response) {
				if(Response.code==0||Response.code=="0") {
					window.location="smwash.php?do=smfw"
				};
			},'json')
		} ,
		/************************************************************************************
		 * 获取SESSION
		 **************************************************************************************/
		get_session: function () {
			var me = this;
			$.post(this.url_get_session , this.data_session , function (data) {
				if (data.code==0||data.code=='0') {

					data.data.carInfo = $.parseJSON(data.data.carInfo);
					me.session.value = data.data;
					me.session.key = 'dataCache';
				}
			} , 'json')
		} ,
		/************************************************************************************
		 * 获取列表
		 **************************************************************************************/
		get_car_list: function () {
			var me = this;
			$.post(this.url , this.data , function (data) {
				if(data.data.length==0||data.data.length=='0'){
					data.message=="查询成功"?  alert('车辆列表为空，请添加车辆'):'';
					return
				}
				data.data.forEach(function (i) {
					me.render_list(i)()
				})
			} , 'json')
		} ,
		/************************************************************************************
		 *
		 * Render
		 * 
		 **************************************************************************************/
		render_list: function (i) {
			var  me =this;

			return	function(){
					var dom ='';
			        dom += "<li class='mui-table-view mui-media-body"+
			            (me.count==0||me.count=="0" ? " first-one' ":"'") +
						" data-number=" + i.car_p +
						" data-color=" + i.car_color +
						" data-brand=" + i.car_band +
						" data-model=" + i.car_model +
				        " data-id="    + i.id  +
						 ">" +
						"<a href=\"javascript:;\">" +
						"<p>" + i.car_p + "</p>" +
						"<span>" + i.car_color + "</span>" +
						"<span>" + i.car_band + "<em>" + i.car_model + "</em></span></a></li>";
					++me.count;
				    console.log(me.count)
					me.dom.append(dom);
			}
		},
		/************************************************************************************
		 *
		 *     事件绑定
		 *
		 **************************************************************************************/
		event_binding: function () {
			var me = this;
			this.dom.on('click' , function (e) {
				var value = me.session.value;
				if (e.target.tagName == "LI") {
					value.carInfo.data.number = e.target.getAttribute('data-number');
					value.carInfo.data.color = e.target.getAttribute('data-color');
					value.carInfo.data.brand = e.target.getAttribute('data-brand');
					value.carInfo.data.model = e.target.getAttribute('data-model');
					value.carInfo.data.id = e.target.getAttribute('data-id');
					value.carInfo = JSON.stringify(value.carInfo);
					me.session.value=value;
					console.log(value);
					me.post_session();
				}
			})
			this.add.on('touchend',function(e){
				window.location='smwash.php?do=add_car'
			})
		} ,
		init: function () {
			this.get_car_list();
			this.get_session();
			this.event_binding();
		}
	};
	window.Carlist=new Carlist();
	window.Carlist.init();

})();
