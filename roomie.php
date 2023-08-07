<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
if (
    //detect if field has been filled
    isset($_POST['roomiename']) &&
    isset($_POST['major']) &&
    isset($_POST['colleges']) &&
    isset($_POST['body'])
) {
    //once filled then insert data
    $roomiename = $_POST['roomiename'];
    $major = $_POST['major'];
    $colleges = $_POST['colleges'];
    $body = $_POST['body'];



    $data = "roomiename=" . $roomiename . "&major=" . $major . "&colleges=" . $colleges . "&body=" . $body;

    if (empty($roomiename)) {
        $em = "Roomie name is required";
        exit;
    } else if (empty($major)) {
        $em = "Major is required";
        exit;
    } else if (empty($colleges)) {
        $em = "College name is required";
        exit;
    } else {
        if (isset($_FILES['file']['name'])) {

            //detects image file then insert into database if all requirements are met
            $img_name = $_FILES['file']['name'];
            $tmp_name = $_FILES['file']['tmp_name'];
            $error = $_FILES['file']['error'];

            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_to_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png');
                if (in_array($img_ex_to_lc, $allowed_exs)) {
                    $new_img_name = uniqid($roomiename, true) . '.' . $img_ex_to_lc;
                    $img_upload_path = 'dbimg/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $sql = "INSERT INTO roomie_profile (roomiename, major, colleges, body, profile_pic) 
                 VALUES(?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$roomiename, $major, $colleges, $body, $new_img_name]);
                    header('Location: view-roomie.php'); //ocne profile created redirect back to roomie webpage
                    exit;
                } else {
                    $em = "You can't upload files of this type";
                    header('Location: roomie.php');
                    exit;
                }
            } else {
                $em = "unknown error occurred!";
                header('Location: roomie.php');
                exit;
            }
        }
    }
}

?>


<div class="container">
    <form method="POST" action="roomie.php" enctype="multipart/form-data">
        <section class="mt-5">
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Rommie Name</label>
                <input name="roomiename" type="text" id="inputPassword5" class="form-control"
                    aria-labelledby="passwordHelpBlock" placeholder="First and Last name">
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Major</label>
                <input name="major" type="text" id="inputPassword5" class="form-control"
                    aria-labelledby="passwordHelpBlock" placeholder="Type your major here">
            </div>
            <div>
                <label for="inputPassword5" class="form-label">College Name</label>
                <select name="colleges" class="form-select" aria-label="Default select example">
                    <option selected>Choose your college</option>
                    <option value="Wentworth Institute of Technology">Wentworth Institute of Technology</option>
                    <option value="Massachusetts College of Pharmacy and Health Science">Massachusetts College of
                        Pharmacy and Health Science</option>
                    <option value="Simmons University">Simmons University</option>
                    <option value="Massachusetts College of Art and Design">Massachusetts College of Art and Design
                    </option>
                    <option value="Emmanuel college">Emmanuel college</option>
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="formFile" class="form-label"> Default file input example</label>
                <input name="file" class="form-control" type="file" id="formFile">
            </div>
            <div>
                <textarea rows="4" name="body" id="inputPassword5" class="form-control"
                    aria-labelledby="passwordHelpBlock" placeholder="Tell a little about yourslef..."></textarea>
                <label for="exampleFormControlInput1" class="form-label"></label>
            </div>
            <div class="text-center  d-grid gap-2 col-6 mx-auto">
                <button name="submit" type="submit" class="btn btn-secondary btn-lg">Upload</button>
            </div>
        </section>
    </form>
</div>

<?php require "includes/footer.php"; ?>