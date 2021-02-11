<?php
use sgpb\AdminHelper;
$defaultData = ConfigDataHelper::defaultData();
$defaultPositions = $defaultData['floatingButtonPositionsCorner'];
if ($popupTypeObj->getOptionValue('sgpb-floating-button-style') == 'basic') {
	$defaultPositions = $defaultData['floatingButtonPositionsBasic'];
}
?>
<div class="sgpb-wrapper sgpb-floating-btn-wrapper" id="sgpb-floating-btn-wrapper">
	<div class="row form-group">
		<label for="sgpb-enable-floating-button" class="col-md-5 control-label sgpb-static-padding-top">
			<?php _e('Enable', SG_POPUP_TEXT_DOMAIN)?>:
		</label>
		<div class="col-md-7">
			<input id="sgpb-enable-floating-button" onchange="SGPBFloatingButton.prototype.adminInit()" type="checkbox" class="js-checkbox-accordion" id="sgpb-enable-floating-button" name="sgpb-enable-floating-button" <?php echo $popupTypeObj->getOptionValue('sgpb-enable-floating-button'); ?>>
		</div>
	</div>
	<div class="sg-full-width">
		<div class="row form-group">
			<label for="sgpb-floating-button-style" class="col-md-5 control-label sgpb-static-padding-top">
				<?php _e('Style', SG_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-7">
				<?php echo AdminHelper::createSelectBox($defaultData['floatingButtonStyle'], $popupTypeObj->getOptionValue('sgpb-floating-button-style'), array('name' => 'sgpb-floating-button-style', 'class'=>'js-sg-select2', 'id' => 'sgpb-floating-button-style')); ?>
			</div>
		</div>
		<div class="row form-group">
			<label for="sgpb-floating-button-position" class="col-md-5 control-label sgpb-static-padding-top">
				<?php _e('Position', SG_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-7">
				<?php echo AdminHelper::createSelectBox($defaultPositions, $popupTypeObj->getOptionValue('sgpb-floating-button-position'), array('name' => 'sgpb-floating-button-position', 'class'=>'js-sg-select2', 'id' => 'sgpb-floating-button-position')); ?>
			</div>
		</div>
		<div class="row form-group">
			<label class="col-md-5 sgpb-static-padding-top" for="sgpb-floating-button-font-size">
				<?php _e('Font size', SG_POPUP_TEXT_DOMAIN)  ?>:
			</label>
			<div class="col-md-5">
				<input type="number" min="0" name="sgpb-floating-button-font-size" id="sgpb-floating-button-font-size" class="form-control sgpb-full-width-events" value="<?php echo $popupTypeObj->getOptionValue('sgpb-floating-button-font-size'); ?>">
			</div>
			<div class="col-md-1">
				<span class="sgpb-restriction-unit">px</span>
			</div>
		</div>
		<div class="sgpb-basic-button-style-options-wrapper-js<?php echo ($popupTypeObj->getOptionValue('sgpb-floating-button-position') == 'corner') ? ' sgpb-hide' : ''; ?>">
			<div class="row form-group">
				<label class="col-md-5 sgpb-static-padding-top" for="sgpb-floating-button-position-top">
					<?php _e('Position top', SG_POPUP_TEXT_DOMAIN)  ?>:
				</label>
				<div class="col-md-5">
					<input type="number" min="0" name="sgpb-floating-button-position-top" id="sgpb-floating-button-position-top" class="form-control sgpb-full-width-events" value="<?php echo $popupTypeObj->getOptionValue('sgpb-floating-button-position-top'); ?>">
				</div>
				<div class="col-md-1">
					<span class="sgpb-restriction-unit">%</span>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-md-5 sgpb-static-padding-top" for="sgpb-floating-button-position-right">
					<?php _e('Position right', SG_POPUP_TEXT_DOMAIN)  ?>:
				</label>
				<div class="col-md-5">
					<input type="number" min="0" name="sgpb-floating-button-position-right" id="sgpb-floating-button-position-right" class="form-control sgpb-full-width-events" value="<?php echo $popupTypeObj->getOptionValue('sgpb-floating-button-position-right'); ?>">
				</div>
				<div class="col-md-1">
					<span class="sgpb-restriction-unit">%</span>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-md-5 sgpb-static-padding-top" for="sgpb-floating-button-border-size">
					<?php _e('Border size', SG_POPUP_TEXT_DOMAIN)  ?>:
				</label>
				<div class="col-md-5">
					<input type="number" min="0" name="sgpb-floating-button-border-size" id="sgpb-floating-button-border-size" class="form-control sgpb-full-width-events" value="<?php echo $popupTypeObj->getOptionValue('sgpb-floating-button-border-size'); ?>">
				</div>
				<div class="col-md-1">
					<span class="sgpb-restriction-unit">px</span>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-md-5 sgpb-static-padding-top" for="sgpb-floating-button-border-radius">
					<?php _e('Border radius', SG_POPUP_TEXT_DOMAIN)  ?>:
				</label>
				<div class="col-md-5">
					<input type="number" min="0" name="sgpb-floating-button-border-radius" id="sgpb-floating-button-border-radius" class="form-control sgpb-full-width-events" value="<?php echo $popupTypeObj->getOptionValue('sgpb-floating-button-border-radius'); ?>">
				</div>
				<div class="col-md-1">
					<span class="sgpb-restriction-unit">px</span>
				</div>
			</div>
			<div class="row form-group">
				<label for="sgpb-floating-button-border-color" class="col-md-12 control-label sgpb-static-padding-top">
					<?php _e('Border color', SG_POPUP_TEXT_DOMAIN)?>:
				</label>
				<div class="col-md-12">
					<div class="sgpb-color-picker-wrapper sgpb-floating-button-border-color">
						<input id="sgpb-floating-button-border-color" data-type="borderColor" class="sgpb-color-picker sgpb-floating-button-border-color" type="text" name="sgpb-floating-button-border-color" value="<?php echo esc_html($popupTypeObj->getOptionValue('sgpb-floating-button-border-color')); ?>" >
					</div>
				</div>
			</div>
		</div>
		<div class="row form-group">
			<label for="sgpb-floating-button-bg-color" class="col-md-12 control-label sgpb-static-padding-top">
				<?php _e('Background color', SG_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-12">
				<div class="sgpb-color-picker-wrapper sgpb-floating-button-bg-color">
					<input id="sgpb-floating-button-bg-color" data-type="backgroundColor" class="sgpb-color-picker sgpb-floating-button-bg-color" type="text" name="sgpb-floating-button-bg-color" value="<?php echo esc_html($popupTypeObj->getOptionValue('sgpb-floating-button-bg-color')); ?>" >
				</div>
			</div>
		</div>
		<div class="row form-group">
			<label for="sgpb-floating-button-text-color" class="col-md-12 control-label sgpb-static-padding-top">
				<?php _e('Text color', SG_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-12">
				<div class="sgpb-color-picker-wrapper sgpb-floating-button-text-color">
					<input id="sgpb-floating-button-text-color" data-type="color" class="sgpb-color-picker sgpb-floating-button-text-color" type="text" name="sgpb-floating-button-text-color" value="<?php echo esc_html($popupTypeObj->getOptionValue('sgpb-floating-button-text-color')); ?>" >
				</div>
			</div>
		</div>
		<div class="row form-group">
			<label for="sgpb-floating-button-text" class="col-md-12 control-label sgpb-static-padding-top">
				<?php _e('Text', SG_POPUP_TEXT_DOMAIN)?>:
			</label>
			<div class="col-md-12">
				<div class="sgpb-floating-button-text">
					<input id="sgpb-floating-button-text" class="sgpb-floating-button-text" type="text" name="sgpb-floating-button-text" value="<?php echo esc_html($popupTypeObj->getOptionValue('sgpb-floating-button-text')); ?>" >
				</div>
			</div>
		</div>
	</div>
</div>
