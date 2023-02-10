$(document).ready(function () {
    // ========Email validation===========
     $(".email").on('change keyup',function () {    
         var inputvalues = $(this).val();    
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if(!regex.test(inputvalues))    
             $(".email_msg").text("Invalid E-mail ID"); 
         else $(".email_msg").text("");  
             
         }); 
       //   =======Mobile Number Validation=========
       $(".m_number").on('change keyup',function () {    
          var mobilevalues = $(this).val();    
          var regex = /^([6-9]{1}[0-9]{9})$/; 
          if(!regex.test(mobilevalues))    
              $(".m_number_msg").text("Invalid Mobile number"); 
          else
          $(".m_number_msg").text("");
          });
       //   =======Aadhar card validation========
       $(".aadhar").on('change keyup',function () {    
          var aadharvalues = $(this).val();    
          var regex = /^([2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4})|([2-9]{1}[0-9]{3}-[0-9]{4}-[0-9]{4})$/; 
          if(!regex.test(aadharvalues))    
              $(".aadhar_msg").text("Invalid Aadhar Card number"); 
          else
          $(".aadhar_msg").text("");    
              
          console.log('');
          });
          // ==========IFSC Code Validation======
          $(".ifsc").on('change keyup',function () {    
             var ifscvalues = $(this).val();    
             var regex = /^[A-Z]{4}[0-9]{7}$/; 
             if(!regex.test(ifscvalues))   
                 $(".ifsc_msg").text("Invalid IFSC Code"); 
             else 
             $(".ifsc_msg").text("");   
                 
             });
             //===============Name Validation ==========
     var min_name_Length = 3;
     var max_name_Length = 50;
     $(".min-max-name").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_name_Length)
           $(".min-max-name-message").text("Minimum " + min_name_Length + " character required.");
        else if (value.length > max_name_Length)
           $(".min-max-name-message").text("Maximum " + max_name_Length + " character allowed.");
        else
           $(".min-max-name-message").text("");
           var namevalues = $(this).val();    
             var regex = /^[a-zA-Z .]+$/; 
             if(!regex.test(namevalues))   
                 $(".name_msg").text("Invalid Name"); 
             else 
             $(".name_msg").text(""); 
     });
     //================Password Validation===========
     var min_password_Length = 8;
     var max_password_Length = 12;
     $(".min-max-password").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_password_Length)
           $(".min-max-password-message").text("Minimum " + min_password_Length + " character required.");
        else if (value.length > max_password_Length)
           $(".min-max-password-message").text("Maximum " + max_password_Length + " character allowed.");
        else
           $(".min-max-password-message").text("");
           var passwordvalues = $(this).val();    
             var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/; 
             if(!regex.test(passwordvalues))   
                 $(".password_msg").text("Invalid password"); 
             else 
             $(".password_msg").text(""); 
     });
     //================Confirm Password Validation============
     var min_cn_password_Length = 8;
     var max_cn_password_Length = 12;
     $(".min-max-cn_password").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_cn_password_Length)
           $(".min-max-cn_password-message").text("Minimum " + min_cn_password_Length + " character required.");
        else if (value.length > max_cn_password_Length)
           $(".min-max-cn_password-message").text("Maximum " + max_cn_password_Length + " character allowed.");
        else
           $(".min-max-cn_password-message").text("");
           var cn_passwordvalues = $(this).val();    
             var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/; 
             if(!regex.test(cn_passwordvalues))   
                 $(".cn_password_msg").text("Invalid password"); 
             else 
             $(".cn_password_msg").text(""); 
     });    
     //====================Fname Validation==========
     var min_fname_Length = 3;
     var max_fname_Length = 50;
     $(".min-max-fname").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_fname_Length)
           $(".min-max-fname-message").text("Minimum " + min_fname_Length + " character required.");
        else if (value.length > max_fname_Length)
           $(".min-max-fname-message").text("Maximum " + max_fname_Length + " character allowed.");
        else
           $(".min-max-fname-message").text("");
           var fnamevalues = $(this).val();    
             var regex = /^[a-zA-Z .]+$/; 
             if(!regex.test(fnamevalues))   
                 $(".fname_msg").text("Invalid Father Name"); 
             else 
             $(".fname_msg").text("");
     });
     //===============Occupation Validation==========
     var minLength = 3;
     var maxLength = 50;
     $(".min-max-occupation").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < minLength)
           $(".min-max-occupation-message").text("Minimum " + minLength + " character required.");
        else if (value.length > maxLength)
           $(".min-max-occupation-message").text("Maximum " + maxLength + " character allowed.");
        else
           $(".min-max-occupation-message").text("");
           var occupationvalues = $(this).val();    
             var regex = /^[a-zA-Z ,]+$/; 
             if(!regex.test(occupationvalues))   
                 $(".occupation_msg").text("Invalid Occupation"); 
             else 
             $(".occupation_msg").text("");
     });
     //=====================Annual Income==============
     var min_Length = 2;
     var max_Length = 6;
     $(".min-max-AnnualIncome").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_Length)
           $(".min-max-AnnualIncome-msg").text("Minimum " + min_Length + " digit required.");
        else if (value.length > max_Length)
           $(".min-max-AnnualIncome-msg").text("Maximum " + max_Length + " digit allowed.");
        else
           $(".min-max-AnnualIncome-msg").text("");
           var mobilevalues = $(this).val();    
          var regex = /^([0-9])+$/; 
          if(!regex.test(mobilevalues))    
              $(".annual_inc_msg").text("Invalid Annual Income"); 
          else
          $(".annual_inc_msg").text("");
     });
    //  =============Bank Account Number=============
    var min__Length = 8;
    var max__Length = 11;
    $(".min-max-BankAccount").on("keydown keyup change", function () {
       var value = $(this).val();
       if (value.length < min__Length)
          $(".min-max-BankAccount-msg").text("Minimum " + min__Length + " digit required.");
       else if (value.length > max__Length)
          $(".min-max-BankAccount-msg").text("Maximum " + max__Length + " digit allowed.");
       else
          $(".min-max-BankAccount-msg").text("");
    });
    var min_name___Length = 3;
     var max_name___Length = 50;
     $(".account_holder").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_name___Length)
           $(".min-max_account_holder_msg").text("Minimum " + min_name___Length + " character required.");
        else if (value.length > max_name___Length)
           $(".min-max_account_holder_msg").text("Maximum " + max_name___Length + " character allowed.");
        else
           $(".min-max_account_holder_msg").text("");
           var namevalues = $(this).val();    
             var regex = /^[a-zA-Z .]+$/; 
             if(!regex.test(namevalues))   
                 $(".account_holder_msg").text("Invalid Account Holder Name"); 
             else 
             $(".account_holder_msg").text(""); 
     });
 });    
