<?php
include('../../db/connection.php');
if(!empty($_POST["catid"])) {
    $id=intval($_POST['catid']);
    $query=mysqli_query($conn,"SELECT * FROM event_subcategory
                                        WHERE CategoryId=$id 
                                        and Is_Active=1
                                        "); ?>

    <option value="">เลือกหมวดหมู่ย่อย</option>

    <?php 
        while($row=mysqli_fetch_array($query)) { 
    ?>

    <option value="<?php echo htmlentities($row['SubCategoryId']); ?>">
        <?php echo htmlentities($row['Subcategory']); ?>
    </option>

<?php
    }
}
?>