var plat=navigator.platform;
var ua=navigator.userAgent;
var is_mobile;
var is_mobile_pcmode;
if(plat.indexOf("Win32")==-1 && plat.indexOf("Win64")==-1)
{
	is_mobile=true;
	if(ua.indexOf("Windows")==-1)
	{
		is_mobile_pcmode=false;
	}
	else
	{
		is_mobile_pcmode=true;
	}
}
else
{
	is_mobile=false;
	is_mobile_pcmode=false;
}