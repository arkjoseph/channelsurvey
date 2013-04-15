<?php
/**
 * Return a themed form element.
 * 
 * Same as default, with following exceptions:
 * 
 *		Removed ":" for form labels
 *
 * @param element
 *   An associative array containing the properties of the element.
 *   Properties used: title, description, id, required
 * @param $value
 *   The form element's data.
 * @return
 *   A string representing the form element.
 *
 * @ingroup themeable
 */
function channelsurvey_form_element($element, $value) {
	// This is also used in the installer, pre-database setup.
	$t = get_t();

	$output = '<div class="form-item"';
	if (!empty($element['#id'])) {
    	$output .= ' id="'. $element['#id'] .'-wrapper"';
	}
  
	$output .= ">\n";
	$required = !empty($element['#required']) ? '<span class="error_indicator" title="'. $t('This field is required.') .'">&nbsp;</span>' : '';

	$output .= $required;

	if (!empty($element['#title'])) {
    	$title = $element['#title'];
		if (!empty($element['#id'])) {
      		$output .= ' <label for="'. $element['#id'] .'">'. $t('!title', array('!title' => filter_xss_admin($title))) ."</label>\n";
    	}
    	else {
      		$output .= ' <label>'. $t('!title', array('!title' => filter_xss_admin($title))) ."</label>\n";
    	}
	}

	// Originally wrapped here, but moved to only textfield
	$output .= " $value\n";

	if (!empty($element['#description'])) {
		$output .= ' <div class="description">'. $element['#description'] ."</div>\n";
	}

	$output .= "</div>\n";

	return $output;
}

/**
 * Format a textfield.
 * 
 * Same as default, with following exceptions:
 * 
 *		Wrap input with span elements
 *
 *
 * @param $element
 *   An associative array containing the properties of the element.
 *   Properties used:  title, value, description, size, maxlength, required, attributes autocomplete_path
 * @return
 *   A themed HTML string representing the textfield.
 *
 * @ingroup themeable
 */
function channelsurvey_textfield($element) {
	$size = empty($element['#size']) ? '' : ' size="'. $element['#size'] .'"';
	$maxlength = empty($element['#maxlength']) ? '' : ' maxlength="'. $element['#maxlength'] .'"';
	$class = array('form-text');
	$extra = '';
	$output = '';

	if ($element['#autocomplete_path'] && menu_valid_path(array('link_path' => $element['#autocomplete_path']))) {
    	drupal_add_js('misc/autocomplete.js');
		$class[] = 'form-autocomplete';
		$extra =  '<span class="field text"><span><input class="autocomplete" type="hidden" id="'. $element['#id'] .'-autocomplete" value="'. check_url(url($element['#autocomplete_path'], array('absolute' => TRUE))) .'" disabled="disabled" /></span></span>';
	}
	_form_set_class($element, $class);

	if (isset($element['#field_prefix'])) {
    	$output .= '<span class="field-prefix">'. $element['#field_prefix'] .'</span> ';
	}

	$output .= '<span class="field text"><span><input type="text"'. $maxlength .' name="'. $element['#name'] .'" id="'. $element['#id'] .'"'. $size .' value="'. check_plain($element['#value']) .'"'. drupal_attributes($element['#attributes']) .' /></span></span>';

	if (isset($element['#field_suffix'])) {
    	$output .= ' <span class="field-suffix">'. $element['#field_suffix'] .'</span>';
	}

	return theme('form_element', $element, $output) . $extra;
}


/**
 * Theme a form button.
 *
 * Same as default, with following exceptions:
 *
 *		Remove value from input value and add to span
 *		Change input to button
 *
 *
 * @ingroup themeable
 */
function channelsurvey_button($element) {
	// Make sure not to overwrite classes.
  	if (isset($element['#attributes']['class'])) {
    	$element['#attributes']['class'] = 'form-'. $element['#button_type'] .' '. $element['#attributes']['class'];
  	}

  	else {
    	$element['#attributes']['class'] = 'form-'. $element['#button_type'];
  	}

  return '<button type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ') .'id="'. $element['#id'] .'" value="' . '" '. drupal_attributes($element['#attributes']) .">\n <span class=\"input-submit-span\">" . check_plain($element['#value']) . "</span></button>";
}

/**
 * Format a textarea.
 *
 *
 * Same as default, with following exceptions:
 *
 *		Remove resizeable functionality and class
 *		Wrapped input with new markup (see bottom of function)
 *
 * @param $element
 *   An associative array containing the properties of the element.
 *   Properties used: title, value, description, rows, cols, required, attributes
 * @return
 *   A themed HTML string representing the textarea.
 *
 * @ingroup themeable
 */
