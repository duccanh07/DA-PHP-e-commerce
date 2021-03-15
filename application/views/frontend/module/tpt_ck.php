<div style="background: #fff; margin: 10px 0;">
	<div class="avt hidden-xs hidden-sm">
		<div class="container">
			<div class="row tpt_ck">
				<?php for($i = 0; $i < count($listPoliciesOrther); $i++) : ?>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 l<?php echo $i;?>">
						<a href="#" rel="nofollow" title="<?php echo $listPoliciesOrther[$i]['title_image'] ?>" alt="<?php echo $listPoliciesOrther[$i]['alt_image'] ?>">
			    			<img id="m<?php echo $i;?>" src="<?php echo base_url() ?>assets/upload/<?php echo $listPoliciesOrther[$i]['images'] ?>" title="<?php echo $listPoliciesOrther[$i]['title_image'] ?>" alt="<?php echo $listPoliciesOrther[$i]['alt_image'] ?>"><b><?php echo $listPoliciesOrther[$i]['name'] ?></b><?php echo $listPoliciesOrther[$i]['description'] ?>
			            </a>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>