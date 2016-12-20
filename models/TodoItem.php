<?php

    class TodoItem
{
    public $todo_id;
    public $title;
    public $description;
    public $due_date;
    public $is_done;
   
   // ======================================================================================== 	
    public function save($username, $userpass)
    {
        //get the username/password hash
        $userhash = sha1("{$username}_{$userpass}");
        if( is_dir(DATA_PATH . "/{$userhash}") === false ) {
            mkdir(DATA_PATH . "/{$userhash}");
        }
         
        //if the $todo_id isn't set yet, it means we need to create a new todo item
        if( is_null($this->todo_id) || !is_numeric($this->todo_id) ) {
            //the todo id is the current time
            $this->todo_id = time();
        }
         
        //get the array version of this todo item
        $todo_item_array = $this->toArray();
      
        //save the serialized array version into a file
        $success = file_put_contents(DATA_PATH . "/{$userhash}/{$this->todo_id}.txt", serialize($todo_item_array));
         
        //if saving was not successful, throw an exception
        if( $success === false ) {
            throw new Exception('Failed to save todo item');
        }
         
        //return the array version
        return $todo_item_array;
    }
 // =============================================================================================

 
 /*===========  New Read Method ==================================================================
 DirectoryIterator is a Standard PHP Library (SPL) collection of 
 interfaces and classes that are meant to solve common problems. 
 See http://php.net/manual/en/class.directoryiterator.php */

/* Note: Declaring class properties or methods as static makes them 
    accessible without needing an instantiation of the class. */
  
  public static function getAllItems($username, $userpass)
	{
		$user_check = self::_checkIfUserExists($username, $userpass);
		if (!$user_check) {
			$todo_items[] = array( 'todo_id' => "1234567");
			return $todo_items;
			exit;
		}
		
		$userhash = sha1("{$username}_{$userpass}");
		$todo_items = array();
		foreach( new DirectoryIterator(DATA_PATH . "/{$userhash}") as $file_info ) {
			if( $file_info->isFile() == true ) {
				$todo_item_serialized = file_get_contents($file_info->getPathname());
				$todo_item_array = unserialize($todo_item_serialized);
				$todo_items[] = $todo_item_array;
			}
		}
		
		return $todo_items;
	}
	// ===========================================================================================
	
	
	// ===========================================================================================
	 public function update($username, $userpass)
    {
        //get the username/password hash
        $userhash = sha1("{$username}_{$userpass}");
                 
        //if the $todo_id isn't set yet throw an error
        if( is_null($this->todo_id) || !is_numeric($this->todo_id) ) {
            //File Doesn't exist
            throw new Exception('Error. No such todo item exists.');
        }
         
        //get the array version of this todo item
        $todo_item_array = $this->toArray();
      
        //write the updated serialized array version into existing file
        $success = file_put_contents(DATA_PATH . "/{$userhash}/{$this->todo_id}.txt", serialize($todo_item_array));
         
        //if saving was not successful, throw an exception
        if( $success === false ) {
            throw new Exception('Warning! Failed to update todo item');
        }
         
        //return the array version
        return $todo_item_array;
    }
	// ==============================================================================================
	
	// ==============================================================================================
	public function delete($username, $userpass)
    {
        //get the username/password hash
        $userhash = sha1("{$username}_{$userpass}");
		$success = unlink(DATA_PATH . "/{$userhash}/{$this->todo_id}.txt");
	     //if delete not succesfull, throw an exception
        if( $success === false ) {
            throw new Exception('Warning! Delete Unsuccessful!');
        }	
	}
 // =================================================================================================
  
 // =================================================================================================
public static function sortArray($arrayItem) 
{
		// Sort Array
   function cmp($item1,$item2) {
        if ($item1['due_date'] == $item2['due_date']) return 0;
        return (strtotime($item1['due_date']) > strtotime($item2['due_date'])) ? 1 : -1;  //This is the ternary operator.
    }
  
   usort($arrayItem, 'cmp');
  
  //Sort by is_done
   foreach ($arrayItem as $idx => $arrayElement) {
    foreach ($arrayElement as $valueKey => $value) {
        if (($valueKey == 'is_done') && ($value == 'true')) {
            $temp = $arrayElement;
            array_push($arrayItem, $temp); //Push item to end of array
             //delete this item from the $array
            unset($arrayItem[$idx]);
         }
      }
    }
   /*Need to reindex array due to a bug in json_decode used later. non-sequential arrays
     get converted to objects when json_decode is used. */
   $arrayItem = array_values( $arrayItem);
   return $arrayItem;
}
// ====================================================================================================

// ====================================================================================================
    public function toArray()   
    {
        //return an array version of the todo item
        return array(
            'todo_id' => $this->todo_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'is_done' => $this->is_done
		 );
	}
  // ======================================================================================================
  
  // ======================================================================================================
  private static function _checkIfUserExists($username, $userpass)  {
		$userhash = sha1(	"{$username}_{$userpass}");
		if( is_dir(DATA_PATH . "/{$userhash}") === false ) {
			mkdir(DATA_PATH . "/{$userhash}");
			//throw new Exception('Username  or Password is invalid');
		      return false;
		} elseif  (count(glob(DATA_PATH . "/{$userhash}/*")) === 0 ) {
			return false;
		} else {
			 return true;
		}
	}
 	
}  // End Class definition

 