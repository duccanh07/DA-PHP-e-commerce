<div class="" style="background: #fff; border-top: 5px solid #f4f8fa;">
	<div class="avt hidden-xs hidden-sm">
		<div class="container">
			<div class="row">
				<?php foreach ($listPolicies as $rowPolici) :?>
					<div class="col-md-3 col-lg-3 l0">
						<a href="javascript:void(0)" rel="nofollow" title="<?php echo json_decode($rowPolici['title_image'])[0] ?>" alt="<?php echo json_decode($rowPolici['alt_image'])[0] ?>">
			    			<img id="m0" src="<?php echo base_url() ?>upload/policies/<?php echo json_decode($rowPolici['images'])[0] ?>" title="<?php echo json_decode($rowPolici['title_image'])[0] ?>" alt="<?php echo json_decode($rowPolici['alt_image'])[0] ?>"><b><?php echo $rowPolici['name'] ?></b><?php echo $rowPolici['description'] ?>
			            </a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>