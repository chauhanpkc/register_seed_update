// For Alphabets input Only
function validatestrings(inputtxt) {
    if ((inputtxt.value) != " ") {
        var character = /^[a-zA-Z .]+$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "Error",
                text: "Only Alpahabets Are Allowed!",
                icon: "warning",
                button: "OK",
            });
            inputtxt.value = "";
            $(inputtxt).val(inputtxt.value);
        }
    } else {
        swal({
            title: "Error!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OK",
        });
    }
}
// For password 
function validatepassword(inputtxt) {
    if ((inputtxt.value) != " ") {
        var character = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "Error",
                text: "Only Alphanumeric Are Allowed!",
                icon: "warning",
                button: "OK",
            });
            inputtxt.value = "";
            $(inputtxt).val(inputtxt.value);
        }
    } else {
        swal({
            title: "Error!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OK",
        });
    }
}
// Occupation========
function validatestrings_occu(inputtxt) {
    if ((inputtxt.value) != " ") {
        var character = /^[a-zA-Z ,]+$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "Error",
                text: "Only Alpahabets Are Allowed!",
                icon: "warning",
                button: "OK",
            });
            inputtxt.value = "";
            $(inputtxt).val(inputtxt.value);
        }
    } else {
        swal({
            title: "Error!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OK",
        });
    }
}

// Only Alphabets and numeric are allowed
function validate_student_id(inputtxt) {
    if (inputtxt.value != null && (inputtxt.value).length>0 && inputtxt.value!=0) {
        var character = /^[a-zA-Z0-9]+[0-9a-zA-Z -.-\/]+$/;
        console.log(inputtxt.value.match(character));
        if (!inputtxt.value.match(character)) {
            swal({
                title: "OOPS!",
                text: "Only A-z0-9.-/ allowed and space are not allowed!",
                icon: "warning",
                button: "OKAY",
            });
            inputtxt.value = "";
            $(inputtxt.id).val(inputtxt.value);
        }
    } else {
        $(':input[type="submit"]').prop("disabled", false);
        swal({
            title: "OOPS!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OKAY",
        });
        inputtxt.value = "";
        $(inputtxt.id).val(inputtxt.value);
    }
  }


//   Only for Email Validation
function validateemail(inputtxt) {
    if (inputtxt.value != null) {
        var character = /^[a-zA-Z0-9.]+(\[._-a-zA-Z0-9.]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-.]+)+(\.[a-zA-Z]{2,4})*$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "Fail!",
                text: "Not a Valid Email!",
                icon: "warning",
                button: "OK",
            });
            inputtxt.value = "";
            $(inputtxt.id).val(inputtxt.value);
        }
    } else {
        swal({
            title: "Fail!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OK",
        });
        inputtxt.focus();
    }
}

//   Only for IFSC Validation
function validateifsc(inputtxt) {
    if (inputtxt.value != null) {
        var character = /^[A-Z]{4}[0-9]{7}$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "Fail!",
                text: "Not a Valid IFSC code!",
                icon: "warning",
                button: "OK",
            });
            inputtxt.value = "";
            $(inputtxt.id).val(inputtxt.value);
        }
    } else {
        swal({
            title: "Fail!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OK",
        });
        inputtxt.focus();
    }
}


// Only for Aadhar Number validation
function AadharValidation(inputtxt) {
    var aadhar = inputtxt.value;
    var aadhar=aadhar.replace(/\s/g, '');
   
    var adharcardTwelveDigit = /^\d{12}$/;
//   var regexp = new RegExp(/(\b(?:([0-9\s])(?!\2{2}))+\b)/);
  var regexp = new RegExp(/(^[1-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$)|(^[0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|(^[0-9]{4}-[0-9]{4}-[0-9]{4}$)/);
  
  
    if (aadhar != '') {
        if(aadhar.match(adharcardTwelveDigit)) {
            if(!regexp.test(aadhar)) { 
              swal({
                  title: "OOPS!",
                  text: "Addhar Number Not valid!",
                  icon: "warning",
                  button: "OKAY",
                });
                inputtxt.value = "";
                $(inputtxt.id).val(inputtxt.value);
              }
        }
        else{
          swal({
            title: "OOPS!",
            text: "Addhar Number Not valid",
            icon: "warning",
            button: "OKAY",
          });
          inputtxt.value="";
        }
    }
  }
  
//   Only for Contact Number
  function phonenumber(inputtxt) {
    if (inputtxt.value != 10) {
        var phoneno = /^[6-9]\d{9}$/;
        if (!inputtxt.value.match(phoneno)) {
            swal({
                title: "OOPS!",
                text: "Phone Number Not valid!",
                icon: "warning",
                button: "OKAY",
            });
            inputtxt.value = "";
            $(inputtxt.id).val(inputtxt.value);
        }
    } else {
        swal({
            title: "OOPS!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OKAY",
        });
    }
}


// For bank Account Number
function validatenumber(inputtxt) {
    if (inputtxt.value != " ") {
        var character = /^[0-9]*$/;
        if (!inputtxt.value.match(character)) {
            swal({
                title: "OOPS!",
                text: "Only Numbers Are Allowed!",
                icon: "warning",
                button: "OKAY",
            });
            inputtxt.value = "";
            $(inputtxt.id).val(inputtxt.value);
        }
    } else {
        swal({
            title: "OOPS!",
            text: "Please Enter the value",
            icon: "warning",
            button: "OKAY",
        });
        inputtxt.focus();
    }
}