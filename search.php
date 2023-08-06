<?php
require "config.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    $select = $conn->query("SELECT * FROM roomie_profile WHERE roomiename LIKE '{$search}%'");

    $select->execute();

    $rows = $select->fetchAll(PDO::FETCH_OBJ);


}
?>


<?php foreach ($rows as $row): ?>
    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="course-item bg-light">
            <div class="position-relative overflow-hidden">
                <img class="img-fluid" src="./dbimg/<?php echo $row->profile_pic; ?>" alt="">
            </div>
            <div>
                <h3 class="mb-0 text-center">
                    <?php echo $row->roomiename; ?>
                </h3>
                <div class="d-flex border-top">
                    <small class="flex-fill text-center border-end py-2"><i></i>
                        <?php echo $row->colleges; ?>
                    </small>
                    <small class="flex-fill text-center border-end py-2"><i></i>
                        <?php echo $row->major; ?>
                    </small>
                </div>
                <div class="mt-3">
                    <p>
                        <?php echo substr($row->body, 0, 100) . '...'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <br>
<?php endforeach; ?>