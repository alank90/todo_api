<?php

class Todo
{
    private $_params;
    // A __construct is executed when the class is instantiated 
    public function __construct($params)
    {
        $this->_params = $params;
	}
     
    public function createAction()
{
    //create a new todo item
    $todo = new TodoItem();
    $todo->title = $this->_params['title'];
    $todo->description = $this->_params['description'];
    $todo->due_date = $this->_params['due_date'];
    $todo->is_done = 'false';
     
    //pass the user's username and password to authenticate the user
    $todo->save($this->_params['username'], $this->_params['userpass']);
     
    //return the todo item in array format
    return $todo->toArray();
}
     
    public function readAction()
    {
    	//Hard coded return. 
      //$readResult = array("todo_id"=>"1323343689","title"=>"test3 title","description"=>"test description","due_date"=>"","is_done"=>"false");
	  
	   //get the username/password hash
	   $user = $this->_params['username'];
	   $pswd = $this->_params['userpass'];
       $userhash = sha1("{$user}_{$pswd}");
	   if( is_dir(DATA_PATH . "/{$userhash}") === false ) {
             $readResult['data' ] = "Error. No such Directory.try again!!";
        }
	  
	  //$readResult['data' ] = "Error. try again!!";
	  return $readResult; 
	 
       //read all the todo items. 
     // $todo = new TodoItem();
	 
	   /* Assign the file contents and return to index.php $result['data']
	  $user_info = $todo->read($this->_params['username'], $this->_params['userpass']);
      return $user_info;
	 */
    }
  
    public function updateAction()
    {
        //update a todo item
    }
     
    public function deleteAction()
    {
        //delete a todo item
    }
}