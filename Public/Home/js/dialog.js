try{
	var iDialog=(function(){
			var section=document.createElement("section");
				// alert
				var div_alert=document.createElement("div");
					var style_alert="display:none;position: absolute;top: 70px;left: 0;right: 0;margin: auto;z-index: 9000;width: 300px;min-height: 100px;background: #fff;border-radius: 5px;-webkit-box-sizing: border-box;background: rgba(0,0,0,0.5);padding-bottom: 10px;width: 200px;"
						div_alert.setAttribute("style",style_alert);
					
					var div_alert_article=document.createElement("article");
						div_alert_article.setAttribute("style","  padding: 0;-webkit-box-sizing: border-box;");
						
						var div_alert_article_div1=document.createElement("div");
							div_alert_article_div1.setAttribute("style","height: 50px;width: 50px;margin: auto;background: url(/Public/Home/images/icon-1.png) no-repeat center center;background-size: 100%;margin-top: 10px;");
						var div_alert_article_div2=document.createElement("div");
							div_alert_article_div2.setAttribute("style","padding:10px 30px;line-height:23px;text-align:center;font-size:16px;color:#ffffff;");
							
							div_alert_article.appendChild(div_alert_article_div1);	
							div_alert_article.appendChild(div_alert_article_div2);	
							div_alert.appendChild(div_alert_article);
							section.appendChild(div_alert);
				// loading
				var div_loading=document.createElement("div");
						div_loading_style="display:none;position: absolute;top: 70px;left: 0;right: 0;z-index: 9000;border-radius: 5px;-webkit-box-sizing: border-box;  background: url(/Public/Home/images/loading.gif) no-repeat center center;-webkit-background-size: 50px auto;color: transparent;background-color: rgba(0,0,0,0.5);width: 100px;height: 100px;margin: auto;bottom: 0;padding-bottom: 10px;";
						div_loading.setAttribute("style",div_loading_style);
						
						var div_loading_article=document.createElement("article");
							div_loading_article.setAttribute("style","  padding: 0;-webkit-box-sizing: border-box;");
						
						div_loading.appendChild(div_loading_article);
						section.appendChild(div_loading);
				// confirm	
				var div_confirm=document.createElement("div");
					var div_confirm_style="display:none; position: absolute; top: 70px; left: 0px; right: 0px; margin: auto; z-index: 9000; min-height: 100px; box-sizing: border-box;border-radius: 5px; padding: 10px 0px 15px; width: 260px; background-color: rgba(000,000,000,0.6);";
					div_confirm.setAttribute("style",div_confirm_style);
					
						var div_confirm_article=document.createElement("article");
							var div_confirm_article_style="-webkit-box-sizing: border-box;color: #fff;text-align: center;padding: 10px 10px 15px;margin: 0 0 10px;font-size: 20px;";
							div_confirm_article.setAttribute("style",div_confirm_article_style);
							
							div_confirm.appendChild(div_confirm_article);
							
							var d_c_a_f=document.createElement("footer");
								d_c_a_f.setAttribute("style","height: 35px;line-height: 35px;padding: 0 10px;");
								
								var dcafdd=document.createElement("div");
									dcafdd.setAttribute("style","width: 100%;display: -webkit-box;display: -moz-box;-webkit-box-orient: horizontal;-moz-box-orient: horizontal;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;");
									
									var dcafd=document.createElement("div");
										dcafd.setAttribute("style","-webkit-box-flex: 1;");
										var dcafda1=document.createElement("a");
											dcafda1.setAttribute("href","javascript:;");
											dcafda1.setAttribute("style","display: block;height: 35px;line-height: 35px;padding: 0 5px;text-decoration: none;-webkit-tap-highlight-color: rgba(0,0,0,0.3);background: #56c6d6;color: #fff;text-align: center;border-radius: 5px;font-size: 18px;width: 75px;margin: auto;border: 0;");
											dcafda1.innerHTML="确定";
											
											dcafd.appendChild(dcafda1);
											
									var dcafd2=document.createElement("div");
										dcafd2.setAttribute("style","-webkit-box-flex: 1;");
									
									var dcafda2=document.createElement("a");
											dcafda2.setAttribute("href","javascript:;");
											dcafda2.setAttribute("style","display: block;height: 35px;line-height: 35px;padding: 0 5px;text-decoration: none;-webkit-tap-highlight-color: rgba(0,0,0,0.3);background: #a9a9a9;color: #fff;text-align: center;border-radius: 5px;font-size: 18px;width: 75px;margin: auto;border: 0;");
											dcafda2.innerHTML="取消"
									
										dcafd2.appendChild(dcafda2);
									
									dcafdd.appendChild(dcafd);
									dcafdd.appendChild(dcafd2);
							d_c_a_f.appendChild(dcafdd);
							div_confirm.appendChild(d_c_a_f);
						
					section.appendChild(div_confirm);	
							
				// 遮罩层
				var div_pop=document.createElement("div");
					div_pop.setAttribute("style","display: none;position: fixed;left: 0;top: 0;width: 100%;height: 100%;z-index: 1000;background: rgba(0,0,0,0.6);");
				
				section.appendChild(div_pop);
			document.body.insertBefore(section,document.body.childNodes[0]);
			
			var e=function(){
				this.alertContent={
					div:div_alert,
					article:div_alert_article_div2,
					img:div_alert_article_div1
				};
				this.loadingContent={
					div:div_loading,
				}
				this.confirmContent={
					div:div_confirm,
					article:div_confirm_article,
					btnOk:dcafda1,
					btnCn:dcafda2
				}
				
				this.div_pop=div_pop;
			}
			e.prototype.popShow=function(type){

				this.div_pop.style["display"]=type?"block":"none";
				//this.div_pop.style["display"]="block";
				
			}
			return e;
	})();
	var e=new iDialog();

	window.alert=function(text,timeOut,imgSrc,fn){
		e.alertContent.div.style["display"]="block";

		var sTop=document.body.scrollTop;
		e.alertContent.div.style["top"]=sTop+window.innerHeight/2-150+"px";

		if(imgSrc){
			e.alertContent.img.style["background"]="url("+imgSrc+") no-repeat center center ";
		}

		e.alertContent.article.innerHTML=text;
		e.popShow(true);
		setTimeout(function(){
			e.alertContent.div.style["display"]="none";
			e.popShow(false);

			if(typeof fn=="function"){
				fn();
			}
		},timeOut);
	};
	window.alertNew=function(text,timeOut,imgSrc,fn){
		e.alertContent.div.style["display"]="block";

		var sTop=document.body.scrollTop;
		e.alertContent.div.style["top"]=sTop+window.innerHeight/2-150+"px";

		if(imgSrc){
			e.alertContent.img.style["background"]="url("+imgSrc+") no-repeat center center ";
		}

		e.alertContent.article.innerHTML=text;
		e.popShow(true);
		setTimeout(function(){
			e.alertContent.div.style["display"]="none";
			e.popShow(false);

			if(typeof fn=="function"){
				fn();
			}
		},timeOut);
	}

	window.loading=function(type,imgSrc){
		if(imgSrc)
			e.loadingContent.div.style["background"]= "url("+imgSrc+") no-repeat center center";
		
		e.loadingContent.div.style["display"]=type?"block":"none";
		e.popShow(type);
	}

	window.confirm=function(text,fnOk,fnCn){
		e.confirmContent.fnOk="";
		e.confirmContent.fnCn="";
		
		e.confirmContent.article.innerHTML=text;
		e.confirmContent.div.style["display"]="block";
		e.popShow(true);
		if(typeof fnOk=="function"){
			e.confirmContent.fnOk=fnOk;
		}
		if(typeof fnCn=="function"){
			e.confirmContent.fnCn=fnCn;
		}
		
		var _this=this;
		e.confirmContent.btnOk.addEventListener("click",function(event){
				e.confirmContent.div.style["display"]="none";
				e.popShow(false);
				if(typeof e.confirmContent.fnOk=="function"){
					e.confirmContent.fnOk.call(_this);
				};
				event.stopPropagation();
				event.preventDefault();
			},false);
		e.confirmContent.btnCn.addEventListener("click",function(){
				e.confirmContent.div.style["display"]="none";
				e.popShow(false);
				if(typeof e.confirmContent.fnCn=="function"){
					e.confirmContent.fnCn.call(_this);
				}
				event.stopPropagation();
				event.preventDefault();
			},false);
	}
}
catch(e){
	
}