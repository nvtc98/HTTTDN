$(function() //after DOM is loaded
{
	var header = document.getElementById("myHeader");
	var sticky = header.offsetTop;
	
	function stickyHeader() //function that checks sticky header position
	{
		if (window.pageYOffset < sticky)
			header.classList.remove("sticky");
		else
			header.classList.add("sticky");
	}
	stickyHeader(); //check now
	
	function backToTopOnScroll() //to show/hide back-to-top button
	{
		if ($(window).scrollTop() > 50) 
			$("#back-to-top").fadeIn();
		else
			$("#back-to-top").fadeOut();
	}
	
	$(window).scroll(function() //on-scroll event
	{
		stickyHeader();
		backToTopOnScroll();
		$("#slide").css({"background-position": "0px " + $(window).scrollTop()/2+ "px"}); //sliding hat-der effect
	});
	
	//click event for #back-to-top
	$("#back-to-top").click(function() {$("body,html").animate({scrollTop: 0}, "slow");}); 
});

function encode(s)
{
	var rand=Math.floor((Math.random()*100)+33)
	var result=String.fromCharCode(rand);
	var si;
	for(var i=0;i<s.length;i++)
	{
		si=s.charCodeAt(i);
		result+=String.fromCharCode(si+rand);
		if(si%2)
			result+=String.fromCharCode(rand+Math.floor((Math.random()*100)+1));
	}
	return result;
}

function decode(s)
{
	var pivot=s.charCodeAt(0);
	var result="";
	var si;
	for(var i=1;i<s.length;i++)
	{
		si=s.charCodeAt(i)-pivot;
		result+=String.fromCharCode(si);
		if(si%2)
			i++;
	}
	return result;
}

function searchPageCheck()
{
	if(window.location.href.indexOf("search.php")==-1)
		return true;
	else
	{
		filter();
		return false;
	}
}

function looseMatch(s1, s2)
{
	s1=s1.toLowerCase().trim();
	s2=s2.toLowerCase().trim();
	var f = new Array(s2.length+1);
	var p = new Array(s2.length+1);
	for(var i=0;i<=s2.length;i++)
	{
		f[i] = new Array(s1.length+1);
		p[i] = new Array(s1.length+1);
		f[i][0]=0;
		p[i][0]=0;
	}
	for(var i=1;i<=s1.length;i++)
	{
		f[0][i]=0;
		p[0][i]=0;
	}
	for(var i=0;i<s2.length;i++)
		for(var j=0;j<s1.length;j++)
			if(s2[i]==s1[j])
			{
				f[i+1][j+1]=Math.max(Math.max(f[i][j+1],f[i+1][j]),f[i][j]+1);
				p[i+1][j+1]=p[i][j]+1;
			}
			else
			{
				f[i+1][j+1]=Math.max(f[i][j+1],f[i+1][j]);
				p[i+1][j+1]=0;
			}
	var i=s2.length;
	var j=s1.length;
	var d=1;
	while(f[i][j]>0)
	{
		if(f[i][j]==f[i][j-1])
			j--;
		else if(f[i][j]==f[i-1][j])
			i--;
		else
		{
			if(p[i-1][j-1]>0) d++;
			i--;
			j--;
		}
	}
	if(d/s2.length>=0.6)
		return true;
	return false;
}