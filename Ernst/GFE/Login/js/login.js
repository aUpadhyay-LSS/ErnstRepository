$(function() {			
				//the form wrapper (includes all forms)
				var $form_wrapper	= $('#form_wrapper'),
					//the current form is the one with class active
					$currentForm	= $form_wrapper.children('form.active'),
					//the change form links
					$linkform		= $form_wrapper.find('.linkform');
					
				var currentHash = window.location.hash;
					if (currentHash=="#register") {
						$currentForm.removeClass('active');
  			  	$currentForm	= $form_wrapper.children('form.register');
  			  	$currentForm.addClass('active');
					}	
						
				//get width and height of each form and store them for later						
				$form_wrapper.children('form').each(function(i){
					var $theForm	= $(this);
					//solve the inline display none problem when using fadeIn fadeOut
					if(!$theForm.hasClass('active'))
						$theForm.hide();
					$theForm.data({
						width	: $theForm.width(),
						height	: $theForm.height()
					});
				});
				
				//set width and height of wrapper (same of current form)
				setWrapperWidth();
				
				/*
				clicking a link (change form event) in the form
				makes the current form hide.
				The wrapper animates its width and height to the 
				width and height of the new current form.
				After the animation, the new form is shown
				*/
				$linkform.bind('click',function(e){
					var $link	= $(this);
					var target	= $link.attr('rel');
					$currentForm.fadeOut(400,function(){
						//remove class active from current form
						$currentForm.removeClass('active');
						//new current form
						$currentForm= $form_wrapper.children('form.'+target);
						$currentForm.find('input[type !="submit"]').val("");
						$currentForm.find(".error").css("visibility","hidden");
						//animate the wrapper
						$form_wrapper.stop()
									 .animate({
										width	: $currentForm.data('width') + 'px',
										height	: $currentForm.data('height') + 'px'
									 },500,function(){
										//new form gets class active
										$currentForm.addClass('active');
										//show the new form
										$currentForm.fadeIn(400);
									 });
					});
					e.preventDefault();
				});
				
				function setWrapperWidth(){
					$form_wrapper.css({
						width	: $currentForm.data('width') + 'px',
						height	: $currentForm.data('height') + 'px'
					});
				}
				
				/*validate email and check repeated password.*/				
				function email_validation(input) {
					var emailRegex = /^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i;
					if (!(emailRegex.test(input.val()))) {
						input.next().css("visibility","visible");
   			 	} else {
						input.next().css("visibility","hidden");
   		 		}
				}

				function repeat_check(input) {
					var pass = input.parent().prev().find("input.pass");
					if (input.val() != pass.val()) {
						input.next().css("visibility","visible");
					} else {
						input.next().css("visibility","hidden");
					}
				}

				$form_wrapper.children('form.register').find("input.email").focusout(function() {
						email_validation($(this));
				});
				$form_wrapper.children('form.login').find("input.email").focusout(function() {
						email_validation($(this));
				});
				$form_wrapper.children('form.forgot_password').find("input.email").focusout(function() {
						email_validation($(this));
				});
				$form_wrapper.children('form.register').find("input.re_pass").focusout(function() {
						repeat_check($(this));
				});
				/*
				for the demo we disabled the submit buttons
				if you submit the form, you need to check the 
				which form was submited, and give the class active 
				to the form you want to show
				*/
				$form_wrapper.find('input[type="submit"]')
							 .click(function(e){
								e.preventDefault();
								var current_form = $(this).parent().parent();
								var email_error = current_form.find(".email").next();
								var repeat_pass = current_form.find(".re_pass").next();
								var submit_url;
								
								current_form.find(".return_error").html("");
								if (current_form.hasClass("register")) {
									submit_url = "register.php";
								} else if (current_form.hasClass("login")) {
									submit_url = "login.php";
								} else {
									submit_url = "forgot.php";
								}
								if (email_error.css("visibility") != "visible" && repeat_pass.css("visibility") != "visible") {
									$.ajax({
										url: submit_url,

										data: current_form.serialize(),
							
										type: "POST",

										dataType: "html",

										success: function(res) {
											if (submit_url == "login.php") {
												if (res.substr(0,4) == "http") {
													location.href = res;
												} else {
													current_form.find(".return_error").html(res);
												}
											} else if (submit_url == "register.php") {
												if (res.substr(0,4) == "http") {
													location.href = res.substr(0,res.lastIndexOf(".php")+4);
                                                                                                }
                                                                                                if (res.substr(0,5) == "Sorry") {
													current_form.find(".return_error").html(res);
												}
                                                                                                else {
													$("#login_link").trigger("click");
													$("#login_return").html(res);
												}
											} else {
												current_form.find(".return_error").html(res);
											}
										}
									});
								}
							 });	
			});
