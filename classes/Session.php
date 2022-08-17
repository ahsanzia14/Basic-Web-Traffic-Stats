<?php

class Session
{
  /**
   * @param null $name
   * @return null
   */
  public static function getSession($name = null)
  {
    if (!empty($name)) {
      return (isset($_SESSION[$name])) ? $_SESSION[$name] : null;
    }
    return null;
  }

  /**
   * @param null $name
   * @param null $value
   */
  public static function setSession($name = null, $value = null)
  {
    if (!empty($name) && !empty($value)) {
      $_SESSION[$name] = $value;
    }
  }

  /**
   * @param null $name
   */
  public static function clearSession($name = null)
  {
    if (!empty($name) && isset($_SESSION[$name])) {
      self::cleanSession($name);
    } else {
      session_destroy();
    }
  }

  public static function cleanSession($name = null)
  {
    if (isset($_SESSION[$name]) && !empty($name)) {
      $_SESSION[$name] = null;
      unset($_SESSION[$name]);
    }
  }
}
