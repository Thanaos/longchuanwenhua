var gdMap={
			haProtoType:false,
			
			drawMap:function(option){
					/*  option	
						divId:地图绑定的元素id string
						resizeEnable:地图允许调整大小 boolean
						zoom:初始缩放比例 number
						longitude:经度 float
						latitude:纬度  float
					*/
                	
					this.option=option;
					this.aMaplatlng={};
					/*if(/(IPHONE)|(IPAD)/.test(navigator.userAgent.toUpperCase()))
					{
						this.getGPSAddress();
					}
					else{*/
						
						this.map();
					//}
					/*if(!option.longitude&&!option.latitude)
					{
						this.getGPSAddress();
					}
					else{
						this.aMaplatlng.lat=this.option.latitude;
						this.aMaplatlng.lng=this.option.longitude;

						this.map();
					}*/	
			},
			getGDAddress:function(){
				var _this=this;
				_this.map.plugin('AMap.Geolocation', function () {
					_this.geolocation = new AMap.Geolocation({
						enableHighAccuracy: true,//是否使用高精度定位，默认:true
						timeout: 15000,          //超过10秒后停止定位，默认：无穷大
						maximumAge: 0,           //定位结果缓存0毫秒，默认：0
						convert: true,           //自动偏移坐标，偏移后的坐标为高德坐标，默认：true
						showButton: false,        //显示定位按钮，默认：true
						showMarker: true,        //定位成功后在定位到的位置显示点标记，默认：true
						showCircle: false,        //定位成功后用圆圈表示定位精度范围，默认：true
						panToLocation: true,     //定位成功后将定位到的位置作为地图中心点，默认：true
						zoomToAccuracy:true      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
					});
					_this.map.addControl(_this.geolocation);
					AMap.event.addListener(_this.geolocation, 'complete', function(data){
						//confirm(data.position.getLng()+":"+data.position.getLat()+","+data.isConverted,function(){},function(){});
					
						if(_this.option["callback"] && typeof _this.option["callback"]=="function")
						{
							_this.option["callback"].call(_this);
						}
					});//返回定位信息
					_this.geolocation.getCurrentPosition();
				});
				
				
			},
			getAddress:function (lat,lng,callback){
                 _this=this;
				AMap.service(["AMap.Geocoder"], function() { 
					geocoder = new AMap.Geocoder({
						radius: 1000,
						extensions: "all"
					});
				   
					geocoder.getAddress(new AMap.LngLat(lng,lat), function(status, result){
						if(status=='error') {
							if(typeof callback=="function")
								callback({state:-1,message:"请求服务器出错！"});
						}
						if(status=='no_data') {
							if(typeof callback=="function")
							callback({state:0,message:"无数据返回，请换个关键字试试～～"});
						}
						else {
							 _this.result=result;
							if(typeof callback=="function")
							callback({state:1,message:"编码成功",address:result});   
						}
					});
				}); 
			},
			map:function(device){

				var _this=this;
				var divId;
               
               	 _this.option.divId?(divId=_this.option.divId):(document.body.id="eleBody",divId="eleBody");
				 if(device){
					_this.map = new AMap.Map(divId, {
							resizeEnable:true,
							view: new AMap.View2D({
								center:new AMap.LngLat(_this.aMaplatlng.lng,_this.aMaplatlng.lat),
								zoom:14
							})
						});
					}
				else{
					_this.map = new AMap.Map(divId, {
							resizeEnable:true,
							view: new AMap.View2D({
								//center:new AMap.LngLat(_this.aMaplatlng.lng,_this.aMaplatlng.lat),
								zoom:14
							})
						});
					}
				_this.getGDAddress();
					/*var toolBar=null;
					//在地图中添加ToolBar插件
					_this.map.plugin(["AMap.ToolBar"],function(){		
						toolBar = new AMap.ToolBar({offset:new AMap.Pixel(0,250)});
						_this.map.addControl(toolBar);		
					});*/						
					/*var tob=document.getElementsByClassName("amap-toolbar");
						alert(tob.length);
						if(tob.length>0){
							tob[0].style["position"]="absolute";
							tob[0].style["top"]=window.innerHeight-300+"px";
						}*/
					
				
			},
			containTolnglat:function(pagePoint){
					var _this=this;
					var ll = _this.map.containTolnglat(new AMap.Pixel(pagePoint.x,pagePoint.y));
					return ll;
			},
			lnglatTocontainer:function(lnglat){
				var _this=this;
				var ll = _this.map.lnglatTocontainer(new AMap.LngLat(lnglat.lng,lnglat.lat));  
				return ll;
			},
			addMarker:function(option){
				marker = new AMap.Marker({				  
					icon: option.icon?option.icon:"http://webapi.amap.com/images/marker_sprite.png",
					position:new AMap.LngLat(option.lng,option.lat),
					offset: new AMap.Pixel(option.pixelX,option.pixelY), //相对于基点的偏移位置,
                   /* icon:new AMap.Icon({  //复杂图标                 
                        size:new AMap.Size(28,37),//图标大小                 
                        image:"http://cache.amap.com/lbs/static/custom_a_j.png",//大图地址                 
                        imageOffset:new AMap.Pixel(-28,0)//相对于大图的取图位置                 
                      })*/
				});
				marker.setMap(this.map); 
				
			},
			getGPSAddress:function(){
				var _this=this;   
				if(navigator.geolocation)
				{
					window.navigator.geolocation.getCurrentPosition(
						  function(pos){
							if(pos!=null){
								
								var latlng={								
										lat:pos.coords.latitude,
										lng:pos.coords.longitude,
										accuracy:pos.coords.accuracy
										};
								_this.gpsLatLng=latlng;	
								_this.aMaplatlng=_this.GpsCorrect.transform(_this.gpsLatLng);
								_this.map(1);
							  }
							  else{
								alert("没有gps位置");
							  }
						  },
						  function(err){
								alert(err.message);
						  }
					 ); 
				}
				else{
						alert("该浏览器不支持h5定位");
				}
			},
			autoComplete:function(keywords,callback){
				var auto;
				var _this=this;
				var cityCode=_this.result?_this.result.regeocode.addressComponent.citycode:"010";
				//加载输入提示插件
					AMap.service(["AMap.Autocomplete"], function() {
					var autoOptions = {
						city: cityCode //城市，默认全国
					};
					auto = new AMap.Autocomplete(autoOptions);
					//查询成功时返回查询结果
					auto.search(keywords, function(status, result){
						callback(status,result);
					});
				});	
			},
			placeSearch:function(keyWord,cb){
				var _this=this;              
				var cityCode=_this.result?_this.result.regeocode.addressComponent.citycode:"010";
                 //根据选择的输入提示关键字查询
				_this.map.plugin(["AMap.PlaceSearch"], function() {       
					var msearch = new AMap.PlaceSearch();  //构造地点查询类
					AMap.event.addListener(msearch, "complete", cb); //查询成功时的回调函数
					msearch.setCity(cityCode);
					msearch.search(keyWord);  //关键字查询查询
				});
			},
            panTo:function(lnglat)
            {
                if(lnglat)
                {
                    var lnglatArr=lnglat.split(",");
               		this.map.panTo(new AMap.LngLat(lnglatArr[0],lnglatArr[1]));
                }
            },
			GpsCorrect:{
			 pi:3.14159265358979324,
			 a: 6378245.0,
			 ee: 0.00669342162296594323,
			transform:function(gpsLatLng,callback){
				var latlng={};
				var wgLat=gpsLatLng.lat;
				var wgLon=gpsLatLng.lng;
				
				 if (this.outOfChina(wgLat, wgLon)) { 
			 
					latlng["lat"] = wgLat;  
					latlng["lng"] = wgLon;  
					return;  
				}  
				var dLat = this.transformLat(wgLon - 105.0, wgLat - 35.0);  
				var dLon = this.transformLon(wgLon - 105.0, wgLat - 35.0);  
				var radLat = wgLat / 180.0 * this.pi;  
				var magic = Math.sin(radLat);  
				magic = 1 - this.ee * magic * magic;  
				var sqrtMagic = Math.sqrt(magic);  
				dLat = (dLat * 180.0) / ((this.a * (1 - this.ee)) / (magic * sqrtMagic) * this.pi);  
				dLon = (dLon * 180.0) / (this.a / sqrtMagic * Math.cos(radLat) * this.pi);  
				latlng["lat"] = wgLat + dLat;  
				latlng["lng"] = wgLon + dLon;  
				if(typeof callback=="function")
				{
					callback(latlng);
				}
               
				return latlng;
			},
			outOfChina:function( lat,   lon) {  
				if (lon < 72.004 || lon > 137.8347)  
					return true;  
				if (lat < 0.8293 || lat > 55.8271)  
					return true;  
				return false;  
			},
			transformLat:function(  x,   y) {  
				var ret = -100.0 + 2.0 * x + 3.0 * y + 0.2 * y * y + 0.1 * x * y + 0.2 * Math.sqrt(Math.abs(x));  
				ret += (20.0 * Math.sin(6.0 * x * this.pi) + 20.0 * Math.sin(2.0 * x * this.pi)) * 2.0 / 3.0;  
				ret += (20.0 * Math.sin(y * this.pi) + 40.0 * Math.sin(y / 3.0 * this.pi)) * 2.0 / 3.0;  
				ret += (160.0 * Math.sin(y / 12.0 * this.pi) + 320 * Math.sin(y * this.pi / 30.0)) * 2.0 / 3.0;  
				return ret;  
			} ,
			transformLon:function(x,y) {  
				var ret = 300.0 + x + 2.0 * y + 0.1 * x * x + 0.1 * x * y + 0.1 * Math.sqrt(Math.abs(x));  
				ret += (20.0 * Math.sin(6.0 * x * this.pi) + 20.0 * Math.sin(2.0 * x * this.pi)) * 2.0 / 3.0;  
				ret += (20.0 * Math.sin(x * this.pi) + 40.0 * Math.sin(x / 3.0 * this.pi)) * 2.0 / 3.0;  
				ret += (150.0 * Math.sin(x / 12.0 * this.pi) + 300.0 * Math.sin(x / 30.0 * this.pi)) * 2.0 / 3.0;  
				return ret;  
			}
		}
	};
	
