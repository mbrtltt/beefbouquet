<?php
include_once('db_config.php');

if(isset($_POST['add'])){
    $newName = $_POST['name'];
    $newName = mysqli_real_escape_string($conn, $newName);
    $newDate = $_POST['date'];
    $newCategory = $_POST['category'];

    $newSql = "INSERT INTO beefbouquet (category, date, name) VALUES ('$newCategory','$newDate','$newName')";
    if($conn->query($newSql) === TRUE) {
        // add success message
    } else {
        echo "Error message: " . $mysqli->error;
    }
}
if(isset($_POST['remove'])){
    $removeId = $_POST['removeId'];
    $removeSql = "UPDATE beefbouquet SET active = 0 WHERE id = '$removeId'";
    if($conn->query($removeSql) === TRUE){
        // add success message
    } else {
        echo "Error";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Beef & Bouquet</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <div class="container">
            <div class="beef-container">
                <h2>🥩</h2>
                <ul>

                    <?php
                        // Get the beefs
                        $readbeefsql = 'SELECT * FROM beefbouquet WHERE category = "beef" AND active = 1 ORDER BY id';
                        $readbeefresult = $conn->query($readbeefsql);
                        $beefs = array();
                        while($aBeef = mysqli_fetch_assoc($readbeefresult)){
                            $beefs[] = $aBeef;
                        }
                        // Read the beefs
                        foreach($beefs as $beef){
                    ?>
                    <li><?php echo $beef['name']; ?> <span><?php echo $beef['date']; ?></span><form method="post">
                        <input type="hidden" name="removeId" value="<?php echo $beef['id'];?>">
                        <button type="submit" class="remove" name="remove">-</button></form></li>
                    <?php
                        }
                    ?>
                    <li class="input">
                        <form method="post">
                            <input type="hidden" name="add" value="">
                            <input type="hidden" name="category" value="beef">
                            <input type="hidden" name="date" value="<?php echo date('j F Y');?>">
                            <input type="hidden" name="active" value="1">
                            <input type="text" name="name" value="" placeholder="Add new beef" maxlength="140">
                        </form>
                    </li>

                </ul>
            </div>
            <div class="bouquet-container">
                <h2>💐</h2>
                <ul>
                    <?php
                        // Get the bouquets
                        $readbouquetsql = 'SELECT * FROM beefbouquet WHERE category = "bouquet" AND active = 1 ORDER BY id';
                        $readbouquetresult = $conn->query($readbouquetsql);
                        $bouquets = array();
                        while($aBouquet = mysqli_fetch_assoc($readbouquetresult)){
                            $bouquets[] = $aBouquet;
                        }
                        // Read the beefs
                        foreach($bouquets as $bouquet){
                    ?>
                    <li><?php echo $bouquet['name']; ?> <span><?php echo $bouquet['date']; ?></span><form method="post">
                        <input type="hidden" name="removeId" value="<?php echo $bouquet['id'];?>">
                        <button type="submit" class="remove" name="remove">-</button></form></li>
                    <?php
                        }
                    ?>
                    <li class="input">
                        <form method="post">
                            <input type="hidden" name="add" value="">
                            <input type="hidden" name="category" value="bouquet">
                            <input type="hidden" name="date" value="<?php echo date('j F Y');?>">
                            <input type="hidden" name="active" value="1">
                            <input type="text" name="name" value="" placeholder="Add new bouquet" maxlength="140">
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </body>
</html>
