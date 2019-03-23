<?php
    session_start();

    include('header.php');
?>

<div class="container">

    <h1>Welcome <?php echo $_SESSION['displayName'] ?></h1>
    <p>
        <strong>displayName: </strong>
        <?php echo $_SESSION['displayName'] ?>
    </p>
    <p>
        <strong>mail: </strong>
        <?php echo $_SESSION['mail'] ?>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </p>
</div>

<?php
    include('footer.php');
?>