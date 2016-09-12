function loadingcar(m,n){
   var html="";
   var temp = dsy.Items[n];
   for(var i=0;i<temp.length;i++){
	   if(m==1) {html+='<li><a href="#'+temp[i]+'">'+temp[i]+'</a></li>'; }
	   else if(m==3) {html+='<li onclick="setCarname(this)" >'+temp[i]+'</li>';}
	   else{}
   }
   $("#car"+m).html(html);
}
function loadingbrand(){
	var cha = dsy.Items[0];
	var html="";
	$("#car3").html("");
	for(var i=0;i<cha.length;i++)
	{
		var temp = dsy.Items[cha[i]];
		html+='<ul id="'+cha[i]+'">';
		for(var j=0;j<temp.length;j++)
		{
			html+='<li brand="'+temp[j]+'"><img src="images/'+convertToPinyin(temp[j]).toLocaleLowerCase()+'.gif"/><span>'+temp[j]+'</span></li>';
		}
		html+='</ul>';
	}
	$("#brand").html(html);
}
$(function(){
	//loadingcar(1,0);
	//loadingbrand();
})