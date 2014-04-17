<?php

namespace Showcase;

class Showcase {

  public function makeAuthorString($author) {
		$t = count($author);
		$i = 1;
		$string = "";
		foreach ($author as $a) {
			$string.=$a->name;
			if($i!=$t) {
				if($i==($t-1)) $string.=" &amp ";
				else $string.=", ";
			}
			$i++;
		}
		return $string;
	}

	public function inCart($editions, $edition_id) {
    $i=0;
		foreach($editions as $e) {
      if($e->id == $edition_id) return $i;
      $i++;
    }
    return false;
	}

}