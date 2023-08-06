<?php require "includes/header.php"; ?>
<?php
require "config.php";
?>

<?php
$profile = $conn->query("SELECT * FROM roomie_profile order by created_dt DESC");
$profile->execute();
$rows = $profile->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Roomies</h1>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Courses Start -->


<div class="container-xxl py-5">
    <div>
        <input class="form-control mr-sm-2" list="datalistOptions" id="search_data" type="search
    " placeholder="Search..">
    </div>
    <div id="search-data"></div>
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Roomie Profiles</h6>
            <h1 class="mb-5">Find your Roomies</h1>
        </div>
        <div class="row g-4 justify-content-center">

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
            <?php endforeach; ?>
        </div>
    </div>

</div>
<!-- Courses End -->


<?php require "includes/footer.php"; ?>
<script>
    $(document).ready(function () {
        //live search

        $("#search_data").keyup(function () {

            var search = $(this).val();
            //alert(search);

            if (search == '') {

                $("#search-data").css('display', 'none');

            } else {
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: {
                        search: search
                    },

                    success: function (data) {
                        $("#search-data").html(data);
                        $(".row").css("display", "block");
                    }
                })


            }
        })
    });
</script>