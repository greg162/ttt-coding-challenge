<?php

namespace App\Helpers;

/*
 *  This class contains various utitlity functions.
*/

class Util {
  public static function escapeLike($str) {
      return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
  }
}