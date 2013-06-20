<?php
include 'header.php';


    ?>
    <div class="row">
        <h2 class="span12"> Add Speaker</h2> 
    </div>

    <div class="row">
        <form method="post" action="">
            <div class="span8 offset3" >
                <input type="text" name="firstname" placeholder=" First name" size="20" maxlength="25" /> <br />
                <input type="text" name="lastname" placeholder="Last name" size="20" maxlength="25" /><br />
                <input type="text" name="year" placeholder="<?php echo "YYYY"; ?>" size="4" maxlength="4" />  /    <input type="text" name="month" placeholder="<?php echo "MM"; ?>" size="1" maxlength="2" />   /    <input type="text" name="day" placeholder="<?php echo "DD"; ?>" size="2" maxlength="2" /> 
                <input type="file" name="img" size="9"> <br />
                <input type="text" name="email" placeholder="E-mail" size="20" maxlength="25" /> 
                <input type="text" name="phone_number" placeholder="Phone Number" size="20" maxlength="12" /><br />

                <textarea name="description" rows="20" cols="45" placeholder="Descripttion"></textarea><br />

                <input type="text" name="address" placeholder="address" size="20" maxlength="25" /> <input type="text" name="zipcode" placeholder="zipcode" size="6" maxlength="5" />  <br />
                <input type="text" name="city" placeholder="city" size="20" maxlength="25" /> <input type="text" name="country" placeholder="country" size="20" maxlength="25" /> <br />
                <div class="offset7">
                    <input type="submit" value="Add">
                </div>

            </div>

        </form>
    </div>



    <?php
    
    global $tedx_manager;
    if ($_POST['add']) {
        "yeah";
        $args = array(
        'name' => $_POST['lastname'], // String
        'firstName' => $_POST['name'], // String
        'dateOfBirth' => $_POST['year']+"-"+ $_POST['month']+"-"+$_POST['day'], // Date
        'address' => $_POST['address'], // String
        'city' => $_POST['city'], // String
        'country' => $_POST['country'], // String
        'phoneNumber' => $_POST['phone_number'],
        'email' => $_POST['email'], //email
        'IDMember' => 21, //intenger
        'password' => md5(monPass)); // String encrypt to MD5

        // Register to an Event
        $aRegisteredSpeaker = ASOrganizer::registerSpeaker($args);

        // Message
        if ($aRegisteredSpeaker->getStatus() == 1)
            echo 'Congrats! ' . $aRegisteredSpeaker->getMessage();
        else
            echo 'Error! ' . $aRegisteredSpeaker->getMessage();
    }

    include 'footer.php';
    ?>
 