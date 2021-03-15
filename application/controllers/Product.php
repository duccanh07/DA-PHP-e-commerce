<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class Product extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Mcategory');
        $this->load->model('Mproduct');
        $this->load->model('Majaxupload');
        $this->load->model('Mcontent');
        $this->load->model('frontend/Mconfig');
        $this->load->library('custom_pagination');
        $this->data['component']='product';
        $this->Common = new Common();
        $arrIdCategoies = array();
        $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
        $this->data['listCategories'] = $listCategories;
        $this->data['listSliders'] = $this->Common->listSliders();
        $this->data['listPoliciesOrther'] = $this->Common->listPoliciesOrther();
    }

    public function video($alias) {
        if ($this->Mcontent->content_check_field('alias', $alias) == true || $this->Mcontent->content_check_field('alias', $alias) == 1) {
            $detailProduct = $this->Mcontent->content_detail_alias($alias);
            if ($detailProduct['urlVideo'] != '' && $detailProduct['type'] == 6) {
                $this->data['detailProduct'] = $detailProduct;
                $listProductsRef = $this->Mcontent->content_video_ref($detailProduct['id']);
                for($i = 0; $i < count($listProductsRef); $i++) {
                    $listProductsRef[$i]['images'] = json_decode($listProductsRef[$i]['images'])[0];
                    $listProductsRef[$i]['title_image'] = json_decode($listProductsRef[$i]['title_image'])[0];
                    $listProductsRef[$i]['alt_image'] = json_decode($listProductsRef[$i]['alt_image'])[0];
                }
                $this->data['listProductsRef'] = $listProductsRef;
                $this->data['view'] = 'video';
                $configs =  getConfigs();
                $this->data['configs'] = $configs;
                $this->data['seoTitle'] = $detailProduct['seo_title'];
                $this->data['seoKeywords'] = $detailProduct['seo_keywords'];
                $this->data['seoDescription'] = $detailProduct['seo_description'];
                $this->data['seoGoogle'] = $detailProduct['seo_google'];
                $this->data['seoFacebook'] = $detailProduct['seo_facebook'];
                $this->load->view('frontend/layout',$this->data);
            } else {
                redirect(URL_404,'refresh');
            }
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function product_by_category($alias) {
        if ($this->Mcategory->category_check_field('alias', $alias)) {
            $idCategory = $this->Mcategory->category_get_field_by_field('alias', $alias, 'id');
            $arrayIdOfCategories = array();
            $listCategoriesById = $this->Common->get_list_categories($arrayIdOfCategories, $idCategory);
            array_push($arrayIdOfCategories, $idCategory);
            for($i = 0; $i < count($listCategoriesById); $i++) {
                array_push($arrayIdOfCategories, $listCategoriesById[$i]['id']);
            }
            $pageCurrent=$this->custom_pagination->PageCurrent();
            $listProduct = LIMIT_PRODUCT_SHOW_CATEGORY;
            $totalItem=$this->Mproduct->productCountByCategory($arrayIdOfCategories);
            $firstPage=$this->custom_pagination->PageFirst($listProduct, $pageCurrent);
            $this->data['strphantrang']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, ($listProduct), $url= base_url().'danh-muc/'.$alias);
            $listProduct = $this->Mproduct->productByArrayCatId($arrayIdOfCategories, $listProduct, $firstPage);
            for($i = 0; $i < count($listProduct); $i++) {
                $listProduct[$i]['images'] = json_decode($listProduct[$i]['images'])[0];
            }
            $detailCategory = $this->Mcategory->category_detail($idCategory);
            $this->data['listProduct'] = $listProduct;
            $this->data['listCategoriesChild'] = $this->Mcategory->category_all_content($detailCategory['id'], TYPE_CATEGORY_PRODUCT, 'all');
            $this->data['totalItem'] = $totalItem;
            $this->data['detailCategory'] = $detailCategory;
            $configs =  getConfigs();
            $this->data['configs'] = $configs;
            $this->data['view']='product_by_category';
            $this->data['seoTitle']=$detailCategory['name'];
            $this->data['seo_google']=$detailCategory['seo_google'];
            $this->data['seo_facebook']=$detailCategory['seo_facebook'];
            $this->load->view('frontend/layout',$this->data);
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function detail_product($alias) { 
        if ($this->Mproduct->product_check_alias($alias) == true) {
            $detailProduct = $this->Mproduct->product_detail_no_join_alias($alias);
            $detailProduct['images'] = json_decode($detailProduct['images']);
            $this->data['detailProduct'] = $detailProduct;
            $listProductsRef = $this->Mproduct->products_ref($detailProduct['id'], $detailProduct['category_id']);
            for($i = 0; $i < count($listProductsRef); $i++) {
                $listProductsRef[$i]['images'] = json_decode($listProductsRef[$i]['images'])[0];
                $listProductsRef[$i]['title_image'] = json_decode($listProductsRef[$i]['title_image'])[0];
                $listProductsRef[$i]['alt_image'] = json_decode($listProductsRef[$i]['alt_image'])[0];
            }
            $this->data['listProductsRef'] = $listProductsRef;
            $this->data['view']='detail_product';
            $configs =  getConfigs();
            $this->data['configs'] = $configs;
            $this->data['seoTitle'] = $detailProduct['seo_title'];
            $this->data['seoKeywords'] = $detailProduct['seo_keywords'];
            $this->data['seoDescription'] = $detailProduct['seo_description'];
            $this->data['seo_google'] = $detailProduct['seo_google'];
            $this->data['seo_facebook'] = $detailProduct['seo_facebook'];
            $this->load->view('frontend/layout',$this->data);
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function change_price() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduct = $_POST['idProduct'];
            $positionSize = $_POST['positionSize'];
            $productDetail = $this->Mproduct->product_detail($idProduct);
            $item_prices = json_decode($productDetail['item_prices']);
            $item_codes = json_decode($productDetail['item_codes']);
            $items_price_sale = json_decode($productDetail['items_price_sale']);
            $item_sizes = json_decode($productDetail['item_sizes']);
            $item_colors = json_decode($productDetail['item_colors']);
            $item_weights = json_decode($productDetail['item_weights']);
            $htmlPrice = ''; $price = 0; $priceSale = 0; $sale = 0; $size = ''; $color = ''; $weight = ''; $code = false;
            $isNotPrice = false;
            if ($item_prices[$positionSize] != '') {
                $price = $item_prices[$positionSize];
            } else {
                $isNotPrice = true;
            }
            if ($item_codes[$positionSize] != '') {
                $code = $item_codes[$positionSize];
            }
            if ($items_price_sale[$positionSize] != '') {
                $priceSale = $items_price_sale[$positionSize];
            }

            if ($item_sizes[$positionSize] != '') {
                $size = $item_sizes[$positionSize];
            }

            if ($item_colors[$positionSize] != '') {
                $color = $item_colors[$positionSize];
            }

            if ($item_weights[$positionSize] != '') {
                $weight = $item_weights[$positionSize];
            }

            if ($priceSale > 0 && $price > 0) {
                $sale = round(((($price - $priceSale) / $price) * 100), 2);
            }

            $htmlPriceSale = '';
            if ($price > 0 && $priceSale > 0) {
                $htmlPriceSale .= "<span class='woocommerce-Price-amount amount price-sale'>";
                    $htmlPriceSale .= number_format($priceSale).'đ';      
                    $htmlPriceSale .= "<span class='woocommerce-Price-currencySymbol'></span>";
                $htmlPriceSale .= "</span>";
            } else {
                $htmlPriceSale .= "<span class='woocommerce-Price-amount amount price-sale'>";
                    $htmlPriceSale .= number_format($price).'đ';      
                    $htmlPriceSale .= "<span class='woocommerce-Price-currencySymbol'></span>";
                $htmlPriceSale .= "</span>";
            }

            $htmlPrice = '';
            if ($priceSale > 0) {
                $htmlPrice .= "<span class='woocommerce-Price-amount amount price-default'>";
                    $htmlPrice .= number_format($price).'đ';      
                    $htmlPrice .= "<span class='woocommerce-Price-currencySymbol'></span>";
                $htmlPrice .= "</span>";
            }

            $htmlSale = '';
            if ((int)$price > 0 && (int)$priceSale > 0) {
                $htmlSale .= "<span class='sale-of'>".$sale."%</span>";
            }
            echo json_encode(array(
                'code' => 1,
                'data' => array(
                    'price' => $htmlPrice,
                    'sale' => $htmlSale,
                    'priceSale' => $htmlPriceSale,
                    'size' => $size,
                    'color' => $color,
                    'weight' => $weight,
                    'isNotPrice' => $isNotPrice,
                    'prSale' => $sale,
                    'code' => $code
                )
            ));
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function videos() {
        $pageCurrent=$this->custom_pagination->PageCurrent();
        $listProduct = LIMIT_PRODUCT_SHOW_CATEGORY;
        $totalItem=$this->Mcontent->content_count_type_video();
        $firstPage=$this->custom_pagination->PageFirst($listProduct, $pageCurrent);
        $this->data['strphantrang']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, ($listProduct), $url= base_url().'videos');
        $listProduct = $this->Mcontent->list_contents_type_video($listProduct, $firstPage);
        
        for($i = 0; $i < count($listProduct); $i++) {
            $listProduct[$i]['images'] = json_decode($listProduct[$i]['images'])[0];
            $listProduct[$i]['title_image'] = json_decode($listProduct[$i]['title_image'])[0];
            $listProduct[$i]['alt_image'] = json_decode($listProduct[$i]['alt_image'])[0];
        }
        $configs =  getConfigs();
        $this->data['configs'] = $configs;
        $this->data['seoTitle'] = 'Danh sách video';
        $this->data['listProduct'] = $listProduct;
        $this->data['totalItem'] = $totalItem;
        $this->data['view']='videos';
        $this->load->view('frontend/layout',$this->data);
    }

    public function get() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduct = $_POST['id'];
            $this->session->set_userdata('idProductOrder', $idProduct);
            if ($this->Mproduct->product_check_id($idProduct) == TRUE) {
                $productDetail = $this->Mproduct->product_detail($idProduct);
                $item_prices = json_decode($productDetail['item_prices']);
                $item_codes = json_decode($productDetail['item_codes']);
                $items_price_sale = json_decode($productDetail['items_price_sale']);
                $item_sizes = json_decode($productDetail['item_sizes']);
                $item_colors = json_decode($productDetail['item_colors']);
                $item_weights = json_decode($productDetail['item_weights']);
                $productDetail['images'] = json_decode($productDetail['images']);
                $price = 0; $priceSale = 0; $sale = 0; $size = ''; $color = ''; $weight = ''; $code = false;
                $positionSize = 0;
                $isNotPrice = false;
                if ($item_prices[$positionSize] != '') {
                    $price = $item_prices[$positionSize];
                } else {
                    $isNotPrice = true;
                }
                if ($item_codes[$positionSize] != '') {
                    $code = $item_codes[$positionSize];
                }
                if ($items_price_sale[$positionSize] != '') {
                    $priceSale = $items_price_sale[$positionSize];
                }

                if ($item_sizes[$positionSize] != '') {
                    $size = $item_sizes[$positionSize];
                }

                if ($item_colors[$positionSize] != '') {
                    $color = $item_colors[$positionSize];
                }

                if ($item_weights[$positionSize] != '') {
                    $weight = $item_weights[$positionSize];
                }

                if ($priceSale > 0 && $price > 0) {
                    $sale = round(((($price - $priceSale) / $price) * 100), 2);
                }
                $this->data['detailProduct'] = $productDetail;
                $result=$this->load->view('frontend/module/ModalViewProductResult', $this->data, TRUE);
                echo json_encode($result);
            }
        } else {
            redirect(URL_404,'refresh');
        }
    }
}
