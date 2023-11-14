{{-- user-email-convert-to-username.blade.php --}}

{{-- This Blade file contains a form for user creation or editing in a Laravel application. 
     It includes fields for email, mobile number, and username, with validation and dynamic 
     username generation based on the email. It also contains JavaScript for client-side 
     validation and AJAX requests to check username and supervisor availability. --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <form class="user-email-convert-to-username" data-uid="{{ $user->id ?? '' }}">
        {{-- Email Field --}}
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-Mail <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {{-- Blade directive for form input --}}
                {!! Form::text('email', $dataForView["email"] ?? '', [
                    'class' => 'form-control email',
                    'autocomplete' => 'off',
                    'type' => 'text',
                    'placeholder' => 'example@test.com'
                ]) !!} 
            </div>
            <div class="error">{{ $errors->first('email') }}</div>
        </div><!-- Email -->

        {{-- Other form fields like Mobile No, etc. --}}

        {{-- Username Field --}}
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username (Used for login) <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="input-group">
              {!!
                Form::text('username',(!empty($dataForView["username"])) ? $dataForView["username"] : '' ,[
                  'class' => 'form-control username',
                  'autocomplete'=>'off',
                  'type'=>'text',
                  'placeholder'=>'example'
                ]);
              !!} 
              <span class="input-group-btn"> <button type="button" class="btn btn-success chkavlblty"><i class="fa fa-search"></i>Check Availabilty </button> </span></div> 
              <div class="usernameerror"></div>
          </div>
          <div class="error">{{ $errors->first('username') }}</div>
        </div><!-- User Name --> 

        {{-- Additional Fields (if any) --}}

    </form>
</div>

{{-- Include JavaScript for form handling --}}
<script type="text/javascript">
/**
 * user-form-handling.js
 * 
 * This script enhances the user form functionality in a web application. It includes
 * automatic username generation from the email field, dynamic checking of username and
 * supervisor availability, and handling of form field changes.
 * 
 * Key Functionalities:
 * 1. Auto-generates a username from the email and assigns it to the username field.
 * 2. Checks username availability with an AJAX call.
 * 3. Disables the supervisor field based on the selected role.
 * 4. Checks supervisor availability with an AJAX call.
 */

// Event listener for input on email field
$('.email').on('input',function(event){
    // Get the email value and remove any spaces
    var email = $(this).val().replace(/\s/g, "");
    $(this).val(email);

    // Split the email into parts and set the username field
    var emailParts = email.split("@");
    var username = emailParts.length==2 ? emailParts[0] : null;
    $('.username').val(username);

    // Clear any previous username errors
    $('.usernameerror').html('');
    $('.usernameerror').removeClass('error');
    $('.usernameerror').removeClass('noerror');
});

// Event listener for input on username field
$('.username').on('input',function(event){
    // Get the username value and remove any spaces
    var username = $(this).val().replace(/\s/g, "");
    $(this).val(username);
});

// Event listener for focus out on username field
$(".username").focusout(function(){
    // Trigger the check availability click event
    $(".chkavlblty").trigger("click");
});

// Event listener for check availability click event
$('.chkavlblty').on('click',function(event){
    // Clear any previous username errors
    $('.usernameerror').html('');
    $('.usernameerror').removeClass('error');
    $('.usernameerror').removeClass('noerror');

    // Get the username value
    var username = $('.username').val();
    var uid = $(".user-form").attr("data-uid"),url="{{URL::to('/users/checkUsername')}}";uid&&(url+="/"+uid);

    // Prepare the data object for the AJAX request
    var dataObj = {'username':username};
    if (username) {
      // Make the AJAX request
      $.ajax({
          url: url,
          method: "POST",
          data: dataObj,
          dataType: 'JSON',
          cache: false,
          beforeSend: function() {overlay('show'); },
          success: function(data) {
            // Handle the response from the server
            if (data.response == 1) {
              $('.usernameerror').html("<i class='fa fa-check-circle'></i> Username available");
              $('.usernameerror').addClass('noerror');
            } else if (data.response == 0) {
              $('.usernameerror').html("<i class='fa fa-times-circle'></i> Username is not available");
              $('.usernameerror').addClass('error');
            } else {
              $('.usernameerror').html("<i class='fa fa-exclamation-circle'></i> Something went wrong please try again");
              $('.usernameerror').addClass('error');
            }
            overlay('hide'); 
          },
          fail: function(xhr, textStatus, errorThrown){overlay('hide'); customAlert('Error!!!','Something went wrong please try again','red'); }, 
          error: function(data){overlay('hide'); customAlert('Error!!!','Failed to processing request. Please try again later.','red'); }
      });
    }
});

// Get the role ID and disable the supervisor ID field for certain roles
var roleId = $('.roleId').val();
if (roleId == 4 || roleId == 6) {
    $('.supervisorEmpId').prop('disabled',true);
}

// Event listener for change on role ID field
$('.roleId').on('change',function(event){
    var roleId = $(this).val();
    if (roleId == 4 || roleId == 6) {
      $('.supervisorEmpId').prop('disabled',true);
    } else {
      $('.supervisorEmpId').prop('disabled',false);
    }
});

// Event listener for focus out on supervisor ID field
$(".supervisorEmpId").focusout(function(){
    // Trigger the check availability click event
    $(".chkavlbltyspvsr").trigger("click");
});

// Event listener for check availability click event
$('.chkavlbltyspvsr').on('click',function(event){
    // Clear any previous supervisor ID errors
    $('.supempiderror').html('');
    $('.supempiderror').removeClass('error');
    $('.supempiderror').removeClass('noerror');

    // Get the supervisor ID value
    var emp_id = $('.supervisorEmpId').val();
    var uid = $(".user-form").attr("data-uid"),url="{{URL::to('/users/checkSupervisorUid')}}";uid&&(url+="/"+uid);

    // Prepare the data object for the AJAX request
    var dataObj = {'emp_id':emp_id};
    if (emp_id) {
      // Make the AJAX request
      $.ajax({
          url: url,
          method: "POST",
          data: dataObj,
          dataType: 'JSON',
          cache: false,
          beforeSend: function() {overlay('show'); },
          success: function(data) {
            // Handle the response from the server
            if (data.response == 1) {
              $('.supempiderror').html("<i class='fa fa-check-circle'></i> Supervisor is available");
              $('.supempiderror').addClass('noerror');
            } else if (data.response == 0) {
              $('.supempiderror').html("<i class='fa fa-times-circle'></i> Supervisor is is not available");
              $('.supempiderror').addClass('error');
            } else {
              $('.supempiderror').html("<i class='fa fa-exclamation-circle'></i> Something went wrong please try again");
              $('.supempiderror').addClass('error');
            }
            overlay('hide'); 
          },
          fail: function(xhr, textStatus, errorThrown){overlay('hide'); customAlert('Error!!!','Something went wrong please try again','red'); }, 
          error: function(data){overlay('hide'); customAlert('Error!!!','Failed to processing request. Please try again later.','red'); }
      });
    }
});     


</script>
