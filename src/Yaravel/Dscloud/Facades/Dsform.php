<?php
namespace Yaravel\Dscloud\Facades;
use Illuminate\Support\Facades\Facade;

class DSF extends Facade {

    protected static function getFacadeAccessor() { return 'Dsform'; }
}
?>