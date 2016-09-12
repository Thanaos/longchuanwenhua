	
	// 获取指定标签的父节点
	function getParentNode(ele,nodeName)
	{
		if(ele.nodeName.toUpperCase()==nodeName.toUpperCase())
		{
			return ele;
		}
		else{
			if(ele.parentNode)
			return arguments.callee(ele.parentNode,nodeName);
			else
			return null;
		}
	}

	// 阻止事件冒泡和默认事件
	function stopPro(e){
		e.stopPropagation();
		e.preventDefault();
	}
	// 判断指定对象是否在数组中
	function isInArray(selectArr,exclusiveArr){
		var result=false;
		for(var i=0;i<exclusiveArr.length;i++){
			for(var j=0;j<selectArr.length;j++)
			{
				if(selectArr[j]==exclusiveArr[i])
				{
					return true;
				}
			}
			
		}
		return result;
	}
	// 数组中移除指定对象
	function removeInArray(array,obj)
	{
		for(var i=0;i<array.length;i++)
		{
			if(array[i]==obj)
			{
				array.splice(i,1);
				i--;
				//array[i]=null;
			}
		}
	}
	// 对象属性 json串和json对象互转
	function sessionUtil(session,action){
		for(var key in session)
		{
			if(action=="json"){ 			  // session属性转json
				session[key]=JSON.stringify(session[key]);
				}
			else if(action=="object"){		  //session属性转对象
				session[key]=JSON.parse(session[key]);
			}
		}
		return session;
	}
	// 判断是不是微信
	function is_weixin(){
		var ua = navigator.userAgent.toLowerCase();
		if(ua.match(/MicroMessenger/i)=="micromessenger") {
		return true;
		} else {
		return false;
		}
	}