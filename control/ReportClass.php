<?php
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 19/06/2016
	 * Time: 02:16 PM
	 */
	class ReportClass
	{
		/**
		 * @var int
		 */
		var $_recordsCount = 0;
		
		/**
		 * @var int
		 */
		var $_deviceModel = webservice\DeviceModel::SECTIONNER;
		
		/**
		 * @return int
		 */
		public function getRecordsCount()
		{
			return $this->_recordsCount;
		}
		
		/**
		 * @param int $recordsCount
		 */
		public function setRecordsCount($recordsCount)
		{
			$this->_recordsCount = $recordsCount;
		}
		
		/**
		 * @var array
		 *
		 * ACA[0-3],ACV[4-7],CosQ[8],TEM[9],HUM[10]
		 */
		var $_chartList = array();
		
		/**
		 * @var string
		 */
		var $_labels = "";
		
		/**
		 * @return string
		 */
		public function getLabels()
		{
			return $this->_labels;
		}
		
		/**
		 * @param string $labels
		 */
		public function setLabels($labels)
		{
			$this->_labels = $labels;
		}
		
		/**
		 * @return array
		 */
		public function getChartList()
		{
			return $this->_chartList;
		}
		
		/**
		 * @param array $chartList
		 */
		public function setChartList($chartList)
		{
			$this->_chartList = $chartList;
		}
		
		
		/**
		 * ReportClass constructor.
		 */
		public function __construct()
		{
			$this->_chartList = array(\webservice\SensorName::ACVOLTAGE     => array(new ChartClass(), new ChartClass(),
			                                                                         new ChartClass(),
			                                                                         new ChartClass()),
			                          \webservice\SensorName::ACAMPERE      => array(new ChartClass(), new ChartClass(),
			                                                                         new ChartClass(),
			                                                                         new ChartClass()),
			                          \webservice\SensorName::COSQ          => array(new ChartClass()),
			                          \webservice\SensorName::DIGITALEXIST  => array(new ChartClass()),
			                          \webservice\SensorName::DIGITALOUTPUT => array(new ChartClass()),
			                          \webservice\SensorName::TEMPERATURE   => array(new ChartClass()),
			                          \webservice\SensorName::HUMIDITY      => array(new ChartClass()));
		}
		
		/**
		 * @param $Report
		 */
		public function GenerateReportCharts($Report)
		{
			$this->_dataLabels = "";
			//$Report          = DefaultObjectsClass::NewDeviceStatusLogList();
			foreach($Report->dsllStatus as $reportLog)
			{
				$device = new  DeviceClass();
				$device = ToolsClass::LoadFromParentObj($reportLog->dslDevice, $device);
				$device->InitializeDevice();
				$reportLog->dslDevice = $device;
				
				$localUTCTime = new DateTime($reportLog->dslDateTime, new DateTimeZone('UTC'));
				$localUTCTime->setTimeZone(new DateTimeZone('Asia/Tehran'));
				$localUTCTime->sub(new DateInterval('PT1H'));
				
				$jalaliObject = new PersianCalendar();
				list($year, $month, $day)
					= $jalaliObject->gregorian_to_jalali($localUTCTime->format("Y"),
					                                     $localUTCTime->format("m"),
					                                     $localUTCTime->format("d"));
				$localTime = $year . "-" . $month . "-" . $day .
				             $localUTCTime->format(" H:i");
				
				foreach($reportLog->dslDevice->dSensors as $sensorEx)
				{
					if($sensorEx->seName != \webservice\SensorName::RELAY and
					   $sensorEx->seName != \webservice\SensorName::DIGITALINPUT
					)
					{
						$this->GenerateChartData($sensorEx->seVal, $sensorEx->seName,
						                         ChartRowsColumns[$sensorEx->seName][0],
						                         ChartRowsColumns[$sensorEx->seName][1], $localTime);
					}
				}
			}
			if($Report->dsllStatus[0]->dslDevice != NULL and
			   $Report->dsllStatus[0]->dslDevice->dModel != NULL and
			   $Report->dsllStatus[0]->dslDevice->dModel == webservice\DeviceModel::SECTIONNER
			)
			{
				$this->_deviceModel = webservice\DeviceModel::SECTIONNER;
				$this->GenerateChartLabel("acvs", \webservice\SensorName::ACVOLTAGE, 0, 6);
				$this->GenerateChartLabel("acas", \webservice\SensorName::ACAMPERE, 0, 3);
				$this->GenerateChartLabel("cosqs", \webservice\SensorName::COSQ, 0, 3);
				$this->GenerateChartLabel("powers", \webservice\SensorName::DIGITALEXIST, 0, 4);
				$this->GenerateChartLabel("reactives", \webservice\SensorName::DIGITALOUTPUT, 0, 4);
			}
			else
			{
				$this->_deviceModel = webservice\DeviceModel::MANAGER;
				for($i = 0; $i < 4; $i++)
				{
					$this->GenerateChartLabel("acvm", \webservice\SensorName::ACVOLTAGE, $i, 6);
					$this->GenerateChartLabel("acam", \webservice\SensorName::ACAMPERE, $i, 8);
				}
				$this->GenerateChartLabel("cosqm", \webservice\SensorName::COSQ, 0, 3);
				$this->GenerateChartLabel("temm", \webservice\SensorName::TEMPERATURE, 0, 4);
				$this->GenerateChartLabel("humm", \webservice\SensorName::HUMIDITY, 0, 4);
				$this->_recordsCount = count($this->_chartList);
			}
			$this->_recordsCount = count($this->_chartList);
		}
		
		/**
		 * @param $Prefix
		 * @param $ChartName
		 * @param $Index
		 * @param $Rows
		 */
		public function GenerateChartLabel($Prefix, $ChartName, $Index, $Rows)
		{
			for($i = 0; $i < $Rows; $i++)
			{
				$this->_chartList[$ChartName][$Index]->_labels[$i] = $Prefix . (($Index * $Rows) + ($i + 1));
			}
		}
		
		/**
		 * @param $sensors
		 * @param $SensorType
		 * @param $Rows
		 * @param $Cols
		 * @param $LocalTime
		 */
		public function GenerateChartData($sensors, $SensorType, $Rows, $Cols, $LocalTime)
		{
			$sensorsCount = count($sensors);
			
			for($i = 0; $i < $Cols; $i++)
			{
				array_push($this->_chartList[$SensorType][$i]->_dataLabels, $LocalTime);
				for($j = 0; $j < $Rows; $j++)
				{
					$index       = (($i * $Rows) + ($j + 1));
					$sensorValue = 0;
					
					if($sensorsCount >= $index)
					{
						if($sensorsCount == 1)
						{
							$sensorValue = $sensors;
						}
						else
						{
							$sensorValue = $sensors[$index - 1];
						}
						if($sensorValue < -50)
						{
							$sensorValue = 0;
						}
					}
					array_push($this->_chartList[$SensorType][$i]->_data[$j], round($sensorValue, 2));
				}
			}
		}
	}