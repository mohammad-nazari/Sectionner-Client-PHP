<?php
	require_once('control/rgb_to_hex_to_rgb.php');
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 30/01/2016
	 * Time: 12:09 PM
	 */
	class ToolsClass
	{
		/**
		 * @param $Settings
		 * @param $SensorName
		 *
		 * @return null
		 */
		public static function GetSensorSettings($Settings, $SensorName)
		{
			if(is_array($Settings->SensorsSetting) or is_object($Settings->SensorsSetting))
			{
				foreach($Settings->SensorsSetting as $sensor)
				{
					if($sensor->SensorName == $SensorName)
					{
						return $sensor;
					}
				}
			}
			
			return NULL;
		}
		
		/**
		 * @param $Settings
		 * @param $SensorName
		 *
		 * @return null
		 */
		public static function GetSensorMonoSettings($Settings, $SensorName)
		{
			if(is_array($Settings->SensorsSettingMono) or is_object($Settings->SensorsSettingMono))
			{
				foreach($Settings->SensorsSettingMono as $sensor)
				{
					if(strtoupper(trim($sensor->SensorName)) == strtoupper(trim($SensorName)))
					{
						return $sensor;
					}
					else
					{
					}
				}
			}
			
			return NULL;
		}
		
		/**
		 * @param $Settings
		 * @param $LevelName
		 *
		 * @return null
		 */
		public static function GetLevelColorSettings($Settings, $LevelName)
		{
			if(webservice\SettingLevel::Disable == $LevelName)
			{
				return "gray";
			}
			else if(webservice\SettingLevel::Normal == $LevelName)
			{
				return "green";
			}
			else if(webservice\SettingLevel::Warning == $LevelName)
			{
				return "yellow";
			}
			else
			{
				return "red";
			}
		}
		
		/**
		 * @param $FilePath
		 *
		 * @return SimpleXMLElement
		 */
		public static function LoadSettings($FilePath)
		{
			return simplexml_load_file($FilePath);
		}
		
		/**
		 * @param $PicturePath
		 * @param $Red
		 * @param $Green
		 * @param $Blue
		 * @param $Transparent
		 * @param $SavePath
		 *
		 * @return mixed
		 */
		public static function GetChangedColorPicturePNG($PicturePath, $Red, $Green, $Blue, $Transparent, $SavePath)
		{
			if(!file_exists($SavePath))
			{
				$image = imagecreatefrompng($PicturePath);
				
				imagefilter($image, IMG_FILTER_COLORIZE, $Red, $Green, $Blue, $Transparent);
				// make it blue!
				imagealphablending($image, FALSE);
				imagesavealpha($image, TRUE);
				imagepng($image, $SavePath);
			}
			
			return $SavePath;
		}
		
		/**
		 * @param      $ClassName
		 * @param bool $ScalarKey
		 * @param bool $ScalarValue
		 *
		 * @return array
		 */
		public static function GetClassConstArrayList($ClassName, $ScalarKey = FALSE, $ScalarValue = FALSE)
		{
			$objectArray = new ReflectionClass($ClassName);
			$objectArray = $objectArray->getConstants();
			
			$result = array();
			$index  = 0;
			if(is_array($objectArray) or is_object($objectArray))
			{
				foreach($objectArray as $objArrKey => $objArrVal)
				{
					// Return scalar kay and value
					if($ScalarKey == TRUE and $ScalarValue == TRUE)
					{
						$result[$index] = $index++;
					}
					elseif($ScalarKey == TRUE)
					{
						$result[$index++] = $objArrVal;
					}
					elseif($ScalarValue == TRUE)
					{
						$result[$objArrKey] = $index++;
					}
					else
					{
						$result[$objArrKey] = $objArrVal;
					}
				}
			}
			
			return $result;
		}
		
		/**
		 * @param $ParentObj
		 * @param $ChildObject
		 *
		 * @return mixed
		 */
		public static function LoadFromParentObj($ParentObj, $ChildObject)
		{
			$objValues = get_object_vars($ParentObj); // return array of object values
			if(is_array($objValues) or is_object($objValues))
			{
				foreach($objValues AS $key => $value)
				{
					$ChildObject->$key = $value;
				}
			}
			
			return $ChildObject;
		}
		
		/**
		 * @param $Objrct
		 *
		 * @return bool
		 */
		public static function IsArrayOrObject($Objrct)
		{
			return is_array($Objrct) or is_object($Objrct);
		}
		
		/**
		 * @param $Sensor
		 */
		public static function SetMonoValue($Sensor)
		{
			OnOff[$Sensor->sVal];
		}
		
		/**
		 * @param        $StartTime
		 * @param        $EndTime
		 * @param        $Period
		 * @param int    $Unit
		 *
		 * @return array
		 */
		public static function GetRangeOfTimesEP($StartTime, $EndTime, $Period, $Unit = 60)
		{
			$TimeArray = array();
			if($StartTime < $EndTime)
			{
				$temp1     = $StartTime;
				$StartTime = $EndTime;
				$EndTime   = $temp1;
			}
			
			$index               = 0;
			$temp                = date("H:i", $StartTime);
			$TimeArray[$index++] = $temp;
			
			$temp = date("H:i", strtotime($temp) + ($Period * $Unit));
			while($temp < $EndTime)
			{
				$TimeArray[$index++] = $temp;
				$temp                = date("H:i", strtotime($temp) + ($Period * $Unit));
			}
			
			return $TimeArray;
		}
		
		/**
		 * @param            $StartTime
		 * @param            $EndTime
		 * @param            $Counts
		 * @param int        $Unit
		 *
		 * @return array
		 */
		public static function GetRangeOfTimesEC($StartTime, $EndTime, $Counts, $Unit = 60)
		{
			$TimeArray = array();
			$index     = 0;
			if($StartTime < $EndTime)
			{
				$temp1     = $StartTime;
				$StartTime = $EndTime;
				$EndTime   = $temp1;
			}
			
			return $TimeArray;
		}
		
		/**
		 * @param            $StartTime
		 * @param            $Counts
		 * @param            $Period
		 * @param int        $Unit
		 *
		 * @return array
		 */
		public static function GetRangeOfTimesCP($StartTime, $Counts, $Period, $Unit = 1)
		{
			$TimeArray           = array();
			$index               = 0;
			$temp                = date("H:i:s", $StartTime);
			$TimeArray[$index++] = $temp;
			while($index < $Counts)
			{
				$temp                = date("H:i:s", strtotime($temp) + ($Period * $Unit));
				$TimeArray[$index++] = $temp;
			}
			
			return $TimeArray;
		}
		
		public static function printFloatWithLeadingZeros($num, $leadingZeros = 4, $precision = 2)
		{
			$decimalSeparator     = ".";
			$adjustedLeadingZeros = $leadingZeros + mb_strlen($decimalSeparator) + $precision;
			$pattern              = "%0{$adjustedLeadingZeros}{$decimalSeparator}{$precision}f";
			
			return sprintf($pattern, $num);
		}
		
		public static function RandomFloat($MinParam, $MaxParam)
		{   // auxiliary function
			// returns random number with flat distribution from 0 to 1
			return ((float)rand() % (float)($MaxParam - $MinParam)) + (float)$MinParam;
		}
	}

?>