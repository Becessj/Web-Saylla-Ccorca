<?php

/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="search-box">

<form role="search" method="get" class="search-form" action="<?php bbp_search_url(); ?>">
	<div>
		
		<input type="hidden" name="action" value="bbp-search-request" />
		<input placeholder="Search here" tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<button tabindex="<?php bbp_tab_index(); ?>" type="submit" id="search-submit"><i class="fa fa-search"></i></button>
	</div>
</form>

</div>