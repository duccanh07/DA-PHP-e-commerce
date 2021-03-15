<?php $this->load->view('frontend/module/slider'); ?>
<!-- <?php $this->load->view('frontend/module/tpt_ck'); ?> -->
<div class="content-post box-sm-xs-margin-top" style="margin-top: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-right">
				<div class="dpr" style="margin-bottom: 30px;">
					<h1 class="h1p"><?php echo $detail_content['title'] ?></h1>
					<div class="detail-content">
						<?php echo $detail_content['description'] ?>
					</div>
				</div>
			</div>
			<?php if(count($listPostsRef) > 0) : ?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="products-video-ref products-ref">
						<div class="header-products-video umt box-xs-no-margin" style="width: 100%; min-height: 1px; overflow: hidden; height: auto;">
							<h3 class="l">Bài viết liên quan</h3>
							<div class="row">
								<div class="list-content-ref unf" style="width: 100%; min-height: 1px; overflow: hidden; height: auto; padding-top: 20px;">
									<?php foreach ($listPostsRef as $rowPostRef) :?>
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 item-ref">
											<div class="a-ref">
								    			<a 
								    				href="<?php echo base_url() ?>bai-viet/<?php echo $rowPostRef['alias'] ?>" 
								    				alt="<?php echo $rowPostRef['alt_image'] ?>" title="<?php echo $rowPostRef['title_image'] ?>"

								    			>
								    				<img width="150" height="100" src="<?php echo base_url() ?>upload/contents/<?php echo $rowPostRef['images'] ?>" class="attachment-custom150x100 size-custom150x100 wp-post-image" alt="<?php echo $rowPostRef['alt_image'] ?>" title="<?php echo $rowPostRef['title_image'] ?>">    			
								    			</a> 
								                <strong>
								                    <a href="<?php echo base_url() ?>bai-viet/<?php echo $rowPostRef['alias'] ?>" title="<?php echo $rowPostRef['title'] ?>" 
								    				alt="<?php echo $rowPostRef['title'] ?>" ><?php echo $rowPostRef['title'] ?></a>
								                </strong>
								    			<figure><?php echo $rowPostRef['short_description'] ?></figure>
								    		</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>