<!-- SLIDER -->
<div id="carousel-id" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php for ($i = 0; $i < count($listSliders); $i++) : ?>
			<li data-target="#carousel-id" data-slide-to=<?php echo $i; ?> class="<?php if($i == 0) echo 'active'; ?>"></li>
		<?php endfor; ?>
	</ol>
	<div class="carousel-inner">
		<?php for ($i = 0; $i < count($listSliders); $i++) : ?>
			<div class="item <?php if($i == 0) echo 'active'; ?>">
				<a href="<?php echo $listSliders[$i]['link_ads'] ?>" target="_blank" alt="<?php echo json_decode($listSliders[$i]['alt_image'])[0] ?>" title="<?php echo json_decode($listSliders[$i]['title_image'])[0] ?>">
					<img alt="<?php echo json_decode($listSliders[$i]['alt_image'])[0] ?>" title="<?php echo json_decode($listSliders[$i]['title_image'])[0] ?>" src="<?php echo base_url() ?>upload/sliders/<?php echo json_decode($listSliders[$i]['images'])[0] ?>">
				</a>
			</div>
		<?php endfor; ?>
	</div>
</div>
<!-- END SLIDER -->