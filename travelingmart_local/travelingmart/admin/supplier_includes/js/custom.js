$(document).ready(function(){
   	$('#menu li ul').hide();
	$('#menu li a.current').parent().find("ul").slideToggle('slow');
	$('#menu li a.parents').click(
		function () {
			$(this).parent().siblings().find('ul').slideUp('normal');
			$(this).next().slideToggle('normal');
			return false;
		}
	);
	$('#menu li a.nochild').click(
		function () {
			window.location.href=(this.href);
			return false;
		}
	);
	$('#menu li .parents').hover(
		function () {
			$(this).stop();
			$(this).animate({ paddingLeft: '20px' }, 200);
		}, 
		function () {
			$(this).stop();
			$(this).animate({ paddingLeft: '10px' });
		}
	);
	
	$('.close').click(
		function () {
			$(this).parent().fadeTo(400, 0, function () {
				$(this).slideUp(200);
			});
			return false;
		}
	);
	$('tbody tr:even').addClass('alt-row');
});

function Edit(ID)
{   
    document.getElementById('Original_' + ID).style.display = "none";  
    document.getElementById('Edit_' + ID).style.display = "block";
}

function CCSurcharge(chkbx)
{
    alert("checking");
    alert(chkbx);
     if(document.getElementById('chkbx_' + chkbx).checked == true)
     {
        alert("checked");
     }
     else
     {
        alert("unchecked");
     }
}

function GroupRes(ID, Type)
{   
    document.getElementById(ID).style.display = Type;  
}

function CommentsOption(ID)
{
    alert(ID);
    document.getElementById('cmnts_' + ID).style.display = "block";
}