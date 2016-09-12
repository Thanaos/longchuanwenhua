/*
	alertNew(text,fn)
		text:弹出框显示内容。
		fn：点击确定的回调函数，可为空

	confirmNew(title,article,fnOkText,fnOk,fnCn)
		title:主标题
		artcile：副标题，可为空
		fnOkText:左边按钮文字，为空时显示“取消”
		fnOk：左边按钮的回调方法
		fnCn：右边按钮的回调方法
*/	
(function(window){
	try{

		window.onload=function(){
			var iDialog=(function(){

					function creatEle (eleType) {
						return document.createElement(eleType);
					}
					function addCss(ele,cssStr){
						ele.setAttribute("style",cssStr);
					}
					var section=document.createElement("section");
						// alert

						var div_confirm=creatEle("div");
							var style_alert="display: none;width: 90%;height:auto;border-radius: 5px;background-color: #fff;overflow: hidden;position: absolute;top: 20%;left: 5%;right: 5%;z-index: 20;"
								addCss(div_confirm,style_alert);
								
								var div_alert_1=creatEle("div");
									addCss(div_alert_1,"width: 100%;height: auto;padding-top: 20px;text-align: center;");
									var div_alert_1_h2=creatEle("h2");
										addCss(div_alert_1_h2,"font-size: 14px;color: #222;text-align: center;line-height: 24px; margin-bottom: 10px;");
									var div_alert_1_p=creatEle("p");
										addCss(div_alert_1_p,"font-size: 12px;color: #555;text-align: center;line-height: 24px; margin-bottom: 10px;");

									div_alert_1.appendChild(div_alert_1_h2);
									div_alert_1.appendChild(div_alert_1_p);	
									

								var div_alert_2=creatEle("div");
									addCss(div_alert_2,"width: 100%;height: 44px;border-top: 1px solid #e5e5e5;position: relative;text-align: center;");
									var div_alert_2_a1=creatEle("a");
										div_alert_2_a1.setAttribute("href","javascript:;");
										addCss(div_alert_2_a1,"font-size: 14px;display: inline-block;text-align: center;color: #222;width: 49%;height: auto;line-height: 44px;border-right:1px solid #e5e5e5 ;    text-decoration: none;");
										div_alert_2_a1
									var div_alert_2_a2=creatEle("a");
										div_alert_2_a2.setAttribute("href","javascript:;");
										addCss(div_alert_2_a2,"font-size: 14px;display: inline-block;text-align: center;color: #007de3;width: 49%;height: auto;line-height: 44px;    text-decoration: none;");

									div_alert_2.appendChild(div_alert_2_a1);
									div_alert_2.appendChild(div_alert_2_a2);

								div_confirm.appendChild(div_alert_1);
								div_confirm.appendChild(div_alert_2);
								section.appendChild(div_confirm);

						var div_alert_new=creatEle("div");
							addCss(div_alert_new,"display: none;width: 90%;height:auto;border-radius: 5px;background-color: #fff;overflow: hidden;position: absolute;top: 20%;left: 5%;right: 5%;z-index: 20;");

							var dand=creatEle("div");
								addCss(dand,"width: 100%;height: auto;padding: 20px;text-align: center;");
								var dandh=creatEle("h2");
									addCss(dandh,"font-size: 14px;color: #222;text-align: center;line-height: 24px; margin-bottom: 10px;");

									dand.appendChild(dandh);
									div_alert_new.appendChild(dand);
							var dand2=creatEle("div");
								addCss(dand2,"width: 100%;height: 44px;border-top: 1px solid #e5e5e5;position: relative;text-align: center;");
								var dand2a=creatEle("a");
									dand2a.setAttribute("href","javascript:;");
									dand2a.innerHTML="确定";
									addCss(dand2a,"font-size: 14px;display: inline-block;text-align: center;color: #007de3;width: 100%;height: auto;line-height: 44px;    text-decoration: none;");

									dand2.appendChild(dand2a);
									div_alert_new.appendChild(dand2);
									section.appendChild(div_alert_new);
				
						// 遮罩层
						var div_pop=document.createElement("div");
							div_pop.setAttribute("style","display:none;width: 100%;height: 100%;position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 10;background-color: rgba(000,000,000,0.5);");
						
						section.appendChild(div_pop);
					document.body.insertBefore(section,document.body.childNodes[0]);
					
					var e=function(){
						this.alertContent={
							div:div_alert_new,
							article:dand,
							btnOk:dand2a
						};

						this.confirmContent={
							div:div_confirm,
							title:div_alert_1_h2,
							article:div_alert_1_p,
							btnOk:div_alert_2_a1,
							btnCn:div_alert_2_a2
						}
						this.div_pop=div_pop;
					}

					e.prototype.popShow=function(type){
						this.div_pop.style["display"]=type?"block":"none";
					}
					return e;
			})();
			var e=new iDialog();

			window.alertNew2=function(text,fnn){

				e.alertContent.div.style["display"]="block";
				var _this=this;

				var sTop=document.body.scrollTop;
				e.alertContent.div.style["top"]=sTop+window.innerHeight/2-150+"px";

				e.alertContent.article.innerHTML=text;
				e.popShow(true);

				if("fn" in e.alertContent){
					e.alertContent.btnOk.removeEventListener("click",e.alertContent.fn);
				}

				e.alertContent.fn=function(event){
					e.alertContent.div.style["display"]="none";
					e.div_pop.style["display"]="none";
					
					if(typeof fnn=="function"){
						fnn.call(_this);
					};
					event.stopPropagation();
					event.preventDefault();		
				}

				e.alertContent.btnOk.addEventListener("click",e.alertContent.fn,false);
			}

			window.confirmNew=function(title,article,fnOkText,fnOk,fnCn){
				e.confirmContent.fnOk="";
				e.confirmContent.fnCn="";
				
				var _this=this;
				e.confirmContent.title.innerHTML=title?title:"";
				e.confirmContent.article.innerHTML=title?article:"";

				e.confirmContent.div.style["display"]="block";
				e.popShow(true);

				e.confirmContent.btnOk.innerHTML=fnOkText?fnOkText:"取消";
				e.confirmContent.btnCn.innerHTML="确定";			

				if("fnSuccess" in e.confirmContent){
					e.confirmContent.btnOk.removeEventListener("click",e.confirmContent.fnSuccess);
				}
				if("fnCancel" in e.confirmContent){
					e.confirmContent.btnCn.removeEventListener("click",e.confirmContent.fnCancel);
				}

				e.confirmContent.fnSuccess=function(event){
						e.confirmContent.div.style["display"]="none";
						e.popShow(false);
						event.stopPropagation();
						event.preventDefault();

						if(typeof fnOk=="function"){
							fnOk.call(_this);
						};
				}
				e.confirmContent.fnCancel=function(event){
						e.confirmContent.div.style["display"]="none";
						e.popShow(false);
						event.stopPropagation();
						event.preventDefault();
						if(typeof fnCn=="function"){
							fnCn.call(_this);
						}
				}
				e.confirmContent.btnOk.addEventListener("click",e.confirmContent.fnSuccess,false);
				e.confirmContent.btnCn.addEventListener("click",e.confirmContent.fnCancel,false);
				
			}
		}	
	}
	catch(e){	
	}

})(window)




	