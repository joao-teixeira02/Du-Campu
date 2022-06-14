<?php
 declare(strict_types = 1);

 function create_delete_popup() { ?>
    <article id="delete_popup" class="UseInputStyle full_window_popup">
        <p>
            Are you sure you want to delete your account? :(
        </p>
        <form id="delete_yes">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input type="submit" formaction="/action/action_logout.php" formmethod="post" value="Yes">
        </form>
        <input clickable onclick="location.href='profile.php'" value="No"/>
    </article>
<?php
}

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
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <label>Photo</label>
                <img id="photo" src="<?php echo htmlentities($user_photo); ?>" alt="Profile Picture">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" name="Submit" value="Upload">
            </form>
        </div>
            <section id="fields">
                <form action="/action/action_profile.php" method="post" class="profile_form">
                    <label>Name</label>
                    <input name="n" class="attr" type="text" placeholder="Name" value="<?php echo htmlentities($session->getName()); ?>" required="required">
                    <span class="hint">Only letters</span>
                    <label>Username</label>
                    <input name="u" class="attr" type="text" placeholder="Username" value="<?php echo htmlentities($session->getUsername()); ?>" required="required">
                    <span class="hint">Only lowercase letters and numbers</span>
                    <label>Email</label>
                    <input name="m" class="attr" type="text" placeholder="Email" value="<?php echo htmlentities($session->getEmail()); ?>" required="required">
                    <span class="hint">Not a valid email</span>
                    <label>Phone</label>
                    <input name="ph" class="attr" type="text" placeholder="Phone Number" value="<?php echo htmlentities($session->getPhone()); ?>">
                    <span class="hint">Must have 9 numbers</span>
                    <label>Address</label>
                    <input name="a" class="attr" type="text" placeholder="Address" value="<?php echo htmlentities($session->getAddress()); ?>">
                    <label>Optional</label>
                    <input name="p" class="attr" type="password" placeholder="New Password" value="">
                    <input name="p2" class="attr" type="password" placeholder="Repeat New Password" value="">
                    <span class="hint">Passwords must match</span>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="submit" name="Submit" value="Update">
                </form>
                <form>
                    <input formaction="/action/action_logout.php" formmethod="POST" type="submit" value="Logout">
                </form>
                <input type="button" clickable onclick="create_delete_popup()" value="Delete Account">
            </section>
        </section>
    </section>
<?php

}