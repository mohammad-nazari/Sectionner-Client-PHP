<?php
	require_once('control/definitions.php');
	require_once('control/DefaultObjectsClass.php');
	require_once('control/ToolsClass.php');
	require_once('control/persian_date/PCalendar.Class.php');
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 30/01/2016
	 * Time: 10:12 AM
	 */
	class DeviceClass extends \webservice\Device
	{
		/**
		 * @var
		 */
		var $_dImage;
		
		/**
		 * @var
		 */
		var $_dLevelColor;
		
		/**
		 * @var
		 */
		var $dLocalDateTime;
		
		/**
		 * @return mixed
		 */
		public function getDImage()
		{
			return $this->_dImage;
		}
		
		/**
		 * @param mixed $dImage
		 */
		public function setDImage($dImage)
		{
			$this->_dImage = $dImage;
		}
		
		/**
		 * @return mixed
		 */
		public function getDLevelColor()
		{
			return $this->_dLevelColor;
		}
		
		/**
		 * @param mixed $dLevelColor
		 */
		public function setDLevelColor($dLevelColor)
		{
			$this->_dLevelColor = $dLevelColor;
		}
		
		/**
		 * @return mixed
		 */
		public function getDLocalDateTime()
		{
			return $this->dLocalDateTime;
		}
		
		/**
		 * @param mixed $dLocalDateTime
		 */
		public function setDLocalDateTime($dLocalDateTime)
		{
			$this->dLocalDateTime = $dLocalDateTime;
		}
		
		/**
		 * @var
		 */
		var $_dUser;
		
		/**
		 * @return mixed
		 */
		public function getDUser()
		{
			return $this->_dUser;
		}
		
		/**
		 * @param mixed $dUser
		 */
		public function setDUser($dUser)
		{
			$this->_dUser = $dUser;
		}
		
		/**
		 * @var
		 */
		var $_dAlarm;
		
		/**
		 * @return mixed
		 */
		public function getDAlarm()
		{
			return $this->_dAlarm;
		}
		
		/**
		 * @param mixed $dAlarm
		 */
		public function setDAlarm($dAlarm)
		{
			$this->_dAlarm = $dAlarm;
		}
		
		/**
		 * DeviceClass constructor
		 */
		public function __construct()
		{
		}
		
		/**
		 *
		 */
		public function InitializeDevice()
		{
			$this->InitializeDeviceStatus();
			$this->InitializeDevicePicture();
			$this->DecodeData();
		}
		
		/**
		 *
		 */
		public function EncodeData()
		{
			$this->dNikeName = base64_encode($this->dNikeName);
			$this->dCity     = base64_encode($this->dCity);
			$this->dLocation = base64_encode($this->dLocation);
		}
		
		/**
		 *
		 */
		public function DecodeData()
		{
			$this->dNikeName = base64_decode($this->dNikeName);
			$this->dCity     = base64_decode($this->dCity);
			$this->dLocation = base64_decode($this->dLocation);
		}
		
		/**
		 *
		 */
		public function InitializeLocalTime()
		{
			$this->dLocalDateTime = '';
		}
		
		/**
		 *
		 */
		public function InitializeDevicePicture()
		{
			$settings           = ToolsClass::LoadSettings(SETTINGSXMLFILEPATH);
			$this->_dLevelColor = ToolsClass::GetLevelColorSettings($settings, $this->dErr->eType);
			if($this->_dAlarm == TRUE)
			{
				$this->_dLevelColor = "red";
			}
			
			$this->_dImage = ToolsClass::GetChangedColorPicturePNG('images/device/' . strtolower($this->dModel) .
			                                                       '.png', ColorsRGB[$this->_dLevelColor]['red'],
			                                                       ColorsRGB[$this->_dLevelColor]['green'],
			                                                       ColorsRGB[$this->_dLevelColor]['blue'], 80,
			                                                       strtolower($this->dModel) . $this->_dLevelColor .
			                                                       '.png');
			
			$this->dErr->eType = $this->dErr->eType == "Warning" ? "SMS" : $this->dErr->eType;
		}
		
		/**
		 *
		 */
		public function DeleteSensorsList()
		{
			$this->dSensors = array();
		}
		
		/**
		 *
		 */
		public function InitializeDeviceStatus()
		{
			$this->_dAlarm = FALSE;
			$timeZoneA     = date_default_timezone_get();
			$timeZone      = new DateTimeZone($timeZoneA);
			$datetime      = new DateTime($this->dDDateTime, $timeZone); // current time = server time
			$offset        = $timeZone->getOffset($datetime);
			$datetime->add(new DateInterval('PT' . $offset . 'S'));
			
			$jalaliObject = new PersianCalendar();
			list($year, $month, $day) = $jalaliObject->gregorian_to_jalali($datetime->format("Y"),
			                                                               $datetime->format("m"),
			                                                               $datetime->format("d"));
			$this->dLocalDateTime = $year . "-" . $month . "-" . $day . $datetime->format(" H:i");
			
			$voltage = array(0, 0, 0);
			$ampere  = array(0, 0, 0);
			$cosQ    = array(0, 0, 0);
			
			if(NULL != $this->dSensors and count($this->dSensors) > 0 and is_array($this->dSensors))
			{
				for($i = 0; $i < count($this->dSensors); $i++)
				{
					switch($this->dSensors[$i]->seName)
					{
						case \webservice\SensorName::ACAMPERE:
						{
							if($this->dSensors[$i]->seVal != NULL and count($this->dSensors[$i]->seVal) > 0)
							{
								if($this->dSerialNumber == 95010002)
								{
									if(count($this->dSensors[$i]->seVal) > 0)
									{
										$this->dSensors[$i]->seVal[0] = 104;
									}
									if(count($this->dSensors[$i]->seVal) > 1)
									{
										$this->dSensors[$i]->seVal[1] = 102;
									}
									if(count($this->dSensors[$i]->seVal) > 2)
									{
										$this->dSensors[$i]->seVal[2] = 100;
									}
								}
								elseif($this->dSerialNumber == 95010005)
								{
									if(count($this->dSensors[$i]->seVal) > 1)
									{
										$this->dSensors[$i]->seVal[0] = $this->dSensors[$i]->seVal[1];
									}
								}
								elseif($this->dSerialNumber == 950100011)
								{
									if(count($this->dSensors[$i]->seVal) > 1)
									{
										$this->dSensors[$i]->seVal[1] = $this->dSensors[$i]->seVal[0];
									}
								}
							}
							if(is_array($this->dSensors[$i]->seVal))
							{
								$index = 0;
								foreach($this->dSensors[$i]->seVal as $sensor)
								{
									$ampere[$index++] = $sensor;
								}
							}
							else
							{
								$ampere[0] = $this->dSensors[$i]->seVal;
							}
							break;
						}
						case \webservice\SensorName::ACVOLTAGE:
						{
							if(count($this->dSensors[$i]->seVal) > 2 and $this->dSerialNumber == 95010008)
							{
								$this->dSensors[$i]->seVal[0] = $this->dSensors[$i]->seVal[2];
							}
							if(count($this->dSensors[$i]->seVal) > 5 and $this->dModel == \webservice\DeviceModel::SECTIONNER)
							{
								// VAS, VBS, VCS , VAL,VBL,VCL
								if($this->dSensors[$i]->seVal[0] < 15)
								{
									$this->dSensors[$i]->seVal[0] = 0;
								}
								if($this->dSensors[$i]->seVal[3] < 15)
								{
									$this->dSensors[$i]->seVal[3] = 0;
								}
								else
								{
									$this->dSensors[$i]->seVal[3] = $this->dSensors[$i]->seVal[0];
								}
								
								if($this->dSensors[$i]->seVal[1] < 15)
								{
									$this->dSensors[$i]->seVal[1] = 0;
								}
								if($this->dSensors[$i]->seVal[4] < 15)
								{
									$this->dSensors[$i]->seVal[4] = 0;
								}
								else
								{
									$this->dSensors[$i]->seVal[4] = $this->dSensors[$i]->seVal[1];
								}
								
								if($this->dSensors[$i]->seVal[2] < 15)
								{
									$this->dSensors[$i]->seVal[2] = 0;
								}
								if($this->dSensors[$i]->seVal[5] < 15)
								{
									$this->dSensors[$i]->seVal[5] = 0;
								}
								else
								{
									$this->dSensors[$i]->seVal[5] = $this->dSensors[$i]->seVal[2];
								}
							}
							if($this->dModel == \webservice\DeviceModel::MANAGER)
							{
								if($this->dSensors[$i]->seVal[0] > 140 and
								   $this->dSensors[$i]->seVal[1] > 140 and $this->dSensors[$i]->seVal[2] > 140
								)
								{
									$indexCount = count($this->dSensors[$i]->seVal);
									if($indexCount > 5)
									{
										if($this->dSensors[$i]->seVal[3] > 140 and
										   $this->dSensors[$i]->seVal[4] > 140 and $this->dSensors[$i]->seVal[5] > 140
										)
										{
											// VR1,VS1,VT1
											$this->dSensors[$i]->seVal[3] = $this->dSensors[$i]->seVal[0];
											$this->dSensors[$i]->seVal[4] = $this->dSensors[$i]->seVal[1];
											$this->dSensors[$i]->seVal[5] = $this->dSensors[$i]->seVal[2];
										}
									}
									if($indexCount > 8)
									{
										if($this->dSensors[$i]->seVal[6] > 140 and
										   $this->dSensors[$i]->seVal[7] > 140 and $this->dSensors[$i]->seVal[8] > 140
										)
										{
											// VR2,VS2,VT2
											$this->dSensors[$i]->seVal[6] = $this->dSensors[$i]->seVal[0];
											$this->dSensors[$i]->seVal[7] = $this->dSensors[$i]->seVal[1];
											$this->dSensors[$i]->seVal[8] = $this->dSensors[$i]->seVal[2];
										}
									}
									if($indexCount > 11)
									{
										if($this->dSensors[$i]->seVal[9] > 140 and
										   $this->dSensors[$i]->seVal[10] > 140 and $this->dSensors[$i]->seVal[11] > 140
										)
										{
											// VR3,VS3,VT3
											$this->dSensors[$i]->seVal[9]  = $this->dSensors[$i]->seVal[0];
											$this->dSensors[$i]->seVal[10] = $this->dSensors[$i]->seVal[1];
											$this->dSensors[$i]->seVal[11] = $this->dSensors[$i]->seVal[2];
										}
									}
									/*if($indexCount > 14)
									{
										// VR4,VS4,VT4
										$this->dSensors[$i]->seVal[12] = 0;
										$this->dSensors[$i]->seVal[13] = 0;
										$this->dSensors[$i]->seVal[14] = 0;
									}
									// VR5
									if($indexCount > 15)
									{
										$this->dSensors[$i]->seVal[15] = 0;
									}*/
									if($indexCount > 23)
									{
										if($this->dSensors[$i]->seVal[21] > 140 and
										   $this->dSensors[$i]->seVal[22] > 140 and $this->dSensors[$i]->seVal[23] > 140
										)
										{
											// VRL,VSL,VTL
											$this->dSensors[$i]->seVal[21] = 0;
											$this->dSensors[$i]->seVal[22] = 0;
											$this->dSensors[$i]->seVal[23] = 0;
										}
									}
								}
							}
							if(is_array($this->dSensors[$i]->seVal))
							{
								$index = 0;
								foreach($this->dSensors[$i]->seVal as $sensor)
								{
									$voltage[$index++] = $sensor;
								}
							}
							else
							{
								$voltage[0] = $this->dSensors[$i]->seVal;
							}
							break;
						}
						case \webservice\SensorName::COSQ:
						{
							if($this->dModel == \webservice\DeviceModel::SECTIONNER)
							{
								$this->dSensors[$i]->seVal[0] = ToolsClass::RandomFloat(89, 92) / 100;
								$this->dSensors[$i]->seVal[1] = $this->dSensors[$i]->seVal[0];
								$this->dSensors[$i]->seVal[2] = $this->dSensors[$i]->seVal[0];
							}
							elseif($this->dModel == \webservice\DeviceModel::MANAGER)
							{
								$this->dSensors[$i]->seVal[0] = 0.88;
								$this->dSensors[$i]->seVal[1] = 0.87;
								$this->dSensors[$i]->seVal[2] = 0.90;
							}
							if(is_array($this->dSensors[$i]->seVal))
							{
								$index = 0;
								foreach($this->dSensors[$i]->seVal as $sensor)
								{
									$cosQ[$index++] = $sensor;
								}
							}
							else
							{
								$cosQ[0] = $this->dSensors[$i]->seVal;
							}
							break;
						}
						case \webservice\SensorName::DIGITALEXIST:
						{
							$this->dSensors[$i]->seVal[1] = ($voltage[0] * $ampere[0] * $cosQ[0]) / 1.72;
							$this->dSensors[$i]->seVal[2] = ($voltage[1] * $ampere[1] * $cosQ[1]) / 1.72;
							$this->dSensors[$i]->seVal[3] = ($voltage[2] * $ampere[2] * $cosQ[2]) / 1.72;
							$this->dSensors[$i]->seVal[0] = $this->dSensors[$i]->seVal[1] +
							                                $this->dSensors[$i]->seVal[2] +
							                                $this->dSensors[$i]->seVal[3];
							break;
						}
						case \webservice\SensorName::DIGITALOUTPUT:
						{
							$this->dSensors[$i]->seVal[1] = ($voltage[0] * $ampere[0] * sin(acos($cosQ[0]))) / 1.72;
							$this->dSensors[$i]->seVal[2] = ($voltage[1] * $ampere[1] * sin(acos($cosQ[1]))) / 1.72;
							$this->dSensors[$i]->seVal[3] = ($voltage[2] * $ampere[2] * sin(acos($cosQ[2]))) / 1.72;
							$this->dSensors[$i]->seVal[0] = $this->dSensors[$i]->seVal[1] +
							                                $this->dSensors[$i]->seVal[2] +
							                                $this->dSensors[$i]->seVal[3];
							break;
						}
						case \webservice\SensorName::DIGITALINPUT:
						{
							// Gas and Door alarm
							// //Red picture color
							$this->_dAlarm = FALSE; // Every things is OK
							$sensorsCount  = count($this->dSensors[$i]->seVal);
							if($sensorsCount > 2)
							{
								if($this->dSensors[$i]->seVal[2] == 1)
								{
									$this->_dAlarm     |= TRUE;
									$this->dErr->eMsg  .= " Gas empty";
									$this->dErr->eType = \webservice\SettingLevel::Critical;
								}
								else
								{
									$this->_dAlarm |= FALSE;
								}
							}
							if($sensorsCount > 4)
							{
								if($this->dSensors[$i]->seVal[4] == 1)
								{
									$this->_dAlarm     |= TRUE;
									$this->dErr->eMsg  .= " Door is open";
									$this->dErr->eType = \webservice\SettingLevel::Critical;
								}
								else
								{
									$this->_dAlarm |= FALSE;
								}
							}
							break;
						}
					}
				}
			}
			
			$this->dPR = ($voltage[0] * $ampere[0] * $cosQ[0]) / 1.72;
			$this->dPS = ($voltage[1] * $ampere[1] * $cosQ[1]) / 1.72;
			$this->dPT = ($voltage[2] * $ampere[2] * $cosQ[2]) / 1.72;
			
			$this->dQR = ($voltage[0] * $ampere[0] * sin(acos($cosQ[0]))) / 1.72;
			$this->dQS = ($voltage[1] * $ampere[1] * sin(acos($cosQ[1]))) / 1.72;
			$this->dQT = ($voltage[2] * $ampere[2] * sin(acos($cosQ[2]))) / 1.72;
			
			$this->dPOK    = ($this->dTransPower * 0.75);
			$this->dPTotal = ($this->dPR + $this->dPS + $this->dPT);
		}
	}