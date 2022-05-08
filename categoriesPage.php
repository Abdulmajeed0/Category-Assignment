<?php
include 'DBS.php';
$con = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBNAME);

if (mysqli_connect_errno()) {
    die("Failed to connect" . mysqli_connect_error());
}
$query = "SELECT * FROM categoriestable WHERE parent_id=0";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>categories select box</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <select name="category" class="form-control category">
                    <option value="">Select</option>
                    <?php
                    foreach ($data as $d) {
                        echo '<option value="'.$d['category_id'].'">'.$d['category_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="dropdown_container"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.category', function() {
                var id = $(this).val();
                $.ajax({
                    url: 'getcategory.php',
                    type: 'post',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('#dropdown_container').append(data);
                    }
                })
            });
        });
    </script>
</body>

</html>