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
    	//read all the todo items while passing the username and password to authenticate
    	//Note:the double colon, is a token that allows access to static, constant, and overridden 
    	//properties or methods of a class. Is equivalent to the -> token for objects.
		$todo_items = TodoItem::getAllItems($this->_params['username'], $this->_params['userpass']);
		
		//return the list
		return $todo_items;
    }
  
           //update a todo item
    public function updateAction()
    {
        //update a todo item
    $todo = new TodoItem();
	if (isset($this->_params['markasdone_button']))  {
	  	$todo->title = $this->_params['title'];
        $todo->description = $this->_params['description'];
        $todo->due_date = $this->_params['due_date'];
	    $todo->todo_id = $this->_params['todo_id'];
		$todo->is_done = 'true';
	}  
	else  {
       $todo->title = $this->_params['title'];
       $todo->description = $this->_params['description'];
       $todo->due_date = $this->_params['due_date'];
	   $todo->todo_id = $this->_params['todo_id'];
       $todo->is_done = 'false';
	}
	
    //pass the user's username and password to authenticate the user
    $todo->update($this->_params['username'], $this->_params['userpass']);
     
    //return the todo item in array format
    return $todo->toArray();
}
      
    public function deleteAction()
    {
        //delete a todo item
         $todo = new TodoItem();
		 $todo->todo_id = $this->_params['todo_id'];
		 
		 //pass the user's username and password to authenticate the user
         $todo->delete($this->_params['username'], $this->_params['userpass']);
    }
}