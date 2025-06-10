<?php
function active_link($pattern)
{
  $url = $_SERVER['REQUEST_URI'];
  return strpos($url, $pattern) !== false
    ? 'bg-white text-green-700'
    : '';
}
