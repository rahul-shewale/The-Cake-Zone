<?php 

include('config/db_connect.php');

$title = $email = $ingerdients = '';
$errors = array('email'=>'','title'=>'','ingredients'=>'');

if(isset($_POST['submit'])){

    // check emai
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email must be valid address';
        }
    }

    // check title
    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required';
    } else {
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only';
        };
    }
    
    // check Ingerdients
    if(empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingerdient is required';
    } else {
        $ingerdients = $_POST['ingredients'];
        // if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z*])+$/', $ingerdients)){
        //     $errors['ingredients'] = 'Ingerdients must be a comma seprated list';
        // };
    }

    if(array_filter($errors)){

    }
    else{
        //mysqli_real_escape_strings() prevents from sql injection
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingerdients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //make sql
        $sql = "INSERT INTO cakes(title,email,ingredients) VALUES('$title','$email','$ingerdients')";

        if(mysqli_query($conn, $sql)){
            header('location: index.php');
        } else {
            //error
            echo 'query error '.mysqli_error($conn); 
        }

    }
}   //end of POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add a Cake</h4>
    <form class="white" action="add.php" method="POST">
        <label>Your Email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Cake Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients (comma separated)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingerdients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>
