<?php
namespace application\plugin\git\model
{
	use application\plugin\mvcQuery\MvcQuery;
	
	class GitVersion extends MvcQuery	
	{
		public $name		= 'git_version';
		public $primary		= array('id');
		public $primary_ai	= true;
		public $autoCreate	= false;
		
		public $columns = array
		(
			'id' => 'int(11) unsigned NOT NULL ' ,
			'date' => 'int(11) unsigned NOT NULL'
		);
	}
}