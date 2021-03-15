
<!-- MENU -->
<div class="main-menu mh hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<ul id="menu-primary-menu" class="m">
				<?php for ($i = 0; $i < count($listCategories); $i++) :  ?>
					<li class="main-menu-item  c n menu-item-depth-0 menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children">
						<?php 
							if ($listCategories[$i]['type'] == TYPE_CATEGORY_CONTENT || $listCategories[$i]['type'] == TYPE_CATEGORY_DU_AN) {
								$alias = base_url().'danh-muc-bai-viet/'.$listCategories[$i]['alias'];
							} elseif ($listCategories[$i]['type'] == TYPE_CATEGORY_HOME) {
								$alias = base_url();
							} elseif ($listCategories[$i]['type'] == TYPE_CATEGORY_PRODUCT) {
								$alias = base_url().'danh-muc/'.$listCategories[$i]['alias'];
							} else {
								$alias = base_url().$listCategories[$i]['alias'];
							}
						?>
						<a href="<?php echo $alias ?>" class="menu-link main-menu-link" title="<?php echo $listCategories[$i]['name']; ?>" alt="<?php echo $listCategories[$i]['name']; ?>">
							<?php if($listCategories[$i]['count_childs'] > 0 && $listCategories[$i]['parent_id'] != DEFAULT_PARENT_ID) : ?>
								<span class="fa fa-angle-right"></span>
							<?php
								endif;
								if($listCategories[$i]['fa_icons'] != '') : ?>
									<span class="<?php echo $listCategories[$i]['fa_icons'] ?>"></span>
								<?php endif;
								echo $listCategories[$i]['name']; 
								if($listCategories[$i]['count_childs'] > 0 && $listCategories[$i]['parent_id'] == DEFAULT_PARENT_ID) : ?>
									<span class="fa fa-angle-down"></span> 
								<?php endif; ?>
						</a>
						<?php echo recursivelyCategories($html, $listCategories[$i]);?>
					</li>
				<?php 
					endfor; 
					function recursivelyCategories(&$html, $category) {
						if ($category['parent_id'] == DEFAULT_PARENT_ID) {
							//if ($category['type'] == TYPE_CATEGORY_CONTENT || $category['type'] == TYPE_CATEGORY_PRODUCT) {
								$html = '';
							//}
						}
						if ($category['count_childs'] > 0) {
							$html .= "<ul class='sub v ".$category['id']."'>";
								for($i = 0; $i < $category['count_childs']; $i++) {
									if ($category['id'] == $category['childs'][$i]['parent_id']) {
										if ($category['childs'][$i]['type'] == TYPE_CATEGORY_CONTENT)
										{
											$prefix = 'danh-muc-bai-viet/';
										} 
										else 
										{
											$prefix = 'danh-muc/';
										}
										$html .= "<li class='b'>";
											$html .= "<a href = '".base_url().$prefix.$category['childs'][$i]['alias']."' title='".$category['childs'][$i]['name']."' alt='".$category['childs'][$i]['name']."'>";
												if ($category['childs'][$i]['fa_icons'] != '') {
													$html .= "<span class='".$category['childs'][$i]['fa_icons']."'></span> ";
												}
												$html .= $category['childs'][$i]['name'];
												if ($category['childs'][$i]['count_childs'] > 0) {
													$html .= "<span class='fa fa-angle-right ml5'></span>";
												}
											$html .= "</a>";
											if ($category['childs'][$i]['count_childs'] > 0) {
												recursivelyCategories($html, $category['childs'][$i]);
											}
										$html .= "</li>";
									}
								}
							$html .= "</ul>";
							return $html;
						} else {
							return '';
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
<!-- END MENU -->