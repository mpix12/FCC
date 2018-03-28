var sidebar_toggle_btn = $(".myaccount .myaccount-content .myaccount-content-header .sidebar-toggle-btn");
var sidebar = $(".myaccount .sidebar");
var myaccount_content = $(".myaccount .myaccount-content");


sidebar_toggle_btn.click(function(){
	var classes = sidebar.attr('class');
	if(classes.includes("collapsed")){
		sidebar.removeClass("collapsed");
		myaccount_content.removeClass("collapsed");

	} else{
		sidebar.addClass("collapsed");
		myaccount_content.addClass("collapsed");
	}
});

$(".myaccount .sidebar .menu-item").click(function(){
	$(".myaccount .sidebar .menu-item").removeClass('active');
	$(this).addClass('active');

	$(".myaccount-content-item").removeClass('active');
	var selectedId = $(this).data('item-name');
	$("#" + selectedId).addClass('active');
	
});

$("#save-firstname-btn").click(function(){
	var firstname = $("#firstname-input").val();

	$.ajax({
		url : baseURL + 'user/b_save_firstname',
		data: {
			firstname: firstname
		},
		type: 'post'
	}).done(function(){
		showMyAccountAction('success', 'First Name is saved successfully');
	}).fail(function(){
		showMyAccountAction('error', 'First Name is not saved');
	});
});

$("#save-lastname-btn").click(function(){
	var lastname = $("#lastname-input").val();

	$.ajax({
		url : baseURL + 'user/b_save_lastname',
		data: {
			lastname: lastname
		},
		type: 'post'
	}).done(function(){
		showMyAccountAction('success', 'Last Name is saved successfully');
	}).fail(function(){
		showMyAccountAction('error', 'Last Name is not saved');
	});;
});

$("#save-email-btn").click(function(){
	var email = $("#email-input").val();

	$.ajax({
		url : baseURL + 'user/b_save_email',
		data: {
			email: email
		},
		type: 'post'
	}).done(function(){
		showMyAccountAction('success', 'Email is saved successfully');
	}).fail(function(){
		showMyAccountAction('error', 'Email is not saved');
	});;
});

$("#save-username-btn").click(function(){
	var username = $("#username-input").val();

	$.ajax({
		url : baseURL + 'user/b_save_username',
		data: {
			username: username
		},
		type: 'post'
	}).done(function(){
		showMyAccountAction('success', 'User Name is saved successfully');
	}).fail(function(){
		showMyAccountAction('error', 'User Name is not saved');
	});;
});

$("#save-phone-btn").click(function(){
	var phone = $("#phone-input").val();

	$.ajax({
		url : baseURL + 'user/b_save_phone',
		data: {
			phone: phone
		},
		type: 'post'
	}).done(function(){
		showMyAccountAction('success', 'Phone Number is saved successfully');
	}).fail(function(){
		showMyAccountAction('error', 'Phone Number is not saved');
	});;
});


function showMyAccountAction(status = 'success', messageBody){
	if(status == "success"){
		$("#myaccount-action-alert-body").append(`
			<div class="alert alert-success alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Success!</strong> `+ messageBody +`
			</div>
		`);	
	} else {
		$("#myaccount-action-alert-body").append(`
			<div class="alert alert-danger alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error</strong> `+ messageBody +`
			</div>
		`);	
	}
	
}

$(".order-view-detail").click(function(){
	var parent = $(this).parent().parent();
	var id = parent.children('.transaction-id').text();
	var detail = parent.children('.order-detail').text();
	var date = parent.children('.order-date').text();
	var status = parent.children('.order-status').text();
	
	$(".order-detail-modal-body .transaction-id").text(id);
	$(".order-detail-modal-body .order-detail").text(detail);
	$(".order-detail-modal-body .order-date").text(date);
	$(".order-detail-modal-body .order-status").text(status);
});

$(".view-contact-modal-btn").click(function(){
	var parent = $(this).parent().parent();
	var in_or_out = parent.children('.in-or-out').html();
	var from = parent.children('.from-user').text();
	var to = parent.children('.to-user').text();
	
	$(".view-contact-modal-body .in-or-out").html(in_or_out);
	$(".view-contact-modal-body .from-user").text(from);
	$(".view-contact-modal-body .to-user").text(to);
});