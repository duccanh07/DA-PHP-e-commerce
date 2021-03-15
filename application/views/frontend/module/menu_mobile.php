<div id="header">

    <nav class="navbar navbar-inverse" style="z-index: 9999">

        <div class="container">

            <div>

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle pull-right collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button>

                    <div class="icon-cart-mobile hidden-md hidden-lg">

                        <a href="<?php echo base_url() ?>gio-hang" title="Giỏ hàng" alt="Giỏ hàng">

                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                            <span class="total-product-cart">

                                <?php  

                                    if($this->session->userdata('sesstionCartClient')){

                                        echo count($this->session->userdata('sesstionCartClient'));

                                    }else{

                                        echo 0;

                                    }

                                ?>

                            </span>

                        </a>

                    </div>

                    <div class="site-container">

                        <!-- <a href="<?php echo base_url() ?>" class="header__icon pull-left" id="header__icon" title="Trang chủ" alt="Trang chủ">

                            <img src="<?php echo base_url() ?>assets/images/logo.png" alt="" style="height: 40px; margin-top: 5px;">

                        </a> -->

                    </div>

                </div>

                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">

                    <ul class="nav navbar-nav">

                        <?php for ($i = 0; $i < count($listCategories); $i++) :  ?>

                            <li class="">

                                <?php 

                                    $alias = "";

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

                                <a href="<?php echo $alias; ?>" title="<?php echo $listCategories[$i]['name'] ?>" alt="<?php echo $listCategories[$i]['name'] ?>">

                                    <?php if($listCategories[$i]['fa_icons'] != '') : ?>

                                        <span class="<?php echo $listCategories[$i]['fa_icons'] ?>"></span> 

                                    <?php endif;

                                    echo $listCategories[$i]['name']; 

                                    if($listCategories[$i]['count_childs'] > 0 && $listCategories[$i]['parent_id'] == DEFAULT_PARENT_ID) : ?>

                                        <span class="fa fa-angle-down"></span> 

                                    <?php endif; ?>

                                </a>

                                <?php echo recursivelyCategoriesMobile($html, $listCategories[$i]);?>

                            </li>

                        <?php 

                            endfor; 

                            function recursivelyCategoriesMobile(&$html, $category) {

                                if ($category['parent_id'] == DEFAULT_PARENT_ID && $category['type'] == TYPE_CATEGORY_CONTENT) {

                                    $html = '';

                                }

                                if ($category['count_childs'] > 0) {

                                    $html .= "<ul class='dropdown-menu ".$category['id']."'>";

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

                                                    $html .= "<a href = '".base_url().$prefix.$category['childs'][$i]['alias']."' title = '".$category['childs'][$i]['name']."' alt = '".$category['childs'][$i]['name']."'>";

                                                        if ($category['childs'][$i]['fa_icons'] != '') {

                                                            $html .= "<span class='".$category['childs'][$i]['fa_icons']."'></span> ";

                                                        }

                                                        

                                                        $html .= $category['childs'][$i]['name'];

                                                        if ($category['childs'][$i]['count_childs'] > 0) {

                                                            $html .= "<span class='fa fa-angle-right'></span> ";

                                                        }

                                                    $html .= "</a>";

                                                    if ($category['childs'][$i]['count_childs'] > 0) {

                                                        recursivelyCategoriesMobile($html, $category['childs'][$i]);

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
                    <form action="<?php echo base_url('search') ?>" enctype="multipart/form-data" method="GET" accept-charset="utf-8" class="form-inline my-2 my-lg-0 w-100 nav-mobile-custom ">
                        <input class="form-control mr-sm-2" type="search" name="keywords" aria-label="Search">
                        <button class="btn btn-outline-success my-sm-0 fa fa-search" type="submit"></button>
                    </form>

                </div>

            </div>

        </div>

    </nav>

</div>