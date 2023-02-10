
<?php include('./src/db_config/db_connection.php');
  include('./includes/nav.php');
  // include('./includes/header.php'); 
  if(isset($_POST['btn_sbmit'])) {
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
      $secretKey = '6LcZ-_khAAAAABQGTuUu4lsq08uI6FDVSGm30bA7'; 
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
      $responseData = json_decode($verifyResponse);
      if($responseData->success){
    $check_record = "SELECT * FROM registrations WHERE  aadhar = '".$_POST['aadhar']."' ";
    $check_result = mysqli_query($conn, $check_record);
    $numrows=mysqli_num_rows($check_result);
    if($numrows > 0) { ?>
      <script>alert('Aadhar number is already exist!')</script>";
    <?php } else {
      $sql = "SELECT * FROM state WHERE status = 'Active' AND state_id = '".$_POST['state']."' ";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $top3 = mb_substr($row['state_title'], 0, 3);
      $state_name = strtoupper($top3);
      // $reg_id = $state_name.rand (1000 , 9999);
      $rand = date('y-m-d-His');
      $reg_id = $state_name.$rand;
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $email = trim($email);
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
      $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
      $aadhar = mysqli_real_escape_string($conn, $_POST['aadhar']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $district = mysqli_real_escape_string($conn, $_POST['district']);
      $income_total = mysqli_real_escape_string($conn, $_POST['income_total']);
    
      $community = mysqli_real_escape_string($conn, $_POST['community']);
      $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
      $income = mysqli_real_escape_string($conn, $_POST['income']);

      $rand2 = mt_rand(100000,999999);
      $profile = './uploads/certificate';
      for($k=1;$k<3;$k++) {          
        if(!empty($_FILES['image_'.$k]['name'])) {
          $fileThumbnail = $_FILES['image_'.$k]['tmp_name'];
          $arrayimage[$k] = $_FILES['image_'.$k]['name'];
          $add_thumbnail=$profile."/".$k."_".$rand2."_".$arrayimage[$k];
          if (is_uploaded_file($fileThumbnail)) {
            move_uploaded_file ($fileThumbnail, $add_thumbnail);
          }
                      
          $imageuploadname[$k] = $k."_".$rand2."_".$arrayimage[$k];
        } else {
            $imageuploadname[$k]="NULL";
          }   
      }
      $self_image = './uploads/user_image';
      if(!empty($_FILES['self_image']['name'])){
        $fileThumbnail1 = $_FILES['self_image']['tmp_name'];
        $arrayimage1 = $_FILES['self_image']['name'];
        $add_thumbnail1=$self_image."/4_".$rand2."_".$arrayimage1;
        if (is_uploaded_file($fileThumbnail1)) {
          move_uploaded_file ($fileThumbnail1, $add_thumbnail1);
        }
        
      }
      $caste_certificate = $imageuploadname[1];
      $household_certificate = $imageuploadname[2];
      $selfImg = "4_".$rand2."_".$arrayimage1;

      $registrations_query = "INSERT INTO `registrations`(`reg_id`,`email`,`name`,`father_name`,`mobile`,`aadhar`,`state`,`districtid`,`community`,`occupation`,`income`,`caste_certificate`,`household_certificate`,`created_at`,`total_income`,`verified_status`,`self_image`) VALUES ('".$reg_id."','".$email."','".$name."','".$father_name."','".$mobile."','".$aadhar."','".$state."','".$district."','".$community."','".$occupation."','".$income."', '".$caste_certificate."','".$household_certificate."','".$currentDate."','".$income_total."',1,'".$selfImg."')";

      $res = mysqli_query($conn, $registrations_query);
      $user_id = mysqli_insert_id($conn);

      $account_holder = mysqli_real_escape_string($conn, $_POST['account_holder']);
      $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
      $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
      $ifsc = mysqli_real_escape_string($conn, $_POST['ifsc']);
      $rand3 = mt_rand(100000,999999);
      $uploads = './uploads/passbook';

      if($res) {
        for($k=1;$k<2;$k++) {          
          if(!empty($_FILES['passbook_'.$k]['name'])) {
            $fileThumbnail = $_FILES['passbook_'.$k]['tmp_name'];
            $arraypassbook[$k] = $_FILES['passbook_'.$k]['name'];
            $add_thumbnail=$uploads."/".$k."_".$rand3."_".$arraypassbook[$k];
            if (is_uploaded_file($fileThumbnail)) {
              move_uploaded_file ($fileThumbnail, $add_thumbnail);
            }       
            $passbookuploadname[$k] = $k."_".$rand3."_".$arraypassbook[$k];
          } else {
            $passbookuploadname[$k]="NULL";
          }
        }
        $passbookuploadname = $passbookuploadname[1];

        $bank_query = "INSERT INTO `bank_details`(`reg_id`,`user_id`,`account_holder`,`bank_name`,`account_number`,`ifsc`,`passbook`,`created_at`,`verified_status`) VALUES ('".$reg_id."','".$user_id."','".$account_holder."','".$bank_name."','".$account_number."','".$ifsc."', '".$passbookuploadname."','".$currentDate."',1)";
    
        $bank_result = mysqli_query($conn, $bank_query);

        $self_query = "INSERT INTO `family_details`(`reg_id`,`user_id`,`family_name`,`relationship`,`family_occupation`,`family_income`,`created_at`) VALUES ('".$reg_id."','".$user_id."','".$name."','1','".$occupation."','".$income."','".$currentDate."')";
    
        mysqli_query($conn, $self_query);
        $f_income = $income;
        foreach ($_POST['family_name'] as $key => $value) {
          $family_name = $value;
          $age = mysqli_real_escape_string($conn, $_POST['age'][$key]);
          $disability = mysqli_real_escape_string($conn, $_POST['disability'][$key]);
          $relationship = mysqli_real_escape_string($conn, $_POST['relationship'][$key]);
          $family_occupation = mysqli_real_escape_string($conn, $_POST['family_occupation'][$key]);
          $family_income = mysqli_real_escape_string($conn, $_POST['family_income'][$key]);
          $f_income+=$family_income;
          $family_query = "INSERT INTO `family_details`(`reg_id`,`user_id`,`age`,`disability`,`family_name`,`relationship`,`family_occupation`,`family_income`,`created_at`) VALUES ('".$reg_id."','".$user_id."','".$age."','".$disability."','".$family_name."','".$relationship."','".$family_occupation."','".$family_income."','".$currentDate."')";
      
          $family_result = mysqli_query($conn, $family_query);
        }

        $household_query = "INSERT INTO `household_income`(`reg_id`,`user_id`,`total_income`,`created_at`) VALUES ('".$reg_id."','".$user_id."','".$f_income."','".$currentDate."')";
        mysqli_query($conn, $household_query);
        $user_query = "INSERT INTO `users`(`reg_id`,`user_id`,`email`,`mobile`,`name`,`state_id`,`districtid`,`type`,`status`,`created_at`,`verified_status`) VALUES ('".$reg_id."','".$user_id."', '".$email."','".$mobile."','".$name."','".$state."','".$district."','User',1,'".$currentDate."',1)";
    
        $user_result = mysqli_query($conn, $user_query); 
        $query1 = "select SUM(family_income) as sum_value , reg_id from family_details where reg_id ='".$reg_id."' GROUP BY reg_id";
        $sum_res = mysqli_query($conn, $query1);
        while ($updateIncome = mysqli_fetch_assoc($sum_res)) {
          $income = $updateIncome['sum_value'];
          $query2 = "UPDATE `registrations` SET total_income='".$income."' WHERE reg_id='".$reg_id."'";
          mysqli_query($conn, $query2);
        }

        ?>
        <script>
          window.location.href='./register_welcome.php?id=<?php echo $reg_id; ?>';
        </script>";
      <?php } else { echo "<div class='alert alert-error'>Registration Error: " . $conn->error . "</div>"; die; ?>
        <script>alert('Unable to add record please try again!')</script>;
      <?php }
    }  
  }
  else{?>
        <script>alert("Captcha doesn't matches!")</script>;
  <?php
  }
}
  }

   ?>
   <div class="clearfix"></div>
   <section id="" class="contact section-bg p-0 mb-5">
      <div class="container" >
        <!-- Registration page -->
        <form method="POST" enctype="multipart/form-data" action="" class="was-validated">
        <div class="register_page mt-5" id="register_form">
          <h1 class="fw-bolder reg_text text-center">Registration</h1>
            <div class="regis_pg rounded p-4">
              <div>
                <h3 class="fw-bolder">Basic Details</h3>
                <hr class="count_hori w-100">
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 ">
                  <label for="" class="fs-6 fw-bolder">Email<span class="text-danger">*</span></label><br>
                  <input type="text" name="email" id="email" class="form-control-lg w-100 email input_field" maxlength="50" placeholder="Email" required onchange="validateemail(this);">
                  <span class="email_msg text-danger"></span>
                  <!-- <span class="m-1 text-danger"id="email_message"></span> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Name<span class="text-danger">*</span></label><br>
                  <input type="text" name="name" id="name" class="form-control-lg w-100 min-max-name input_field"placeholder="Name" required maxlength="51" onchange="validatestrings(this);">
                  <span class="min-max-name-message text-danger"></span>
                  <span class="text-danger name_msg"></span>
                  <!-- <span class="m-1 text-danger"id="name_message"></span> -->
                  <!-- <div class="valid-feedback">Valid.</div> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Password<span class="text-danger">*</span></label><br>
                  <input type="text" name="name" id="name" class="form-control-lg w-100 min-max-password input_field"placeholder="Password" required maxlength="51" onchange="validatepassword(this);">
                  <span class="min-max-password-message text-danger"></span>
                  <span class="text-danger password_msg"></span>
                  <!-- <span class="m-1 text-danger"id="name_message"></span> -->
                  <!-- <div class="valid-feedback">Valid.</div> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Confirm Password<span class="text-danger">*</span></label><br>
                  <input type="text" name="name" id="name" class="form-control-lg w-100 min-max-cn_password input_field"placeholder="Confirm Password" required maxlength="51" onchange="validatepassword(this);">
                  <span class="min-max-cn_password-message text-danger"></span>
                  <span class="text-danger cn_password_msg"></span>
                  <!-- <span class="m-1 text-danger"id="name_message"></span> -->
                  <!-- <div class="valid-feedback">Valid.</div> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="" class="fs-6 fw-bolder">Father Name<span class="text-danger">*</span></label><br>
                  <input type="text" name="father_name" id="father_name" class="form-control-lg w-100 min-max-fname input_field" placeholder="Father's Name" required maxlength="51" onchange="validatestrings(this);">
                  <span class="min-max-fname-message text-danger"></span>
                  <span class="text-danger fname_msg"></span>
                  <!-- <span class="m-1 text-danger"id="fname_message"></span> -->
                  <!-- <div class="valid-feedback">Valid.</div> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Mobile Number<span class="text-danger">*</span><span class="fs-6 text-success">(Enter 10 digit Mobile Number)</span></label><br>
                  <input type="text" name="mobile" id="mobile" class="form-control-lg w-100 m_number input_field" placeholder="Mobile Number" required maxlength="11" onchange="phonenumber(this);">
                  <div class="m_number_msg text-danger"></div>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="" class="fs-6 fw-bolder fw-bolder">Select State<span class="text-danger">*</span></label><br>
                  <select class="form-control-lg w-100 input_field" name="state" id="state" required="">
                    <option value="">Select State</option>
                    <?php  
                            $state_sql = "SELECT * FROM state WHERE status = 'Active'";
                            $state_result = mysqli_query($conn, $state_sql);
                            if(mysqli_num_rows($state_result) > 0) {
                              while ($state_row = mysqli_fetch_assoc($state_result)) { ?>
                                <option value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_title']; ?></option>
                              <?php }
                            }
                          ?>
                  </select>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">District<span class="text-danger">*</span></label><br>
                  <select class="form-control-lg w-100 input_field" name="district" id="district" required="">
                    <option value="">Select District</option>
                  </select>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4 "> 
                  <label for="" class="fs-6 fw-bolder">Select Community<span class="text-danger">*</span></label><br>
                  <select class="form-control-lg w-100 input_field " name="community" id="community" required="">
                    <option value="">Select Community</option>
                                                               
                  </select>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Aadhar<span class="text-danger">*</span><span class="material-symbols-outlined fs-5 cursur"  data-bs-toggle="tooltip" data-bs-placement="top" title="Aadhar number should be in this format example:- 3456 7890 1234">
                    info
                    </span></label><br>
                  <input type="text" name="aadhar" id="aadhar" class="form-control-lg w-100 aadhar input_field" placeholder="Aadhar Card Number" required="" maxlength="14" onchange="AadharValidation(this)" onkeyup="return event.charCode >= 65 && event.charCode <= 91">
                  <span class="aadhar_msg text-danger"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="" class="fs-6 fw-bolder">Occupation<span class="text-danger">*</span></label><br>
                  <input type="text" name="occupation" id="occupation" class="form-control-lg w-100 min-max-occupation input_field" placeholder="Occupation" required="" maxlength="51" onchange="validatestrings_occu(this);">
                  <span class="text-danger occupation_msg"></span>
                  <span class="min-max-occupation-message text-danger"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Annual Income<span class="text-danger">*</span></label><br>
                  <input type="text" name="income" id="income" class="form-control-lg w-100 min-max-AnnualIncome input_field" placeholder="Annual Income" required="" maxlength="7" onkeypress="return isNumber(event)">
                  <span class="text-danger annual_inc_msg"></span>
                  <span class="text-danger min-max-AnnualIncome-msg"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="" class="fs-6 fw-bolder">Upload Passport Size Photo<span class="text-danger">*</span></label><span class="fs-6 text-danger"><small>(Upload .jpg file only upto 200KB)</small></span><br>
                  <input type="file" name="self_image" id="self_image" class="form-control-lg w-100 border border-dark bg-white input_field" placeholder="" required="" accept="image/*">
                  <!-- <span class="m-1 text-danger"id="passport_message"></span> -->
                  <!-- <div class="valid-feedback">Valid.</div> -->
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                  <label for="" class="fs-6 fw-bolder">Upload cast Certificate<span class="text-danger">*</span></label><span class="fs-6 text-danger"><small>(Upload .pdf file only upto 5MB)</small></span><br>
                  <input type="file" name="image_1" id="image_1" class="form-control-lg w-100 border border-dark bg-white input_field" placeholder="" required="" accept="application/pdf">
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="" class="fs-6 fw-bolder">Upload Household Income Certificate<span class="text-danger">*</span></label><span class="fs-6 text-danger"><small>(Upload .pdf file only upto 5MB)</small></span><br>
                  <input type="file" name="image_2" id="image_2" class="form-control-lg w-100 border border-dark bg-white input_field" placeholder="" required="" accept="application/pdf">
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
              </div>
              <div>
                <h3 class="fw-bolder">Bank Details</h3>
                <hr class="count_hori w-100">
              </div>
              <div class="row">
                <div class="col-md-4 mb-4">
                  <label for="" class="fs-6 fw-bolder">IFSC code<span class="text-danger">*</span></label><span class="material-symbols-outlined fs-5 cursur"  data-bs-toggle="tooltip" data-bs-placement="top" title="IFSC Code should be in this format example:- ABCD0123456">
                    info
                    </span><br>
                  <input type="text" name="ifsc" id="ifsc" class="form-control-lg w-100 ifsc input_field" placeholder="IFSC Code" required="" onchange="validateifsc(this);">
                  <span class="ifsc_msg text-danger"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-4">
                  <label for="" class="fs-6 fw-bolder">Bank Name<span class="text-danger">*</span></label><br>
                  <select class="form-control-lg w-100 input_field " name="bank_name" id="bank_name" required="">
                  </select>                  
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-4">
                  <label for="" class="fs-6 fw-bolder">Bank Account<span class="text-danger">*</span></label><br>
                  <input type="text" name="account_number" id="account_number" class="form-control-lg w-100 min-max-BankAccount input_field" placeholder="Bank Account" required="" maxlength="18" onchange="validatenumber(this);">
                  <span class="text-danger min-max-BankAccount-msg"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-4 mb-4">
                  <label for="" class="fs-6 fw-bolder">Account Holder Name<span class="text-danger">*</span></label><br>
                  <input type="text" name="account_holder" id="account_holder" class="form-control-lg w-100 account_holder input_field" placeholder="Account Holder Name" required="" maxlength="51" onchange="validatestrings(this);">
                  <span class="text-danger account_holder_msg"></span>
                  <span class="text-danger min-max_account_holder_msg"></span>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-8">
                  <label for="" class="fs-6 fw-bolder">Passbook First Page/ Cancelled Cheque <span class="text-danger">*</span></label><span class="text-danger fs-6" > <small>(Upload .pdf file only upto 5MB)</small></span><br>
                  <input type="file" name="passbook_1" id="passbook_1" class="form-control-lg w-100 border border-dark bg-white input_field" placeholder="" required="" accept=" application/pdf">
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
              </div>
              <div>
                <h3 class="fw-bolder">Family Details</h3>
                <hr class="count_hori w-100">
              </div>
              <div class="row shadow rounded family_det p-2">
                <table data-toggle="table" data-cache="false" data-height="299" class="admnDshbrdTbl" width="100%" id="mytable">
                  <thead>
                    <tr>
                      <th>Name <span class="text-danger">*</span></th>
                      <th>Age <span class="text-danger">*</span></th>
                      <th>Disablility Status <span class="text-danger">*</span></th>
                      <th>Relationship <span class="text-danger">*</span></th>
                      <th>Occupation <span class="text-danger">*</span></th>
                      <th>Income <span class="text-danger">*</span></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control fami_det fami_name" id="family_name" name="family_name[]" placeholder="Name" required="required" maxlength="50" onchange="validatestrings(this);"></td>
                      
                      <td><input type="text" class="form-control fami_det" id="age" name="age[]" placeholder="Age" required="required"onkeypress="return isNumber(event)" maxlength="2"></td>
                      <td>
                        <select class="form-control fami_det" required="required" id="disability" name="disability[]">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        
                      </td>
                      <td>
                        <select class="form-control fami_det" required="required" name="relationship[]" id="relationship">
                          <option value="">Select Relationship</option>
                          <?php  
                                  $relation_sql = "SELECT * FROM relations WHERE status = 1 ";
                                  $relation_result = mysqli_query($conn, $relation_sql);
                                  if(mysqli_num_rows($relation_result) > 0) {
                                    while($relation_row = mysqli_fetch_assoc($relation_result)) { ?>
                                      <option value="<?php echo $relation_row['id']; ?>"><?php echo $relation_row['relation']; ?></option>
                                    <?php }
                                  }
                                ?>
                        </select>
                      </td>
                      <td><input type="text" class="form-control fami_det" id="family_occupation" name="family_occupation[]" placeholder="Occupation" required="required" maxlength="50" onchange="validatestrings(this);"></td>

                      <td><input type="number" class="form-control check-income" id="family_income" name="family_income[]" placeholder="Income" required="required" maxlength="7" onkeypress="return isNumber(event)">
                      <span class="inptEdt"></span></td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-md-9"></div>
                <div class="col-md-3 form-group">
                  <label>&nbsp; </label>
                      <a href="javascript:void(0)" class="btn add_button mt-2 fw-bold float-end" id="add" >Add More <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 form-group mt-4">
                      <div class="form-group">
                        <div class="g-recaptcha" data-callback="recaptchaCallback4" data-sitekey="6LcZ-_khAAAAAF9YCW-ktLG0mhAWvdOnToCsvnhd" required>
                        </div>
                        <span id="captcha_error" class="text-danger"></span>
                      </div>
                    </div>
              <div class="col-md-12 text-center">
                <button type="submit" id="register" name="btn_sbmit" class="btn btn-lg add_button mt-4 fw-bold" disabled>Register</button>
              </div>
            </div>
        </div>
        </form>
      <!-- registration end -->
      </div>
    </section>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <?php include ('./includes/footer.php'); ?>
      <script>
  function recaptchaCallback4() {
    $('#register').removeAttr('disabled');
  };
