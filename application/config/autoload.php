<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database','session', 'form_validation', 'encryption');

$autoload['drivers'] = array('cache');

$autoload['helper'] = array('array', 'url', 'form','security');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array();