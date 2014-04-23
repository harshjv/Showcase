<?php

namespace Showcase;

class Showcase {

  public function markItDown($text) {
    $m = new Parsedown();
    return $m->text($text);
  }

}