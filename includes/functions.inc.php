<?php 


function format_html($str) {
  return htmlentities($str, ENT_COMPAT, 'UTF-8');
}


function format_ago($time, $ago = false) {
  $minute = 60;
  $hour   = $minute * 60;
  $day    = $hour   * 24;

  $when = $time;

  if ($when >= 0)
    $suffix = 'ago';
  else {
    $when = -$when;
    $suffix = 'in the future';
  }

  if ($when > $day) {
    $when = round($when / $day);
    $what = 'day';
  } else if ($when > $hour) {
    $when = round($when / $hour);
    $what = 'hour';
  } else if ($when > $minute) {
    $when = round($when / $minute);
    $what = 'minute';
  } else {
    $what = 'second';
  }

  if ($when != 1) $what .= 's';

  if ($ago) {
    return "$when $what $suffix";
  } else {
    return "$when $what";
  }
}


function format_size($size) {
  $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

  if ($size == 0) {
    return '0 B';
  } else {
    return round($size / pow(1024, ($i = floor(log($size, 1024)))), 1).' '.$sizes[$i];
  }
}


function str_rand($length) {
  $r = '';

  for (; $length > 0; --$length) {
    $r .= chr(rand(32, 126)); // 32 - 126 is the printable ascii range
  }

  return $r;
}

function merge_arrays($a,$b)
{
  $args=func_get_args();
  $res=array_shift($args);
  while(!empty($args))
  {
    $next=array_shift($args);
    foreach($next as $k => $v)
    {
      if(is_integer($k))
        isset($res[$k]) ? $res[]=$v : $res[$k]=$v;
      else if(is_array($v) && isset($res[$k]) && is_array($res[$k]))
        $res[$k]=merge_arrays($res[$k],$v);
      else
        $res[$k]=$v;
    }
  }
  return $res;
}