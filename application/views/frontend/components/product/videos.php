<?php $this->load->view('frontend/module/slider'); ?>
<!-- <?php $this->load->view('frontend/module/tpt_ck'); ?> -->
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="dpr" style="margin-top: 30px;">
				<div class="title-post" style="background: #fff;">
					<h1 class="h1p">Công trình đã thực hiện</h1>
				</div>
				<div class="dit product-videos" style="padding: 0;">
				    <?php if(count($listProduct) > 0) : ?>
					    <ul class="pul a videos">
							<?php for($t = 0; $t < count($listProduct); $t++) : ?>
								<li class="c i10">
							        <a href="<?php echo base_url() ?>video/<?php echo $listProduct[$t]['alias'] ?>" alt="<?php echo $listProduct[$t]['title'] ?>" title="<?php echo $listProduct[$t]['title'] ?>">
							        	<em>Xem video</em>
							        	<span class="f"></span>
										<span class="z"></span>
						                <img width="100%" src="<?php echo base_url() ?>upload/contents/<?php echo $listProduct[$t]['images'] ?>" class="attachment-custom600x400 size-custom600x400 wp-post-image" alt="<?php echo $listProduct[$t]['alt_image'] ?>" title="<?php echo $listProduct[$t]['title_image'] ?>"> 
						            </a>
							        <strong>
							        	<a href="<?php echo base_url() ?>video/<?php echo $listProduct[$t]['alias'] ?>" alt="<?php echo $listProduct[$t]['title'] ?>" title="<?php echo $listProduct[$t]['title'] ?>">
							        		<?php echo $listProduct[$t]['title'] ?>
						        		</a>
						        	</strong>
							    </li>
							<?php endfor; ?>
						    <li class="cl"></li>
						</ul>
						<?php if ( $totalItem > LIMIT_PRODUCT_SHOW_CATEGORY) :?>
							<div class="col-md-12 text-center">
								<ul class="pagination">
									<?php echo $strphantrang ?>
								</ul>
							</div>
						<?php endif; ?>
					<?php else:  ?>
						<div class="no-product text-center">
							<p>Danh mục hiện chưa có sản phẩm</p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>