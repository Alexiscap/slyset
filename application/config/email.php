<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Configuration EMAIL
  | -------------------------------------------------------------------------
 */

$config['protocol'] = 'smtp';
$config['validate'] = 'FALSE';
$config['smtp_host'] = 'localhost';
$config['mailtype'] = 'html';
$config['crlf'] = "\r\n";        // CHANGED FROM DEFAULTS

$config['newline'] = "\r\n";        // CHANGED FROM DEFAULTS
