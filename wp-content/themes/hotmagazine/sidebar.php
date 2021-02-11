<?php $custom  = hotmagazine_custom(); ?>

<!-- sidebar -->
<div class="sidebar theiaStickySidebar <?php if(is_category( 'travel' )){ echo 'large-sidebar'; }?> <?php if($custom['body_style']!='' and $custom['body_style']=='design' ){ ?> large-sidebar<?php } ?>">
	<?php 
		if(is_active_sidebar('sidebar-1')){
			dynamic_sidebar('sidebar-1');
		}
	?>




</div>
<!-- End sidebar -->