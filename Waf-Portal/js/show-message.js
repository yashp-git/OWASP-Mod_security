var request;
var divis;
var file;


function dispage(file,di)
	{
		

	//var nam=document.getElementById(el[1]).value;;
	var s=file;
	var qs="?";
		//document.getElementById("divload").show="block";

	for(i=0; i<document.forms[0].elements.length ; i++)
	{
		
		//alert(document.forms[0].elements[i].type);
		if(document.forms[0].elements[i].type=="radio" || document.forms[0].elements[i].type=="checkbox")
		{
			//alert(document.forms[0].elements[i].name.value);			
			if(document.forms[0].elements[i].checked==true || document.forms[0].elements[i].selected==true )
			{
				//	alert(document.forms[0].elements[i].name.value);			
				
				qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
			}
			else
			{
				qs=qs+"absent="+document.forms[0].elements[i].value+"&";
			}
		}
		else
		{
			qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
		}
	}
		qs=qs.substring(0,qs.length-1);
		//alert(qs);
		s=s+qs
		sendRequest(s,di)
		//alert('hi');
		
}

function dispageddd(file,di)
	{
		

	//var nam=document.getElementById(el[1]).value;;
	var s=file;
	var qs="?";
		//document.getElementById("divload").show="block";
	
	for(i=0; i<document.forms[0].elements.length ; i++)
	{
		
		//alert(document.forms[0].elements[i].name);
		if(document.forms[0].elements[i].name=="Select")
		{
			if(document.forms[0].elements[i].checked==true)
			{
				//alert('selected');
						qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
			}
		}
		else
		{
			qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
		}
	}
		qs=qs.substring(0,qs.length-1);
		//alert(qs);
		s=s+qs
		sendRequest(s,di)
		//alert('hi');
		
}
function dispage11(file,di)
	{
		

		//var nam=document.getElementById(el[1]).value;;
     		var s=file;
		var qs="?";
		//document.getElementById("divload").show="block";
		for(i=0; i<document.forms[0].elements.length ; i++)
		{
		//	alert(document.forms[0].elements[i].name);
			qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
		}
		qs=qs.substring(0,qs.length-1);
		//alert(qs);
		s=s+qs
		sendRequest(s,di)
		alert('hi');
		//document.getElementById("divload").show="none";
	}
function getRequestObject() {
  if (window.ActiveXObject) {
    return(new ActiveXObject("Microsoft.XMLHTTP"));
  } else if (window.XMLHttpRequest) {
    return(new XMLHttpRequest());
  } else {
    return(null);
  }
}

function sendRequest(file,di) {
	
  request = getRequestObject();
 divis=di;	
  request.onreadystatechange = handleResponse;

  request.open("get", file, true);
  request.send(null);
}

function handleResponse() {

  if (request.readyState == 4) {
 document.getElementById(divis).innerHTML = request.responseText;
//    alert(request.responseText);
  }
}



function openPage(url) 
{

	window.location=url;
 
}
function dispageAll(file,di)
	{
		
	

	//var nam=document.getElementById(el[1]).value;;
	var s=file;
	var qs="?";
		//document.getElementById("divload").show="block";

	for(i=0; i<document.forms[0].elements.length ; i++)
	{
			
		//alert(document.forms[0].elements[i].name);
		//	alert(document.forms[0].elements[i].name.value);			
				
			qs=qs+document.forms[0].elements[i].name+"='"+document.forms[0].elements[i].value+"'&";

			
		
	}
		qs=qs.substring(0,qs.length-1);
		alert(qs);
		s=s+qs
		sendRequest(s,di)
		//alert('hi');
		
}
function dispagemm(file,di)
	{
		
	

	//var nam=document.getElementById(el[1]).value;;
	var s=file;
	var qs="?";
		//document.getElementById("divload").show="block";

	for(i=0; i<document.forms[0].elements.length ; i++)
	{
		
		alert(document.forms[0].elements[i].name);
		if(document.forms[0].elements[i].type=="Radio" || document.forms[0].elements[i].type=="checkbox")
		{
			
			if(document.forms[0].elements[i].checked==true)
			{
					alert(document.forms[0].elements[i].name.value);			
				
						qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
			}
		}
		else
		{
			qs=qs+document.forms[0].elements[i].name+"="+document.forms[0].elements[i].value+"&";
		}
	}
		qs=qs.substring(0,qs.length-1);
		//alert(qs);
		s=s+qs
		sendRequest(s,di)
		//alert('hi');
		
}


function toggleWindow(id)
{
	var d=document.getElementById(id);
	//alert(d.id);	
	if(d.show=="none")
		d.show='none';
	else
		d.show='block';

}


function openWiget(id,tb,url)
{
	alert(tb);	
	id.loadContent(tb,url);
	id.init();
}


function is_it_checked(form)
{

				if(document.forms[0].selectall.checked)
				{
					if(document.forms[0].select.length==undefined)
						document.forms[0].select.checked=true;
					else{
						for(i=0;i<document.forms[0].select.length;i++)
							document.forms[0].select[i].checked=true;
					}
				}
				else
				{
					if(document.forms[0].select.length==undefined)
						document.forms[0].select.checked=false;
					else{
						for(i=0;i<document.forms[0].select.length;i++)
							document.forms[0].select[i].checked=false;
					}
				}
}


			function is_it_unchecked(form)
			{
				
				//alert("affan"+document.forms[0].select.length);
				if(document.forms[0].select.length==undefined)
				{
					if(document.forms[0].select.checked==true)
						document.forms[0].selectall.checked=true;
					else
						document.forms[0].selectall.checked=false;
				}
				else
				{
					if(document.forms[0].selectall.checked=true)
					{
						//form.name.checked=false;
						document.forms[0].selectall.checked=false;
					}	
					for(i=0;i<document.forms[0].select.length && document.forms[0].select[i].checked==true;i++){}
					if(i==document.forms[0].select.length)
						document.forms[0].selectall.checked=true;
				}
			}




function is_it_checked1()
{

				if(document.forms[0].selectall.checked)
				{
					if(document.forms[0].select.length==undefined)
						document.forms[0].select.checked=true;
					else{
						for(i=0;i<document.forms[0].select.length;i++)
							document.forms[0].select[i].checked=true;
					}
				}
				else
				{
					if(document.forms[0].select.length==undefined)
						document.forms[0].select.checked=false;
					else{
						for(i=0;i<document.forms[0].select.length;i++)
							document.forms[0].select[i].checked=false;
					}
				}
}


			function is_it_unchecked1()
			{
				
				//alert("affan"+document.forms[1].select.length);
				if(document.forms[0].select.length==undefined)
				{
					if(document.forms[0].select.checked==true)
						document.forms[0].selectall.checked=true;
					else
						document.forms[0].selectall.checked=false;
				}
				else
				{
					if(document.forms[0].selectall.checked=true)
					{
						//form.name.checked=false;
						document.forms[0].selectall.checked=false;
					}	
					for(i=0;i<document.forms[0].select.length && document.forms[0].select[i].checked==true;i++){}
					if(i==document.forms[0].select.length)
						document.forms[0].selectall.checked=true;
				}
			}




function sendRequestmm(file,di)
 {

alert(file);
	
  request = getRequestObject();
 divis=di;	
  request.onreadystatechange = handleResponse;

  request.open("get", file, true);
  request.send(null);
}
