<?php include 'header.php'; ?>
<div class="row">
    <p>Hello Jackie Chan </p>
</div>
<div class="row">
       <div class="span6 offset5">  
           
<h2>Register</h2>
<br />
<form action="register.php" method="post"> 

  <input type="text" name="firstname" value="firstname" size="20" maxlength="25" />  <br /> 
 <input type="text" name="lastname" value="lastname" size="20" maxlength="25" />  <br /> 
<input type="text" name="dob_year" value="<?php echo "YYYY"; ?>" size="3" maxlength="4" />  /    <input type="text" name="dob_monat" value="<?php echo "MM"; ?>" size="1" maxlength="2" />   /    <input type="text" name="dob_day" value="<?php echo "DD"; ?>" size="1" maxlength="2" /> Date of birth   <br /> 
 <input type="text" name="email" value="email" size="20" maxlength="25" />  <input type="text" name="telephone" value="telephone" size="20" maxlength="25" /> <br /> <br /> 
<input type="password" name="password" value="password" size="20" maxlength="25" />  <br /> 
   <input type="password" name="password_repeat" value="password" size="20" maxlength="25" />  <br /> <br /> 
     
  <input type="text" name="address" value="address" size="20" maxlength="25" /> <input type="text" name="zipcode" value="zipcode" size="5" maxlength="5" />  <br />
  <input type="text" name="city" value="city" size="20" maxlength="25" /><br />
  <input type="text" name="country" value="country" size="20" maxlength="25" /> <br />
        <br /> 
<input type="Submit" name="submit" value="Register" /> 
</form>
       </div>
</div>
<?php include 'footer.php'; ?>