function channelsurvey_textarea($element) {
	$arg = arg();
	if($arg[2] == 'edit') {
		$class = array('form-textarea');

	  // Add teaser behavior (must come before resizable)
	  if (!empty($element['#teaser'])) {
	    drupal_add_js('misc/teaser.js');
	    // Note: arrays are merged in drupal_get_js().
	    drupal_add_js(array('teaserCheckbox' => array($element['#id'] => $element['#teaser_checkbox'])), 'setting');
	    drupal_add_js(array('teaser' => array($element['#id'] => $element['#teaser'])), 'setting');
	    $class[] = 'teaser';
	  }

	  // Add resizable behavior
	  if ($element['#resizable'] !== FALSE) {
	    drupal_add_js('misc/textarea.js');
	    $class[] = 'resizable';
	  }

	  _form_set_class($element, $class);
	  return theme('form_element', $element, '<textarea cols="'. $element['#cols'] .'" rows="'. $element['#rows'] .'" name="'. $element['#name'] .'" id="'. $element['#id'] .'" '. drupal_attributes($element['#attributes']) .'>'. check_plain($element['#value']) .'</textarea>');
	  

	} else {

		$class = array('form-textarea');

		// Add teaser behavior (must come before resizable)
		if (!empty($element['#teaser'])) {
	    	drupal_add_js('misc/teaser.js');
	    	// Note: arrays are merged in drupal_get_js().
	    	drupal_add_js(array('teaserCheckbox' => array($element['#id'] => $element['#teaser_checkbox'])), 'setting');
	    	drupal_add_js(array('teaser' => array($element['#id'] => $element['#teaser'])), 'setting');
	    	$class[] = 'teaser';
	  	}

		// Add resizable behavior
		// if ($element['#resizable'] !== FALSE) {
		// 	drupal_add_js('misc/textarea.js');
		// 	$class[] = 'resizable';
		// }

		_form_set_class($element, $class);
	
		return theme('form_element', $element, '<span class="field textarea"><div class="outer"><div class="content"><div class="t"></div><textarea cols="'. $element['#cols'] .'" rows="'. $element['#rows'] .'" name="'. $element['#name'] .'" id="'. $element['#id'] .'" '. drupal_attributes($element['#attributes']) .'>'. check_plain($element['#value']) .'</textarea></div><div class="b"><div></div></div></div></span>');

	// '<span class="field textarea">
	// 	<div class="outer">
	// 		<div class="content">
	// 			<div class="t"></div>
	// 			
	// 		</div>		
	// 		<div class="b">
	// 			<div></div>
	// 		</div>
	// 	</div>
	// </span>'
	}
}

/**
 * Format a radio button.
 *
 * Same as default, with following exceptions:
 *
 *		Changed markup by adding a span and changing location of label
 *		Add 'replaced' class to input
 *
 * @param $element
 *   An associative array containing the properties of the element.
 *   Properties used: required, return_value, value, attributes, title, description
 * @return
 *   A themed HTML string representing the form item group.
 *
 * @ingroup themeable
 */
function channelsurvey_radio($element) {
	_form_set_class($element, array('form-radio replaced'));
	
	// Added
	$output = '<p class="radios"><span class="field radio"></span>';
	$output .= '<input type="radio" ';
	$output .= 'id="'. $element['#id'] .'" ';
	$output .= 'name="'. $element['#name'] .'" ';
	$output .= 'value="'. $element['#return_value'] .'" ';
	$output .= (check_plain($element['#value']) == $element['#return_value']) ? ' checked="checked" ' : ' ';
	$output .= drupal_attributes($element['#attributes']) .' />';

	if (!is_null($element['#title'])) {
		// Changed
		$output .= '<label class="option" for="'. $element['#id'] .'">' . $element['#title'] . '</label>';
	}
	
	$output .= '</p>';

	unset($element['#title']);
	return theme('form_element', $element, $output);
}

/**
 * Register forms to theme registry
 *
 */
function channelsurvey_theme() {
	return array(
		
		'user_login' => array(
			'template' => 'user-login',
			'arguments' => array('form' => NULL),
			),
			
		// 'user_profile_form' => array(
		// 	'arguments' => array('form' => NULL),
		// ),
		
		// 'user_profile_form' => array(
		// 	'template' => 'user-edit-form',
		// 	'arguments' => array('form' => NULL),
		// 	),		
	);
}


/**
 * Login form
 */
function channelsurvey_preprocess_user_login(&$variables) {	
	// Alter text
	// $variables['form']['name']['#title'] = t("Email Address");
	
	// Remove descriptions
	unset($variables['form']['name']['#description']);
	unset($variables['form']['pass']['#description']);

	// Pass to template (not necessary to reflect altered text - used when
	// items need to be broken up, classes added between items, etc.)
	$variables['email_field'] = drupal_render($variables['form']['name']);
	$variables['pass_field'] = drupal_render($variables['form']['pass']);
	
	// This, as usual, will output everything we didn't output explicitly.
	$variables['rendered'] = drupal_render($variables['form']);
}