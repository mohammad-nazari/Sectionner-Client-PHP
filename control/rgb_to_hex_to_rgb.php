<?php
	function hex2rgb($hex)
	{
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3)
		{
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		}
		else
		{
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		$rgb = array($r, $g, $b);

		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}

	function rgb2hexIndexKey($rgb)
	{
		$hex = "#";
		$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

		return $hex; // returns the hex value including the number sign (#)
	}

	function rgb2hexStrKey($rgb)
	{
		$hex = "#";
		$hex .= str_pad($rgb['red'], 2, "0", STR_PAD_LEFT);
		$hex .= str_pad($rgb['green'], 2, "0", STR_PAD_LEFT);
		$hex .= str_pad($rgb['blue'], 2, "0", STR_PAD_LEFT);

		return $hex; // returns the hex value including the number sign (#)
	}

	function SetColorFilter($ImageFile, $ImageObject, $InputColor)
	{
		$imageSize = getimagesize($ImageFile);
		$w         = $imageSize[0];
		$h         = $imageSize[1];
		for($i = 0; $i < $w; $i++)
		{
			for($j = 0; $j < $h; $j++)
			{
				$color_index = imagecolorat($ImageObject, $i, $j);
				$c           = imagecolorsforindex($ImageObject, $color_index);

				//   [alpha] => 0
				$nPixelR = $c['red'] + hexdec($InputColor['red']);
				$nPixelG = $c['green'] + hexdec($InputColor['green']);
				$nPixelB = $c['blue'] + hexdec($InputColor['blue']);

				$nPixelR = Max($nPixelR, 0);
				$nPixelR = Min(255, $nPixelR);

				$nPixelG = Max($nPixelG, 0);
				$nPixelG = Min(255, $nPixelG);

				$nPixelB = Max($nPixelB, 0);
				$nPixelB = Min(255, $nPixelB);

				imagecolorset($ImageObject, $color_index, $nPixelR, $nPixelG, $nPixelB);
			}
		}

		return $ImageObject;
	}