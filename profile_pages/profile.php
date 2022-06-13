<?php


function show_profile() {

    
    global $session;
    $db = getDatabaseConnection();
    $user_photo =  User::getUser($db, $session->getUsername())->getPhoto($db);

    ?>

    <section id="profile" class="UseInputStyle" >
    <h1>Personal Information</h1>
        <section id="account">
        <div id="photo_field">
                <form action="/action/action_profile.php" method="post" enctype="multipart/form-data">
                    <label>Photo</label>
                    <img id="photo" src="<?php echo $user_photo; ?>" alt="Profile Picture">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" name="Submit" value="Upload">
                </form>
            </div>
            <section id="fields">
                <form action="/action/action_profile.php" method="post" class="profile_form">
                    <label>Name</label>
                    <input name="n" class="attr" type="text" placeholder="Name" value="<?php echo $session->getName(); ?>" required="required">
                    <label>Username</label>
                    <input name="u" class="attr" type="text" placeholder="Username" value="<?php echo $session->getUsername(); ?>" required="required">
                    <label>Email</label>
                    <input name="m" class="attr" type="text" placeholder="Email" value="<?php echo $session->getEmail(); ?>" required="required">
                    <label>Phone</label>
                    <input name="ph" class="attr" type="text" placeholder="Phone Number" value="<?php echo $session->getPhone(); ?>">
                    <label>Address</label>
                    <input name="a" class="attr" type="text" placeholder="Address" value="<?php echo $session->getAddress(); ?>">
                    <label>Password</label>
                    <input name="p" class="attr" type="password" placeholder="Password" value="<?php echo $session->getPassword(); ?>" required="required">
                    <input type="submit" name="Submit" value="Update">
                </form>
                <form>
                    <input formaction="/action/action_logout.php" type="submit" value="Logout">
                </form>
                <form>
                    <input formaction="/action/action_delete_account.php" type="submit" value="Delete Account">
                </form>
            </section>
            
        </section>
    </section>
<?php

}