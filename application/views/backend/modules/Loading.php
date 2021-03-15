<div id="myDiv" style="position: absolute; top: 0; z-index: 999; width: 100%; left: 0; background: rgba(0, 0, 0, 0.3); padding-top: 50px; padding-left: 230px; height: 100%; display: none;">
    <div style="width: 100%; position:  relative; height: 100%">
    	<img id="loading-image" src="<?php echo base_url() ?>/assets/images/loading.gif" style="display:block; width: 100px; height: 100px; position: absolute;"/>
    	<script>
    		$('#loading-image').css({
    			top: ($(window).height() / 2 - 100 - 50) + 'px',
    			left: (($(window).width() - 230 - 100) / 2) + 'px'
    		});
    	</script>
    </div>
</div>