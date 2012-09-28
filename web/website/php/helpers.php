<?php
  # shuffle 2 arrays, keeping correspondence of elems
  function shuffle_unison(&$array1, &$array2) {
    // make and set seed
    $seed = make_seed();
    mt_srand($seed);
    // reorder arrays by same ordering
    $order1 = array_map(create_function('$val', 'return mt_rand();'), range(1, count($array1)));
    $order2 = $order1;
    array_multisort($order1, $array1);
    array_multisort($order2, $array2);
    mt_srand();
  }

  function make_seed()
  {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
  }

  // format 2d array to nested list string
  function array2stringList ($array) {
    $stringList = "";
    for ($i=0; $i < count($array); $i++) { 
      $sequence = $array[$i];
      $commaSeparated = implode(",", $sequence);
      $stringList .= $commaSeparated;
      if ($i < count($array)-1) {
        $stringList .= ",";
      }
    }
    return $stringList;
  }
  
  function splitDelimiterString($delimiterString, $delimiter, $nSplits) {
    $parts = explode($delimiter, $delimiterString);
    // chop ratings in two for separate seqs
    $seqRatings = array_chunk($parts, count($parts)/$nSplits);
    // form string again
    $strSplits = array();
    foreach ($seqRatings as $key => $value) {
      array_push($strSplits,implode($delimiter,$value));
    }
    return $strSplits;
  }
?>

