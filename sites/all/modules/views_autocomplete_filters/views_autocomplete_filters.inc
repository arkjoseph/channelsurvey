<?php

// $Id: views_autocomplete_filters.module,v 1 vasike Exp $

/**
 * @file
 * Common functions for Autocomplete Filters module.
 */

/**
 * Menu callback; Retrieve a pipe delimited string of autocomplete suggestions.
 */
function views_autocomplete_filter($filter_name = NULL, $view_name, $display_name, $string = '') {
  $view = views_get_view($view_name);
  if (empty($view) || !$view->set_display($display_name)) {
    // No such view or something is wrong with display
    // (no such display, broken handler, etc.)
    drupal_not_found();
    return;
  }

  // Set display and display handler vars for quick access.
  $display = $view->display[$display_name];
  $display_handler = $display->handler;

  // Get exposed filter options for our field.
  // Also, check if filter is exposed and autocomplete is enabled for this filter
  // (and does filter exist/exposed at all).
  $filters = $display_handler->get_option('filters');
  if (empty($filters[$filter_name]['exposed']) || empty($filters[$filter_name]['expose']['autocomplete_filter'])) {
    drupal_not_found();
    return;
  }
  $expose_options = $filters[$filter_name]['expose'];

  // Determine field which will be used for output.
  if (empty($expose_options['autocomplete_field'])) {
    // Field is not set, report about it to watchdog and return empty array.
    watchdog('views_autocomplete_filters', 'Field for autocomplete filter %label is not set in view %view, display %display', array(
      '%label' => $expose_options['label'],
      '%view' => $view->name,
      '%display' => '',//TODO
    ), WATCHDOG_ERROR);
    drupal_json(array());
    return;
  }
  else {
    $field_name = $expose_options['autocomplete_field'];
  }

  // Get field options and check field exists in this display.
  $field_options = $view->get_item($display_name, 'field', $field_name);
  if (empty($field_options)) {
    // Field not exists, report about it to watchdog and return empty array.
    watchdog('views_autocomplete_filters', 'Field for autocomplete filter %label not exists in view %view, display %display', array(
      '%label' => $expose_options['label'],
      '%view' => $view->name,
      '%display' => '',//TODO
    ), WATCHDOG_ERROR);
    drupal_json(array());
    return;
  }

  // Overwrite the fields for the view with only one field we need.
  $display_handler->set_option('fields', array($field_name => $field_options));
  
  // Collect exposed filter values and set them to the view.
  if (!empty($expose_options['autocomplete_dependent'])) {
    $exposed_input = $_GET;
  }
  else {
    $exposed_input = array();
  }
  $exposed_input[$expose_options['identifier']] = $string;
  $view->set_exposed_input($exposed_input);

  // Disable pager.
  $display_handler->set_option('use_pager', 0);

  // Disable cache for view, because caching autocomplete is a waste of time and memory.
  $display_handler->set_option('cache', array('type' => 'none'));

  // Force limit for results.
  $autocomplete_items = empty($expose_options['autocomplete_items']) ? 0 : $expose_options['autocomplete_items'];
  $display_handler->set_option('items_per_page', $autocomplete_items);

  // Execute view query.
  $view->pre_execute();
  $view->execute($view->current_display);
  $view->post_execute();

  // Render field on each row and fill matches array.
  $use_raw_suggestion = !empty($expose_options['autocomplete_raw_suggestion']);
  $use_raw_dropdown = !empty($expose_options['autocomplete_raw_dropdown']);
  $field = $view->field[$field_name];
  $field_alias = $field->field_alias;
  
  $matches = array();
  $view->row_index = 0;
  foreach ($view->result as $count => $row) {
    $view->row_index = $count;
    $rendered_field = $raw_field = '';

    // Render field only if suggestion or dropdown item not in RAW format.
    if (!$use_raw_suggestion || !$use_raw_dropdown) {
      $rendered_field = $field->theme($row);
    }
    
    $dropdown = $use_raw_dropdown ? check_plain($row->{$field_alias}) : $rendered_field;
    if ($dropdown != '') {
      $suggestion = $use_raw_suggestion ? $row->{$field_alias} : decode_entities($rendered_field);

      // Add a class wrapper for a few required CSS overrides.
      $matches[$suggestion] = '<div class="reference-autocomplete">' . $dropdown . '</div>';
    }
  }
  unset($view->row_index);

  if (empty($matches)) {
    $matches[''] = '';
  }

  drupal_json($matches);
}