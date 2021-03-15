<?php $this->load->view('frontend/module/slider'); ?>
<!-- <?php $this->load->view('frontend/module/tpt_ck'); ?> -->
<div class="content-post box-sm-xs-margin-top" style="margin-top: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-right">
				<div class="dpr">
					<h1 class="h1p"><?php echo $detailCategory['name'] ?></h1>
					<?php if (count($listCategoriesChild) > 0) : ?>
						<div class="wrap-category-child" style="padding: 0 10px;">
							<div class="list-caregories-child">
								<?php foreach ($listCategoriesChild as $rowCategoryChild) :?>
									<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 text-center row-category-child">
										<div class="name-category-child">
											<a href="<?php echo base_url() ?>danh-muc/<?php echo $rowCategoryChild['alias'] ?>" title="<?php echo $rowCategoryChild['name'] ?>" alt="<?php echo $rowCategoryChild['name'] ?>">
												<?php echo $rowCategoryChild['name'] ?>
											</a>
										</div>
									</div>
								<?php endforeach; ?>
							</div> 
						</div> 
					<?php endif; ?>
					<div class="list-content-ref unf" style="width: 100%; min-height: 1px; overflow: hidden; height: auto; padding-top: 20px;">
						<?php foreach ($listContentsByArrayId as $rowPostRef) :?>
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
					<!-- <ul class="col-xs-12 blog-list-articles lists-articles pd5" id="list-articles">
						<?php foreach ($listContentsByArrayId as $row):?>
							<li class="clearfix mb15">
								<div class="blog-item-image">
									<a href="<?php echo base_url() ?>bai-viet/<?php echo $row['alias'] ?>" title="<?php echo $row['title_image'] ?>" alt="<?php echo $row['alt_image'] ?>">
										<img src="<?php echo base_url() ?>upload/contents/<?php echo $row['images'] ?>" title="<?php echo $row['title_image'] ?>" alt="<?php echo $row['alt_image'] ?>" >
									</a>
								</div>
								<div class="blog-item-title">
									<a href="<?php echo base_url() ?>bai-viet/<?php echo $row['alias'] ?>" title="<?php echo $row['title'] ?>" alt="<?php echo $row['title'] ?>">
										<h3><?php echo $row['title'] ?></h3>
									</a>
									<figure><?php echo $row['short_description'] ?></figure>
								</div>
							</li>
						<?php endforeach; ?>
					</ul> -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="pagination">
								<?php echo $strphantrang ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>