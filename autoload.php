<?php
function autoload($claseName){
    include 'controllers/' . $claseName .'.php';
}
spl_autoload_register('autoload');