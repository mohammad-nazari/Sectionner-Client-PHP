<?php
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 19/06/2016
	 * Time: 02:28 PM
	 */
	class ChartClass
	{
		/**
		 * @var array
		 */
		var $_dataSetColor = array();
		/**
		 * @var array
		 */
		var $_labels = array();

		/**
		 * @var array
		 */
		var $_data = array();
		/**
		 * @var string
		 */
		var $_dataLabels = array();

		/**
		 * ChartClass constructor.
		 */
		public function __construct()
		{
			$this->_labels = array("data1", "data2", "data3", "data4", "data5", "data6", "data7", "data8");
			$this->_data   = array(array(), array(), array(), array(), array(), array(), array(), array());
			for($j = 0; $j < 8; $j++)
			{
				$this->_dataSetColor[$j] = "rgba(" . ChartDataSetColor[$j]["red"] . "," . ChartDataSetColor[$j]["green"] . "," . ChartDataSetColor[$j]["blue"] . ",0.5)";
			}
		}

		/**
		 * @return array
		 */
		public function getDataSetColor()
		{
			return $this->_dataSetColor;
		}

		/**
		 * @param array $dataSetColor
		 */
		public function setDataSetColor($dataSetColor)
		{
			$this->_dataSetColor = $dataSetColor;
		}

		/**
		 * @return array
		 */
		public function getLabels()
		{
			return $this->_labels;
		}

		/**
		 * @param array $labels
		 */
		public function setLabels($labels)
		{
			$this->_labels = $labels;
		}

		/**
		 * @return mixed
		 */
		public function getData()
		{
			return $this->_data;
		}

		/**
		 * @param mixed $data
		 */
		public function setData($data)
		{
			$this->_data = $data;
		}
		
		/**
		 * @return mixed
		 */
		public function getDataLabels()
		{
			return $this->_dataLabels;
		}
		
		/**
		 * @param mixed $dataLabels
		 */
		public function setDataLabels($dataLabels)
		{
			$this->_dataLabels = $dataLabels;
		}

	}