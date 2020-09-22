<?php 

//1
include('config/db_connect.php');

//check post request fir delete ip address
if(isset($_POST['del'])){

    //get id in the value feild of the hidden input
    $hid = mysqli_real_escape_string($conn, $_POST['hid']);

    //make query
    $sql = "DELETE FROM cakes WHERE id = $hid";

    //if query execute
    if(mysqli_query($conn, $sql)){
        //success
        header('location: index.php');
    } else {
        echo "query error ".mysqli_error($conn)."<br>";
    }

    mysqli_close($conn);
}

//check GET request id parses
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //2. get the query results
    $sql = "SELECT * FROM cakes where id = $id";

    //3. get the query result
    $result = mysqli_query($conn, $sql);

    //4. fetch result in array format 
    $cake = mysqli_fetch_assoc($result);

    //5. free the result
    mysqli_free_result($result);

    //6. close the connection
    mysqli_close($conn);
}


?>


<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center grey-text">
    <?php if($cake): ?>
        <h4><?php echo htmlspecialchars($cake['title']); ?></h4>
        <p>created by: <?php echo htmlspecialchars($cake['email']); ?></p>
        <p><?php echo date($cake['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($cake['ingredients']) ?></p>

        <!-- DELETE Form -->
        <form action="details.php" method="post">
        <input type="hidden" name="hid" value = "<?php echo $cake['id'] ?>">
        <input type="submit" name="del" value="Delete" class="btn brand z-depth-0">
        </form>
    <?php else:?>
        <h5>No such cake exists!</h5>
    <?php endif; ?>
</div>

<?php include('templates/footer.php'); ?>

</html>