//   =======Passport Size Photo=========
  var passport_s = "";
    $('#self_image').on('change', function () {
    passport_s = $("#self_image").val();
    var upld = passport_s.split('.').pop();
    if (upld == 'jpeg' || upld == 'jpg') {
        // alert("File uploaded is pdf")
     } else {
        alert("Only .jpg, .jpeg Image are allowed");
        $(this).val('');
        }
    if (this.files[0].size > 204800) {
        alert("Please upload .jpg, .jpeg Image file less than 200KB ....");
        $(this).val('');
    }

});
// =============Cast Certificate========
  var cast = "";
    $('#image_1').on('change', function () {
    cast = $("#image_1").val();
    var upld = cast.split('.').pop();
    if (upld == 'pdf') {
        // alert("File uploaded is pdf")
     } else {
        alert("Only PDF are allowed");
        $(this).val('');
        }
    if (this.files[0].size > 5242880) {
        alert("Please upload pdf file less than 5MB ....");
        $(this).val('');
    }

});
//==============Income Certificate============
var income_certificate = "";
    $('#image_2').on('change', function () {
    income_certificate = $("#image_2").val();
    var upld = income_certificate.split('.').pop();
    if (upld == 'pdf') {
        // alert("File uploaded is pdf")
     } else {
        alert("Only PDF are allowed");
        $(this).val('');
        }
    if (this.files[0].size > 5242880) {
        alert("Please upload pdf file less than 5MB ....");
        $(this).val('');
    }

});
// ================Bank first page/ Cheque Validation==========
var bank_passbook = "";
    $('#passbook_1').on('change', function () {
    bank_passbook = $("#passbook_1").val();
    var upld = bank_passbook.split('.').pop();
    if (upld == 'pdf') {
        // alert("File uploaded is pdf")
     } else {
        alert("Only PDF are allowed");
        $(this).val('');
        }
    if (this.files[0].size > 5242880) {
        alert("Please upload pdf file less than 5MB ....");
        $(this).val('');
    }

});
     var min_name_fami_Length = 3;
     var max_name_fami_Length = 50;
     $(".fami_name").on("keydown keyup change", function () {
        var value = $(this).val();
        if (value.length < min_name_fami_Length)
           $(".fami_name_msg").text("Minimum " + min_name_fami_Length + " character required.");
        else if (value.length > max_name_fami_Length)
           $(".fami_name_msg").text("Maximum " + max_name_fami_Length + " character allowed.");
        else
           $(".fami_name_msg").text("");
           var namevalues = $(this).val();    
             var regex = /^[a-zA-Z .]+$/; 
             if(!regex.test(namevalues))   
                 $(".fami_name-msg").text("Invalid Name"); 
             else 
             $(".fami_name-msg").text(""); 
     });