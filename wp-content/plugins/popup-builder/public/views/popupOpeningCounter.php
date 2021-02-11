<?php
	$popupId = $popupTypeObj->getOptionValue('sgpb-post-id');
	$count = $popupTypeObj->getPopupOpeningCountById($popupId);
	$counterReset = 'SGPBBackend.resetCount('.$popupId.', false)';
?>
<div class="sgpb-wrapper sgpb-popup-opening-analytics-container">
	<div class="row form-group">
		<label for="sgpb-enable-floating-button" class="col-md-3 control-label sgpb-static-padding-top">
			<?php _e('Views', SG_POPUP_TEXT_DOMAIN)?>:
		</label>
		<div class="col-md-3">
			<span class="sgpb-popup-opening-analytics-option-value-span badge"><?php echo $count; ?></span>
		</div>
		<div class="col-md-3">
			<input onclick="SGPBBackend.resetCount(<?php echo $popupId; ?>, false)" type="button" class="button sgpb-reset-count-btn" value="reset" <?php echo ($popupId && $count != 0) ? '' : ' disabled' ; ?>>
		</div>
	</div>
	<div class="row form-group">
		<label for="sgpb-enable-floating-button" class="col-md-3 control-label sgpb-static-padding-top">
			<?php _e('Disable', SG_POPUP_TEXT_DOMAIN)?>:
		</label>
		<div class="col-md-4">
			<label class="sgpb-switch">
				<input name="sgpb-popup-counting-disabled" type="checkbox" <?php echo $popupTypeObj->getOptionValue('sgpb-popup-counting-disabled');?>>
				<div class="sgpb-slider sgpb-round"></div>
			</label>
		</div>
	</div>
</div>
