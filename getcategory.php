<?php
include 'DBS.php';
$con = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBNAME);

if (mysqli_connect_errno()) {
    die("Failed to connect" . mysqli_connect_error());
}

if(isset($_POST['id'])){
$id= $_POST['id'];
$query = 'SELECT * FROM categoriestable WHERE parent_id = '.$id;
$result = mysqli_query($con,$query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
if(!empty($data)){
echo '<div class="row">
<div class="col-md-4">
<select name="category" class="form-control category">
<option value="">Select</option>';
foreach($data as $d){
echo '<option value="'.$d['category_id'].'">'.$d['category_name'].'</option>';
}
echo '</select>
</div>
</div>';
}
}

mysqli_close($con);
?>