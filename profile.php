<?php
    declare(strict_types = 1);

    require_once('template/essentials.tpl.php');
    require_once('user_session.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    <main>
        <section id="profile">
        <h1>Personal Information</h1>
            <section id="account">
                <div id="fields">
                    <form action="action_profile.php" method="get" class="profile_form">
                        <label>Name</label>
                        <input name="n" class="attr" type="text" placeholder="Name" value="<?php echo getName(); ?>" required="required">
                        <label>Username</label>
                        <input name="u" class="attr" type="text" placeholder="Username" value="<?php echo getUsername(); ?>" required="required">
                        <label>Email</label>
                        <input name="m" class="attr" type="text" placeholder="Email" value="<?php echo getEmail(); ?>" required="required">
                        <label>Phone</label>
                        <input name="ph" class="attr" type="text" placeholder="Phone Number" value="<?php echo getPhone(); ?>">
                        <label>Address</label>
                        <input name="a" class="attr" type="text" placeholder="Address" value="<?php echo getAddress(); ?>">
                        <label>Password</label>
                        <input name="p" class="attr" type="password" placeholder="Password" value="<?php echo getPassword(); ?>" required="required">
                        <input type="submit" name="Submit" value="Update">
                    </form>
                    <form>
                        <input formaction="action_logout.php" type="submit" value="Logout">
                    </form>
                    <hr>
                    <input onclick="openDialog('Delete Account')" type="submit" value="Delete Account">

                </div>
                <div id="photo_field">
                    <form action="" method="get" enctype="multipart/form-data">
                        <label>Photo</label>
                        <img id="photo" src="<?php echo 'https://www.altoastral.com.br/media/_versions/legacy/2016/09/bebe-comendo-papinha-inteligencia_widexl.jpg' ?>" alt="Profile Picture">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" name="Submit" value="Upload">
                    </form>
                </div>
            </section>
        </section>

    </main>

    <?php show_footer(); ?>

    </body>
</html>