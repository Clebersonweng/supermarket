<?php

require 'app/bootstrap.php';
require 'app/config/Constants.php';

use Supermarket\App\{Router, Request};

Router::load('routes.php')->direct(Request::uri(), Request::method());