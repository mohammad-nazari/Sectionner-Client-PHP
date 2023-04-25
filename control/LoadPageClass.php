<?php
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 27/01/2016
	 * Time: 02:33 PM
	 */
	class LoadPageClass
	{

		/**
		 * Load pages list in view directory
		 *
		 * @param $Directory
		 *
		 * @return array
		 */
		public static function GetPagesList($Directory)
		{
			$fileList = array();
			$files    = scandir($Directory);
			if(is_array($files) or is_object($files))
			{
				foreach($files as $file)
				{
					if($file != 'login' and $file != 'alldevices' and is_file($Directory . '/' . $file))
					{
						$fileList[$file] = $file;
					}
				}
			}

			return $fileList;
		}

		/**
		 * @param $PageName
		 *
		 * @return bool
		 */
		public static function LoadPage($PageName)
		{
			$PageName = $PageName . '.php';
			$pageList = self::GetPagesList('view');
			if(isset($pageList[$PageName]))
			{
				require_once('view/' . $pageList[$PageName]);

				return TRUE;
			}

			return FALSE;
		}
	}