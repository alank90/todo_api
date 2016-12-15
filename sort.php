<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
    $client_info = array(
    array (
	    "todo_id"  => "9489999",
	    "title"  => "test",
	    "due_date" => "12/08/2016",
	    "is_done"  => "false"
	),
	 array (
	    "todo_id"  => "9489999",
	    "title"  => "test",
	    "due_date" => "12/09/2016",
	    "is_done"  => "false"
	),
	array (
	    "todo_id"  => "3388899",
	    "title"  => "test6",
	    "due_date" => "01/03/2017",
	    "is_done"  => "true"
	),
	 array (
	    "todo_id"  => "9489999",
	    "title"  => "test",
	    "due_date" => "10/08/2016",
	    "is_done"  => "false"
	),
	array (
	    "todo_id"  => "8488899",
	    "title"  => "test1",
	    "due_date" => "12/02/2016",
	    "is_done"  => "true"
	),
	array (
	    "todo_id"  => "548798899",
	    "title"  => "test2",
	    "due_date" => "12/06/2016",
	    "is_done"  => "false"
	  ),
	  array (
	    "todo_id"  => "348798899",
	    "title"  => "test2",
	    "due_date" => "01/04/2016",
	    "is_done"  => "true"
	  ),
	   array (
	    "todo_id"  => "9489999",
	    "title"  => "test",
	    "due_date" => "11/22/2016",
	    "is_done"  => "false"
	)
	);
	
  function cmp($item1,$item2) {
      if ($item1['due_date'] == $item2['due_date']) return 0;
        return (strtotime($item1['due_date']) > strtotime($item2['due_date'])) ? 1 : -1;  //This is the ternary operator.
    }
  
usort($client_info, 'cmp');

//Now sort by is_done value.
 foreach ($client_info as $key => $value) {
      	if ($value['is_done']  == 'false') {
      		$temp = $client_info[$key];
      		unset($client_info[$key]);
			array_push($client_info, $temp);
      	}
 }

print_r($client_info);
	// Sort Array
   function cmp($item1,$item2) {
        if ($item1['due_date'] == $item2['due_date']) return 0;
        return (strtotime($item1['due_date']) > strtotime($item2['due_date'])) ? 1 : -1;  //This is the ternary operator.
    }
  
   usort($result['data'], 'cmp');
  
  /*Sort by is_done that works.
   foreach ($result['data'] as $idx => $arrayElement) {
    foreach ($arrayElement as $valueKey => $value) {
        if (($valueKey == 'is_done') && ($value == 'true')) {
            $temp = $arrayElement;
            //delete this particular object from the $array
            array_push($result['data'], $temp);
            unset($result['data'][$idx]);
        }
    }
}
   //Need to reindex array due to a bug in json_decode used later. non-sequential arrays
   //get converted to objects when json_decode is used.
   $result['data'] = array_values($result['data']);
	*/
	
	
?>
