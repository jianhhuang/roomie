<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $singlePost = $conn->query("SELECT * FROM user_post WHERE id = '$id'"); //show specific post based on inex 
    $singlePost->execute();

    $posts = $singlePost->fetch(PDO::FETCH_OBJ);
}

$comments = $conn->query("SELECT * FROM comments WHERE post_id = '$id' order by id DESC"); //order by most recent comment
$comments->execute();

$comment = $comments->fetchAll(PDO::FETCH_OBJ);
?>

<div class="form-signin w-50 m-auto mt-5">
    <div class="card">
        <h4 class="card-header">
            <?php echo $posts->username; ?>
            <h5><span class="position-absolute top-0 end-0 text-center">
                    <?php echo $posts->created_dt; ?>
                </span></h5>
        </h4>
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $posts->title; ?>
                <h5>
                    <p class="card-text">
                        <?php echo $posts->body; ?>
                    <p>
        </div>
    </div>
</div>

<!--Create texbox for comments-->
<div class="form-signin w-50 m-auto mt-5 ">
    <form method="POST" id="comment_data">
        <div>
            <input name="username" type="hidden" value=<?php echo $_SESSION['username']; ?> placeholder="username">
        </div>
        <div>
            <input name="post_id" type="hidden" value=<?php echo $posts->id; ?> id="post_id">
        </div>
        <div>
            <textarea rows="9" name="comment" class="form-control" aria-labelledby="passwordHelpBlock"
                placeholder="Comment" id="comment"></textarea>
            <label for="floatingInput"></label>
        </div>
        <div class="text-center  mt-2 pt-2">
            <button name="submit" type="submit" class="btn btn-primary">Create Comment</button>
        </div>
        <div id="msg" class="nothing"></div>
        <div id="delete-msg" class="nothing"></div>

    </form>
</div>

<!--Return comments from database-->
<div class="form-signin w-50 m-auto mt-5">
    <?php foreach ($comment as $singleComment): ?>
        <div class="card">
            <h5 class=" card-header">
                <?php echo $singleComment->username; ?>
                <span class="position-absolute top-0 end-0 text-center">
                    <?php echo $singleComment->created_at; ?>
                </span>
            </h5>
            <div class=" card-body">
                <p class="card-text">
                    <?php echo $singleComment->comment; ?>
                </p>
            </div>
            <div class="position-absolute bottom-0 end-0">
                <?php if ($_SESSION['username'] == $singleComment->username): ?>
                    <button id="delete-btn" class="btn btn-danger btn-sm"
                        value="<?php echo $singleComment->id; ?>">Delete</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require "includes/footer.php"; ?>

<script>
    //using Ajax to process web request without refreshing the webpage
    $(document).ready(function () {

        $(document).on('submit', function (e) {
            e.preventDefault();
            var formdata = $("#comment_data").serialize() + '&submit=submit';

            $.ajax({
                type: 'post',
                url: 'insert-comments.php',
                data: formdata,

                success: function () {
                    //alert('wokring');
                    $("#username").val(null);
                    $("#comment").val(null);
                    $("#post_id").val(null);

                    $("#msg").html("Added Successfully").toggleClass("alert alert-success bg-success text-white mt-3");
                    fetch();
                }
            });
        });

        $("#delete-btn").on('click', function (e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                type: 'post',
                url: 'delete-comments.php',
                data: {
                    delete: 'delete',
                    id: id
                },

                success: function () {
                    //alert(id);
                    $("#delete-msg").html("Deleted Successfully").toggleClass("alert alert-success bg-success text-white mt-3");
                    fetch();
                }
            });
        });
        //return comment from database
        function fetch() {
            setInterval(function () {
                $("body").load("show_post.php?id=<?php echo $_GET['id']; ?>")
            }, 4000);
        }
    });
</script>