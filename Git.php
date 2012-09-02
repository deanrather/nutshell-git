<?php
namespace application\plugin\git
{
	use nutshell\Nutshell;
	use nutshell\behaviour\Singleton;
	use nutshell\core\plugin\Plugin;
	use application\plugin\git\GitException;
	use application\plugin\git\model\GitLog;
	use application\plugin\git\model\GitVersion;
	
	class Git extends Plugin implements Singleton
	{
		private static $logModel = null;
		private static $versionModel = null;
		
		private static $typeMap = array
		(
			'fix'		=> 'BUGFIX',
			'refactor'	=> 'CHANGE',
			'feature'	=> 'NEW FEATURE'
		);
		
		public function init()
		{
			require_once(__DIR__._DS_.'GitException.php');
			
			require_once(NS_HOME._DS_.'plugin'._DS_.'mvc'._DS_.'MvcConnect.php');
			require_once(NS_HOME._DS_.'plugin'._DS_.'mvc'._DS_.'Model.php');
			
			$this->plugin->MvcQuery();
			require_once(__DIR__._DS_.'model'._DS_.'GitLog.php');
			require_once(__DIR__._DS_.'model'._DS_.'GitVersion.php');
			
			self::$logModel = new GitLog();
			self::$versionModel = new GitVersion();
		}
		
		public function getVersion()
		{
			$date = self::$versionModel->read(array(), array('date'), 'ORDER BY date DESC LIMIT 1');
			$date = $date[0]['date'];
			$date = self::formatVersionName($date);
			return $date;
		}
		
		public function getLogView()
		{
			$logs = self::$logModel->read(array(), array(), 'ORDER BY date DESC');
			$versionDates = self::$versionModel->read(array(), array('date'), 'ORDER BY date DESC');
			$versionIndex = 0;
			
			$versions = array();
			
			$version = array();
			$version['date'] = $versionDates[$versionIndex++]['date'];
			$version['name'] = self::formatVersionName($version['date']);
			$version['logs'] = array();
			$nextVersionDate = $versionDates[$versionIndex++]['date'];
			
			foreach($logs as $log)
			{
				$log['author'] = $log['user_name'];
				$log['type'] = self::getType($log['message']);
				$log['datetime'] = self::formatDateTime($log['date']);
				
				if($log['date'] < $nextVersionDate)
				{
					$versions[] = $version;
					$version = array();
					$version['date'] = $log['date'];
					$version['name'] = self::formatVersionName($version['date']);
					$version['logs'] = array();
					if(isset($versionDates[$versionIndex]))
					{
						$nextVersionDate = $versionDates[$versionIndex]['date'];
						$versionIndex++;
					}
					else
					{
						$nextVersionDate = 0;
					}
				}
				$version['logs'][] = $log;
			}
			$versions[] = $version;
			
			return $versions;
			
			// $template = $this->plugin->Template(__DIR__._DS_.'view'._DS_.'versions.php');
			// $template->setKeyVal('versions', $versions);
			// $template->compile();
			// $html = $template->getCompiled();
			
			// return $html;
		}
		
		public static function formatVersionName($date)
		{
			return date('Y-m-d', $date);
		}
		
		public static function formatDateTime($date)
		{
			return date('g:ia d/m', $date);
		}
		
		public static function getType($message)
		{
			$message = strtolower($message);
			foreach(self::$typeMap as $keyword => $type)
			{
				if(stristr($message, "#$keyword")) return $type;
			}
			return '';
		}
	}
}
