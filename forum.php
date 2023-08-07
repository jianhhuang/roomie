<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>
<?php
$select = $conn->query("SELECT * FROM user_post order by id DESC");
$select->execute();
$rows = $select->fetchAll(PDO::FETCH_OBJ);

?>

<div class="form-signin w-50 m-auto ">
    <div class="container pt-5">
        <?php foreach ($rows as $row): ?>
            <div class=" card">
                <div class="card-header">
                    <?php echo $row->username; ?>
                    <span class="position-absolute top-0 end-0 text-center">
                        <?php echo $row->created_dt; ?>
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row->title; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo substr($row->body, 0, 100) . '...'; ?>
                    </p>
                    <a href="show_post.php?id=<?php echo $row->id; ?>" class="btn btn-primary">View Post</a>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
</div>
<?php require "includes/footer.php"; ?>