jQuery.fn.validate = function() {
	var val=this;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		val.submit(function(){
			var i=0;
			$('.error_string').hide();
			$v=val.find('.required');
			$v.each(function(){
				$t=$(this);
				$name=$t.attr('title'); 
				$left=($t.offset().left+$t.width()+20)+'px';
				$top=($t.offset().top)+'px';
				if($t.attr('type')=='checkbox') {
						if($t.attr('checked')==false){
						i++;
						$('body').append('<div class=error_string style="left:'+$left+';top:'+$top+';">'+$name+' should be checked</div>');
						}
				}
				else {
					if($t.val()=='') {
						i++;
						$('body').append('<div class=error_string style="left:'+$left+';top:'+$top+';">'+$name+' Field should not be empty</div>');
					}
				}
			});
			$v=val.find('.email');
			$v.each(function(){
				$t=$(this);
				$name=$t.attr('title'); 
				$left=($t.offset().left+$t.width()+20)+'px';
				$top=($t.offset().top)+'px';
				if($t.val()=='') {
					i++;
					$('body').append('<div class=error_string style="left:'+$left+';top:'+$top+';">'+$name+' Field should not be empty</div>');
				}
				else if(reg.test($t.val()) == false) {
					i++;
					$('body').append('<div class=error_string style="left:'+$left+';top:'+$top+';">'+$name+' Field is not valid email</div>');
				}
			});
			if(i==0) return true;
			else return false;
		});
};