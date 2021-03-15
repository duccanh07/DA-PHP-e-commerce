<div class="mini-icon" style=" position: fixed; bottom: 20px; left: 0;z-index: 999999 ">

	<?php 
        if ( isset($configs['iconsContactConfig']['value']->urlMessengerFacebook) && $configs['iconsContactConfig']['value']->urlMessengerFacebook != '') :
  	?>
          	<a class="fb-chat" href="<?php echo $configs['iconsContactConfig']['value']->urlMessengerFacebook ?>" target="_blank" title="Facebook" alt="Icon facebook">

				<img src="<?php echo base_url() ?>assets/images/mess.png" height="50" width="50" style="z-index: 999999" title="Facebook" alt="Icon facebook">

			</a>
  	<?php 
        endif;
  	?>

  	<?php 
        if ( isset($configs['iconsContactConfig']['value']->zalo) && $configs['iconsContactConfig']['value']->zalo != '') :
  	?>
          	<a class="fb-chat" href="<?php echo $configs['iconsContactConfig']['value']->zalo ?>" target="_blank" title="Zalo" alt="Icon zalo">

				<img src="<?php echo base_url() ?>assets/images/zalo.png" height="50" width="50" style="z-index: 999999" title="Zalo" alt="Icon zalo">

			</a>
  	<?php 
        endif;
  	?>

  	<?php 
        if ( isset($configs['iconsContactConfig']['value']->urlGoogleMaps) && $configs['iconsContactConfig']['value']->urlGoogleMaps != '') :
  	?>
          	<a class="gg-map" href="<?php echo $configs['iconsContactConfig']['value']->urlGoogleMaps ?>" target="_blank" title="Google Maps" alt="Icon google maps">

			<img src="<?php echo base_url() ?>assets/images/map.png" height="50" width="50" style="z-index: 999999" title="Google Maps" alt="Icon google maps">

		</a>
  	<?php 
        endif;
  	?>
	
	<?php 
        if ( isset($configs['contactConfig']['value']->hotlineShop) && $configs['contactConfig']['value']->hotlineShop != '') :
  	?>
          	<a class="gg-map" href="tel:<?php echo $configs['contactConfig']['value']->hotlineShop ?>" target="_blank" title="Phone" alt="Icon phone">

				<img src="<?php echo base_url() ?>assets/images/hotline.png" height="50" width="50" style="z-index: 999999" title="Phone" alt="Icon phone">

			</a>

		</a>
  	<?php 
        endif;
  	?>

</div>