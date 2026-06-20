<?php

// Initialize session
require_once '../core/Helper.php';
Helper::initSession();

// Load Config & Core Framework files
require_once '../config/config.php';
require_once '../core/App.php';
require_once '../core/Controller.php';
require_once '../core/Database.php';

// Instantiate App
$app = new App();
