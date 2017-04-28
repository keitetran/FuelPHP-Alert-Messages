<?php

/**
 * FuelPHP Custom Messages
 * "MIT License"
 * @Copyright 2017 Keite Trần <anhtrn90@gmail.com>
 * @Author anhtn
 */

namespace Messages;

class Messages {

  /**
   *
   * @string Setting var
   */
  protected static $js_alert_plugin = 'default';
  protected static $js_message_sesion_name = 'js_message_sesion_name';
  protected static $default_message_session_name = 'default_message_session_name';

  /**
   * Supported message types
   */
  protected static $entries_types = array(
    'warning',
    'error',
    'info',
    'success',
    'danger',
    'js' // javascript mode only
  );

  /**
   *
   * @object Entries[]
   */
  protected static $entries = array();

  /**
   *
   * @object Entries_JS[]
   */
  protected static $entries_js = array();

  /**
   * Flag return when message print
   * @var boolean
   */
  protected static $flagError = false;

  /**
   * Load init config 
   */
  public static function _init() {
    \Config::load('messages', 'settings');
    static::$js_alert_plugin = \Config::get("settings.js_alert_plugin", static::$js_alert_plugin);
    static::$js_message_sesion_name = \Config::get("settings.js_message_sesion_name", static::$js_message_sesion_name);
    static::$default_message_session_name = \Config::get("settings.default_message_session_name", static::$default_message_session_name);
  }

  /**
   * Magic function called when adding messages via Messagess::info(...)
   * @param string $name
   * @param array(message content, title)
   */
  public static function __callStatic($name, $args) {
    // Soft name
    if ($name == 'error') {
      $name = 'danger';
    }

    // Message type error or danger will return false
    if ($name == 'danger') {
      self::$flagError = true;
    }

    $entry = (object) array(
              'type' => $name,
              'message' => $args[0],
              'title' => (!empty($args[1])) ? $args[1] : '',
    );

    // check type in array
    if (in_array($name, static::$entries_types)) {
      if ($name === 'js') {

        // group all entry to global var
        static::$entries_js[] = $entry;

        // set to sesion
        \Session::set_flash(static::$js_message_sesion_name, static::$entries_js);
      } else {
        // group all entry to global var
        static::$entries[] = $entry;

        // set to sesion
        \Session::set_flash(static::$default_message_session_name, static::$entries);
      }
    }

    // result callback TRUE || FALSE
    return self::$flagError;
  }

  /**
   * Get message from view using \Messages::get();
   * @param none
   * @return string HTML
   */
  public static function get() {
    $result = '';

    // HTML
    $entries = \Session::get_flash(static::$default_message_session_name);
    if (!empty($entries)) {
      $view = \View::forge('html', NULL, false);
      $view->set('entries', $entries);
      $result .= $view->render();
    }

    // Javascript
    $entriesjs = \Session::get_flash(static::$js_message_sesion_name);
    if (!empty($entriesjs)) {
      $view = \View::forge('js', null, false);
      $view->set('entries', $entriesjs);
      $view->set('js_alert_plugin', static::$js_alert_plugin);
      $result .= $view->render();
    }

    // Response html to view
    if (empty($result)) {
      return null;
    } else {
      return $result;
    }
  }

}
