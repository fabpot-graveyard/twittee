<?php

class Container {
 protected $s=[];
 function __set($k, $c) { $this->s[$k]=$c; }
 function __get($k) { return $this->s[$k]($this); }
}
