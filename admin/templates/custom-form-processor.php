<?php
/**
 * Tni Core Form Processor Template
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.6
 * @license    GPL-2.0+
 */
?>

<div class="caldera-config-group">
	<label><?php _e( 'URL', 'tni-core' ); ?> </label>
	<div class="caldera-config-field">
		<input type="text" class="block-input field-config" name="{{_name}}[url]" value="{{url}}">
	</div>
</div>
<div class="caldera-config-group">
	<div class="caldera-config-field">
		<label><?php _e( 'Debug Mode', 'tni-core' ); ?> </label>
	  <input type="checkbox" class="field-config" name="{{_name}}[debug]" value="1" {{#if debug}}checked="checked"{{/if}}>
	</div>
</div>
