<?php
namespace application\plugin\git\model
{
	use application\plugin\mvcQuery\MvcQuery;
	
	class GitLog extends MvcQuery	
	{
		public $name		= 'git_log';
		public $primary		= array('id');
		public $primary_ai	= true;
		public $autoCreate	= false;
		
		public $columns = array
		(
			'id' => 'int(11) unsigned NOT NULL ' ,
			'hash' => 'varchar(64) NOT NULL ' ,
			'date' => 'int(11) unsigned NOT NULL' ,
			'user_name' => 'varchar(64) NOT NULL ' ,
			'message' => 'varchar(256) NOT NULL '
		);
	}
}