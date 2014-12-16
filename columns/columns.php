<?php

/**
 * Columns Plugin
 *
 * @author Bastian Allgeier <bastian@getkirby.com>
 * @version 1.0.0
 */
kirbytext::$pre[] = function($kirbytext, $text) {
  
  $text = preg_replace_callback('!\(columns(…|\.{3})\)(.*)\((…|\.{3})columns\)!is', function($matches) use($kirbytext) {

    $content = $matches[2];
    $offset  = 0;
    $columns = preg_split('!\R\+{4}\s+\R!', $content);
    $html    = array();

    foreach($columns as $column) {
      $field = new Field($kirbytext->page, null, trim($column));
      $html[] = '<div class="' . c::get('columns.item', 'column') . '">' . kirbytext($field) . '</div>';
    }

    return '<div class="' . c::get('columns.container', 'columns') . ' ' . c::get('columns.container', 'columns') . '-' . count($columns) . '">' . implode($html) . '</div>';

  }, $text);

  return $text;

};