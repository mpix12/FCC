$("#login-btn").click(function(){
	var user_email = $("#user-email").val();
	var user_password = $("#user-password").val();
	var captcha = grecaptcha.getResponse();
	var validation = true;
	if(!validateEmail(user_email)){
		$("#user-email").addClass('validate-error-input');
		validation = false;
	} else {
		$("#user-email").removeClass('validate-error-input');
	}

	if(user_password == ""){
		$("#user-password").addClass('validate-error-input');
		validation = false;
	} else {
		$("#user-password").removeClass('validate-error-input');
	}

	if (captcha == "" ) {
		$(".captcha-item .g-recaptcha").addClass('validate-error-input');
		validation = false;
	} else {
		$(".captcha-item .g-recaptcha").removeClass('validate-error-input');
	}

	if (!validation){return;}

	showloading();

	$.ajax({
		url: baseURL + 'user/b_signin',
		data: {
			email: user_email,
			password: user_password,
			captcha:  captcha
		},
		dataType: 'json',
		type: 'post'
	}).done(function(data){
		if(data.code == "success") {
			$("#login-error-alert").hide();
			$("#login-success-alert").show();
			$("#login-success-alert .alert-data").html(data.message);

			setTimeout(function(){ window.location = baseURL + 'user/myaccount' }, 3000);
		} else {
			$("#login-error-alert").show();
			$("#login-success-alert").hide();
			$("#login-error-alert .alert-data").html(data.message);
		}
	}).fail(function(){
		
	}).always(function(){
		hideloading();
	});

	// bind 'myForm' and provide a simple callback function
	// console.log(grecaptcha.getResponse());
 //       $('#login-form').ajaxForm(function() {
 //           alert("Thank you for your comment!");
 //       });

  // $('#login-form').submit();
});


       