</script>

<script src="<?php echo $filepath; ?>js/validate.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#add").click(function() {
      $('#mytable tbody>tr:last').clone(true).insertAfter('#mytable tbody>tr:last');
      $('#mytable tbody>tr:last #family_name').val('');
      $('#mytable tbody>tr:last #age').val('');
      $('#mytable tbody>tr:last #disability').val('');
      $('#mytable tbody>tr:last #relationship').val('');
      $('#mytable tbody>tr:last #family_occupation').val('');
      $('#mytable tbody>tr:last #family_income').val('');
      return false;
    });
  });

  $('#state').on('change', function() {
        var state = this.value;
        $.ajax({
          url: "src/php/district.php",
          type: "POST",
          data: { state: state },
          cache: false,
          success: function(result){
            $("#district").html(result);
          }
        });
      });

  $('#state').on('change', function() {
    var state = this.value;
    $.ajax({
      url: "./src/php/community.php",
      type: "POST",
      data: { state: state },
      cache: false,
      success: function(result){
        $("#community").html(result);
      }
    });
  });
  $('#ifsc').on('change', function() {
    var ifsc = this.value;
    $.ajax({
      url: "./src/php/bank.php",
      type: "POST",
      data: { ifsc: ifsc },
      cache: false,
      success: function(result){
        $("#bank_name").html(result);
      }
    });
  });
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      // alert("Please enter only Numbers.");
      swal({
          title: "Error",
          text: "Only Numbers Are Allowed!",
          icon: "warning",
          button: "OK",
        });
      return false;
    }
    return true;
  }
  var iii = 0;
  $('.check-income').on('focusout', function() {
    var sum = 0;
    $('.check-income').each(function(){
      if(this.value != ""){

        sum += parseInt(this.value); 
      }
    });
    $("#income_total").val(sum);
  });



  $('#aadhar').on('keypress change', function() {
    $(this).val(function(index, value) {
      return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
    });
  });
</script>