<?php

$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

$uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/';

set_include_path($doc_root . $app_path);