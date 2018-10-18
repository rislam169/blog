<div class="slidersection templete clear">
        <div id="slider">
	<?php 
		$query = "SELECT * FROM tbl_slider WHERE status='0' ORDER BY id LIMIT 5";
		$sliderimage = $db->select($query);
		if ($sliderimage) {
			while ($result = $sliderimage->fetch_assoc()) {
	?>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></a>
	<?php } } ?>
        </div>

</div>