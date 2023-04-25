<?php
	/**
	 * Created by PhpStorm.
	 * User: mohammad
	 * Date: 1/4/2015
	 * Time: 11:34 PM
	 */
	
	
	/* HTML color values and names */
	const ColorsRGB
	= array(
		//  Colors  as  they  are  defined  in  HTML  3.2
		"black"                => array("red" => 0x00, "green" => 0x00, "blue" => 0x00),
		"maroon"               => array("red" => 0x80, "green" => 0x00, "blue" => 0x00),
		"green"                => array("red" => 0x00, "green" => 0x80, "blue" => 0x00),
		"olive"                => array("red" => 0x80, "green" => 0x80, "blue" => 0x00),
		"navy"                 => array("red" => 0x00, "green" => 0x00, "blue" => 0x80),
		"purple"               => array("red" => 0x80, "green" => 0x00, "blue" => 0x80),
		"teal"                 => array("red" => 0x00, "green" => 0x80, "blue" => 0x80),
		"gray"                 => array("red" => 0x80, "green" => 0x80, "blue" => 0x80),
		"silver"               => array("red" => 0xC0, "green" => 0xC0, "blue" => 0xC0),
		"red"                  => array("red" => 0xFF, "green" => 0x00, "blue" => 0x00),
		"lime"                 => array("red" => 0x00, "green" => 0xFF, "blue" => 0x00),
		"yellow"               => array("red" => 0xFF, "green" => 0xFF, "blue" => 0x00),
		"blue"                 => array("red" => 0x00, "green" => 0x00, "blue" => 0xFF),
		"fuchsia"              => array("red" => 0xFF, "green" => 0x00, "blue" => 0xFF),
		"aqua"                 => array("red" => 0x00, "green" => 0xFF, "blue" => 0xFF),
		"white"                => array("red" => 0xFF, "green" => 0xFF, "blue" => 0xFF),
		
		//  Additional  colors  as  they  are  used  by  Netscape  and  IE
		"aliceblue"            => array("red" => 0xF0, "green" => 0xF8, "blue" => 0xFF),
		"antiquewhite"         => array("red" => 0xFA, "green" => 0xEB, "blue" => 0xD7),
		"aquamarine"           => array("red" => 0x7F, "green" => 0xFF, "blue" => 0xD4),
		"azure"                => array("red" => 0xF0, "green" => 0xFF, "blue" => 0xFF),
		"beige"                => array("red" => 0xF5, "green" => 0xF5, "blue" => 0xDC),
		"blueviolet"           => array("red" => 0x8A, "green" => 0x2B, "blue" => 0xE2),
		"brown"                => array("red" => 0xA5, "green" => 0x2A, "blue" => 0x2A),
		"burlywood"            => array("red" => 0xDE, "green" => 0xB8, "blue" => 0x87),
		"cadetblue"            => array("red" => 0x5F, "green" => 0x9E, "blue" => 0xA0),
		"chartreuse"           => array("red" => 0x7F, "green" => 0xFF, "blue" => 0x00),
		"chocolate"            => array("red" => 0xD2, "green" => 0x69, "blue" => 0x1E),
		"coral"                => array("red" => 0xFF, "green" => 0x7F, "blue" => 0x50),
		"cornflowerblue"       => array("red" => 0x64, "green" => 0x95, "blue" => 0xED),
		"cornsilk"             => array("red" => 0xFF, "green" => 0xF8, "blue" => 0xDC),
		"crimson"              => array("red" => 0xDC, "green" => 0x14, "blue" => 0x3C),
		"darkblue"             => array("red" => 0x00, "green" => 0x00, "blue" => 0x8B),
		"darkcyan"             => array("red" => 0x00, "green" => 0x8B, "blue" => 0x8B),
		"darkgoldenrod"        => array("red" => 0xB8, "green" => 0x86, "blue" => 0x0B),
		"darkgray"             => array("red" => 0xA9, "green" => 0xA9, "blue" => 0xA9),
		"darkgreen"            => array("red" => 0x00, "green" => 0x64, "blue" => 0x00),
		"darkkhaki"            => array("red" => 0xBD, "green" => 0xB7, "blue" => 0x6B),
		"darkmagenta"          => array("red" => 0x8B, "green" => 0x00, "blue" => 0x8B),
		"darkolivegreen"       => array("red" => 0x55, "green" => 0x6B, "blue" => 0x2F),
		"darkorange"           => array("red" => 0xFF, "green" => 0x8C, "blue" => 0x00),
		"darkorchid"           => array("red" => 0x99, "green" => 0x32, "blue" => 0xCC),
		"darkred"              => array("red" => 0x8B, "green" => 0x00, "blue" => 0x00),
		"darksalmon"           => array("red" => 0xE9, "green" => 0x96, "blue" => 0x7A),
		"darkseagreen"         => array("red" => 0x8F, "green" => 0xBC, "blue" => 0x8F),
		"darkslateblue"        => array("red" => 0x48, "green" => 0x3D, "blue" => 0x8B),
		"darkslategray"        => array("red" => 0x2F, "green" => 0x4F, "blue" => 0x4F),
		"darkturquoise"        => array("red" => 0x00, "green" => 0xCE, "blue" => 0xD1),
		"darkviolet"           => array("red" => 0x94, "green" => 0x00, "blue" => 0xD3),
		"deeppink"             => array("red" => 0xFF, "green" => 0x14, "blue" => 0x93),
		"deepskyblue"          => array("red" => 0x00, "green" => 0xBF, "blue" => 0xFF),
		"dimgray"              => array("red" => 0x69, "green" => 0x69, "blue" => 0x69),
		"dodgerblue"           => array("red" => 0x1E, "green" => 0x90, "blue" => 0xFF),
		"firebrick"            => array("red" => 0xB2, "green" => 0x22, "blue" => 0x22),
		"floralwhite"          => array("red" => 0xFF, "green" => 0xFA, "blue" => 0xF0),
		"forestgreen"          => array("red" => 0x22, "green" => 0x8B, "blue" => 0x22),
		"gainsboro"            => array("red" => 0xDC, "green" => 0xDC, "blue" => 0xDC),
		"ghostwhite"           => array("red" => 0xF8, "green" => 0xF8, "blue" => 0xFF),
		"gold"                 => array("red" => 0xFF, "green" => 0xD7, "blue" => 0x00),
		"goldenrod"            => array("red" => 0xDA, "green" => 0xA5, "blue" => 0x20),
		"greenyellow"          => array("red" => 0xAD, "green" => 0xFF, "blue" => 0x2F),
		"honeydew"             => array("red" => 0xF0, "green" => 0xFF, "blue" => 0xF0),
		"hotpink"              => array("red" => 0xFF, "green" => 0x69, "blue" => 0xB4),
		"indianred"            => array("red" => 0xCD, "green" => 0x5C, "blue" => 0x5C),
		"indigo"               => array("red" => 0x4B, "green" => 0x00, "blue" => 0x82),
		"ivory"                => array("red" => 0xFF, "green" => 0xFF, "blue" => 0xF0),
		"khaki"                => array("red" => 0xF0, "green" => 0xE6, "blue" => 0x8C),
		"lavender"             => array("red" => 0xE6, "green" => 0xE6, "blue" => 0xFA),
		"lavenderblush"        => array("red" => 0xFF, "green" => 0xF0, "blue" => 0xF5),
		"lawngreen"            => array("red" => 0x7C, "green" => 0xFC, "blue" => 0x00),
		"lemonchiffon"         => array("red" => 0xFF, "green" => 0xFA, "blue" => 0xCD),
		"lightblue"            => array("red" => 0xAD, "green" => 0xD8, "blue" => 0xE6),
		"lightcoral"           => array("red" => 0xF0, "green" => 0x80, "blue" => 0x80),
		"lightcyan"            => array("red" => 0xE0, "green" => 0xFF, "blue" => 0xFF),
		"lightgoldenrodyellow" => array("red" => 0xFA, "green" => 0xFA, "blue" => 0xD2),
		"lightgreen"           => array("red" => 0x90, "green" => 0xEE, "blue" => 0x90),
		"lightgrey"            => array("red" => 0xD3, "green" => 0xD3, "blue" => 0xD3),
		"lightpink"            => array("red" => 0xFF, "green" => 0xB6, "blue" => 0xC1),
		"lightsalmon"          => array("red" => 0xFF, "green" => 0xA0, "blue" => 0x7A),
		"lightseagreen"        => array("red" => 0x20, "green" => 0xB2, "blue" => 0xAA),
		"lightskyblue"         => array("red" => 0x87, "green" => 0xCE, "blue" => 0xFA),
		"lightslategray"       => array("red" => 0x77, "green" => 0x88, "blue" => 0x99),
		"lightsteelblue"       => array("red" => 0xB0, "green" => 0xC4, "blue" => 0xDE),
		"lightyellow"          => array("red" => 0xFF, "green" => 0xFF, "blue" => 0xE0),
		"limegreen"            => array("red" => 0x32, "green" => 0xCD, "blue" => 0x32),
		"linen"                => array("red" => 0xFA, "green" => 0xF0, "blue" => 0xE6),
		"mediumaquamarine"     => array("red" => 0x66, "green" => 0xCD, "blue" => 0xAA),
		"mediumblue"           => array("red" => 0x00, "green" => 0x00, "blue" => 0xCD),
		"mediumorchid"         => array("red" => 0xBA, "green" => 0x55, "blue" => 0xD3),
		"mediumpurple"         => array("red" => 0x93, "green" => 0x70, "blue" => 0xD0),
		"mediumseagreen"       => array("red" => 0x3C, "green" => 0xB3, "blue" => 0x71),
		"mediumslateblue"      => array("red" => 0x7B, "green" => 0x68, "blue" => 0xEE),
		"mediumspringgreen"    => array("red" => 0x00, "green" => 0xFA, "blue" => 0x9A),
		"mediumturquoise"      => array("red" => 0x48, "green" => 0xD1, "blue" => 0xCC),
		"mediumvioletred"      => array("red" => 0xC7, "green" => 0x15, "blue" => 0x85),
		"midnightblue"         => array("red" => 0x19, "green" => 0x19, "blue" => 0x70),
		"mintcream"            => array("red" => 0xF5, "green" => 0xFF, "blue" => 0xFA),
		"mistyrose"            => array("red" => 0xFF, "green" => 0xE4, "blue" => 0xE1),
		"moccasin"             => array("red" => 0xFF, "green" => 0xE4, "blue" => 0xB5),
		"navajowhite"          => array("red" => 0xFF, "green" => 0xDE, "blue" => 0xAD),
		"oldlace"              => array("red" => 0xFD, "green" => 0xF5, "blue" => 0xE6),
		"olivedrab"            => array("red" => 0x6B, "green" => 0x8E, "blue" => 0x23),
		"orange"               => array("red" => 0xFF, "green" => 0xA5, "blue" => 0x00),
		"orangered"            => array("red" => 0xFF, "green" => 0x45, "blue" => 0x00),
		"orchid"               => array("red" => 0xDA, "green" => 0x70, "blue" => 0xD6),
		"palegoldenrod"        => array("red" => 0xEE, "green" => 0xE8, "blue" => 0xAA),
		"palegreen"            => array("red" => 0x98, "green" => 0xFB, "blue" => 0x98),
		"paleturquoise"        => array("red" => 0xAF, "green" => 0xEE, "blue" => 0xEE),
		"palevioletred"        => array("red" => 0xDB, "green" => 0x70, "blue" => 0x93),
		"papayawhip"           => array("red" => 0xFF, "green" => 0xEF, "blue" => 0xD5),
		"peachpuff"            => array("red" => 0xFF, "green" => 0xDA, "blue" => 0xB9),
		"peru"                 => array("red" => 0xCD, "green" => 0x85, "blue" => 0x3F),
		"pink"                 => array("red" => 0xFF, "green" => 0xC0, "blue" => 0xCB),
		"plum"                 => array("red" => 0xDD, "green" => 0xA0, "blue" => 0xDD),
		"powderblue"           => array("red" => 0xB0, "green" => 0xE0, "blue" => 0xE6),
		"rosybrown"            => array("red" => 0xBC, "green" => 0x8F, "blue" => 0x8F),
		"royalblue"            => array("red" => 0x41, "green" => 0x69, "blue" => 0xE1),
		"saddlebrown"          => array("red" => 0x8B, "green" => 0x45, "blue" => 0x13),
		"salmon"               => array("red" => 0xFA, "green" => 0x80, "blue" => 0x72),
		"sandybrown"           => array("red" => 0xF4, "green" => 0xA4, "blue" => 0x60),
		"seagreen"             => array("red" => 0x2E, "green" => 0x8B, "blue" => 0x57),
		"seashell"             => array("red" => 0xFF, "green" => 0xF5, "blue" => 0xEE),
		"sienna"               => array("red" => 0xA0, "green" => 0x52, "blue" => 0x2D),
		"skyblue"              => array("red" => 0x87, "green" => 0xCE, "blue" => 0xEB),
		"slateblue"            => array("red" => 0x6A, "green" => 0x5A, "blue" => 0xCD),
		"slategray"            => array("red" => 0x70, "green" => 0x80, "blue" => 0x90),
		"snow"                 => array("red" => 0xFF, "green" => 0xFA, "blue" => 0xFA),
		"springgreen"          => array("red" => 0x00, "green" => 0xFF, "blue" => 0x7F),
		"steelblue"            => array("red" => 0x46, "green" => 0x82, "blue" => 0xB4),
		"tan"                  => array("red" => 0xD2, "green" => 0xB4, "blue" => 0x8C),
		"thistle"              => array("red" => 0xD8, "green" => 0xBF, "blue" => 0xD8),
		"tomato"               => array("red" => 0xFF, "green" => 0x63, "blue" => 0x47),
		"turquoise"            => array("red" => 0x40, "green" => 0xE0, "blue" => 0xD0),
		"violet"               => array("red" => 0xEE, "green" => 0x82, "blue" => 0xEE),
		"wheat"                => array("red" => 0xF5, "green" => 0xDE, "blue" => 0xB3),
		"whitesmoke"           => array("red" => 0xF5, "green" => 0xF5, "blue" => 0xF5),
		"yellowgreen"          => array("red" => 0x9A, "green" => 0xCD, "blue" => 0x32)
	);
	
	const ColorsHEX
	= array(
		"black"                => "#000000",
		"maroon"               => "#1280000",
		"green"                => "#0012800",
		"olive"                => "#12812800",
		"navy"                 => "#0000128",
		"purple"               => "#12800128",
		"teal"                 => "#00128128",
		"gray"                 => "#128128128",
		"silver"               => "#192192192",
		"red"                  => "#2550000",
		"lime"                 => "#0025500",
		"yellow"               => "#25525500",
		"blue"                 => "#0000255",
		"fuchsia"              => "#25500255",
		"aqua"                 => "#00255255",
		"white"                => "#255255255",
		"aliceblue"            => "#240248255",
		"antiquewhite"         => "#250235215",
		"aquamarine"           => "#127255212",
		"azure"                => "#240255255",
		"beige"                => "#245245220",
		"blueviolet"           => "#13843226",
		"brown"                => "#1654242",
		"burlywood"            => "#222184135",
		"cadetblue"            => "#95158160",
		"chartreuse"           => "#12725500",
		"chocolate"            => "#21010530",
		"coral"                => "#25512780",
		"cornflowerblue"       => "#100149237",
		"cornsilk"             => "#255248220",
		"crimson"              => "#2202060",
		"darkblue"             => "#0000139",
		"darkcyan"             => "#00139139",
		"darkgoldenrod"        => "#18413411",
		"darkgray"             => "#169169169",
		"darkgreen"            => "#0010000",
		"darkkhaki"            => "#189183107",
		"darkmagenta"          => "#13900139",
		"darkolivegreen"       => "#8510747",
		"darkorange"           => "#25514000",
		"darkorchid"           => "#15350204",
		"darkred"              => "#1390000",
		"darksalmon"           => "#233150122",
		"darkseagreen"         => "#143188143",
		"darkslateblue"        => "#7261139",
		"darkslategray"        => "#477979",
		"darkturquoise"        => "#00206209",
		"darkviolet"           => "#14800211",
		"deeppink"             => "#25520147",
		"deepskyblue"          => "#00191255",
		"dimgray"              => "#105105105",
		"dodgerblue"           => "#30144255",
		"firebrick"            => "#1783434",
		"floralwhite"          => "#255250240",
		"forestgreen"          => "#3413934",
		"gainsboro"            => "#220220220",
		"ghostwhite"           => "#248248255",
		"gold"                 => "#25521500",
		"goldenrod"            => "#21816532",
		"greenyellow"          => "#17325547",
		"honeydew"             => "#240255240",
		"hotpink"              => "#255105180",
		"indianred"            => "#2059292",
		"indigo"               => "#7500130",
		"ivory"                => "#255255240",
		"khaki"                => "#240230140",
		"lavender"             => "#230230250",
		"lavenderblush"        => "#255240245",
		"lawngreen"            => "#12425200",
		"lemonchiffon"         => "#255250205",
		"lightblue"            => "#173216230",
		"lightcoral"           => "#240128128",
		"lightcyan"            => "#224255255",
		"lightgoldenrodyellow" => "#250250210",
		"lightgreen"           => "#144238144",
		"lightgrey"            => "#211211211",
		"lightpink"            => "#255182193",
		"lightsalmon"          => "#255160122",
		"lightseagreen"        => "#32178170",
		"lightskyblue"         => "#135206250",
		"lightslategray"       => "#119136153",
		"lightsteelblue"       => "#176196222",
		"lightyellow"          => "#255255224",
		"limegreen"            => "#5020550",
		"linen"                => "#250240230",
		"mediumaquamarine"     => "#102205170",
		"mediumblue"           => "#0000205",
		"mediumorchid"         => "#18685211",
		"mediumpurple"         => "#147112208",
		"mediumseagreen"       => "#60179113",
		"mediumslateblue"      => "#123104238",
		"mediumspringgreen"    => "#00250154",
		"mediumturquoise"      => "#72209204",
		"mediumvioletred"      => "#19921133",
		"midnightblue"         => "#2525112",
		"mintcream"            => "#245255250",
		"mistyrose"            => "#255228225",
		"moccasin"             => "#255228181",
		"navajowhite"          => "#255222173",
		"oldlace"              => "#253245230",
		"olivedrab"            => "#10714235",
		"orange"               => "#25516500",
		"orangered"            => "#2556900",
		"orchid"               => "#218112214",
		"palegoldenrod"        => "#238232170",
		"palegreen"            => "#152251152",
		"paleturquoise"        => "#175238238",
		"palevioletred"        => "#219112147",
		"papayawhip"           => "#255239213",
		"peachpuff"            => "#255218185",
		"peru"                 => "#20513363",
		"pink"                 => "#255192203",
		"plum"                 => "#221160221",
		"powderblue"           => "#176224230",
		"rosybrown"            => "#188143143",
		"royalblue"            => "#65105225",
		"saddlebrown"          => "#1396919",
		"salmon"               => "#250128114",
		"sandybrown"           => "#24416496",
		"seagreen"             => "#4613987",
		"seashell"             => "#255245238",
		"sienna"               => "#1608245",
		"skyblue"              => "#135206235",
		"slateblue"            => "#10690205",
		"slategray"            => "#112128144",
		"snow"                 => "#255250250",
		"springgreen"          => "#00255127",
		"steelblue"            => "#70130180",
		"tan"                  => "#210180140",
		"thistle"              => "#216191216",
		"tomato"               => "#2559971",
		"turquoise"            => "#64224208",
		"violet"               => "#238130238",
		"wheat"                => "#245222179",
		"whitesmoke"           => "#245245245",
		"yellowgreen"          => "#15420550"
	);
	
	const ChartDataSetColor
	= array(
		array("red" => 0x00, "green" => 0x00, "blue" => 0x00),
		array("red" => 0x80, "green" => 0x00, "blue" => 0x00),
		array("red" => 0x00, "green" => 0x80, "blue" => 0x00),
		array("red" => 0x80, "green" => 0x80, "blue" => 0x00),
		array("red" => 0x00, "green" => 0x00, "blue" => 0x80),
		array("red" => 0x80, "green" => 0x00, "blue" => 0x80),
		array("red" => 0x00, "green" => 0x80, "blue" => 0x80),
		array("red" => 0x80, "green" => 0x80, "blue" => 0x80),
		array("red" => 0xC0, "green" => 0xC0, "blue" => 0xC0),
		array("red" => 0xFF, "green" => 0x00, "blue" => 0x00),
		array("red" => 0x00, "green" => 0xFF, "blue" => 0x00),
		array("red" => 0xFF, "green" => 0xFF, "blue" => 0x00),
		array("red" => 0x00, "green" => 0x00, "blue" => 0xFF),
		array("red" => 0xFF, "green" => 0x00, "blue" => 0xFF),
		array("red" => 0x00, "green" => 0xFF, "blue" => 0xFF),
		array("red" => 0xFF, "green" => 0xFF, "blue" => 0xFF),
		
		//  Additional  colors  as  they  are  used  by  Netscape  and  IE
		array("red" => 0xF5, "green" => 0xF5, "blue" => 0xDC),
		array("red" => 0xA5, "green" => 0x2A, "blue" => 0x2A),
		array("red" => 0xFF, "green" => 0x7F, "blue" => 0x50),
		array("red" => 0xFF, "green" => 0xD7, "blue" => 0x00),
		array("red" => 0xF0, "green" => 0xE6, "blue" => 0x8C),
		array("red" => 0xE6, "green" => 0xE6, "blue" => 0xFA),
		array("red" => 0x90, "green" => 0xEE, "blue" => 0x90),
		array("red" => 0xFA, "green" => 0xF0, "blue" => 0xE6),
		array("red" => 0xCD, "green" => 0x85, "blue" => 0x3F),
		array("red" => 0xFF, "green" => 0xC0, "blue" => 0xCB),
		array("red" => 0xDD, "green" => 0xA0, "blue" => 0xDD),
		array("red" => 0xFA, "green" => 0x80, "blue" => 0x72),
		array("red" => 0xFF, "green" => 0xFA, "blue" => 0xFA),
		array("red" => 0xD2, "green" => 0xB4, "blue" => 0x8C),
		array("red" => 0xFF, "green" => 0x63, "blue" => 0x47),
		array("red" => 0xEE, "green" => 0x82, "blue" => 0xEE)
	);
	
	
	const TrueFalse
	= array(
		0 => "False",
		1 => "True"
	);
	
	const ActiveInactive
	= array(
		0 => "Inactive",
		1 => "Active"
	);
	
	const EnableDisable
	= array(
		0 => "Disable",
		1 => "Enable"
	);
	
	const OnOff
	= array(
		0 => "Off",
		1 => "On"
	);
	
	const YesNo
	= array(
		0 => "No",
		1 => "Yes"
	);
	
	const CheckedUnchecked
	= array(
		0 => "",
		1 => "Checked"
	);
	
	const OpenClose
	= array(
		0 => "Close",
		1 => "Open"
	);
	
	const TextRelay
	= array("gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray",
	        "gray", "gray", "gray",
	        "gray", "gray", "gray", "gray", "gray", "gray");
	
	const TextInput
	= array("off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off",
	        "off", "off", "off", "off", "off", "off");
	
	const LabelsRelay
	                 = array("Rel1", "Rel2", "Rel3", "Rel4", "Rel5", "Rel6", "Rel7", "Rel8", "Rel9", "Rel10", "Rel11", "Rel12", "Rel13", "Rel14", "Rel15", "Rel16", "Rel17", "Rel18", "Rel19", "Rel20",
	                         "Rel21", "Rel22", "Rel23", "Rel24", "Rel25",
	                         "Rel26", "Rel27", "Rel28", "Rel29", "Rel30", "Rel31", "Rel32");
	const LabelsInput
	                 = array("DIn1", "DIn2", "DIn3", "DIn4", "DIn5", "DIn6", "DIn7", "DIn8", "DIn9", "DIn10", "DIn11", "DIn12", "DIn13", "DIn14", "DIn15", "DIn16", "DIn17", "DIn18", "DIn19", "DIn20",
	                         "DIn21", "DIn22", "DIn23", "DIn24", "DIn25",
	                         "DIn26", "DIn27", "DIn28", "DIn29", "DIn30", "DIn31", "DIn32");
	const LabelsVoltage
	                 = array("VR (V)", "VS (V)", "VT (V)", "VR1 (V)", "VS1 (V)", "VT1 (V)", "VR2 (V)", "VS2 (V)", "VT2 (V)", "VR3 (V)", "VS3 (V)", "VT3 (V)", "VR4 (V)", "VS4 (V)", "VT4 (V)", "VR5 (V)", "VS5 (V)", "VT5 (V)", "VR6 (V)", "VS6 (V)", "VT6 (V)", "VRL (V)", "VSL (V)", "VTL (V)",
	                         "VR11 (V)", "VS11 (V)", "VT11 (V)", "VR22 (V)", "VS22 (V)", "VT22 (V)", "VR33 (V)", "VS33 (V)", "VT33 (V)");
	const LabelsAmpere
	                 = array("IR (A)", "IS (A)", "IT (A)", "IN (A)", "IR1 (A)", "IS1 (A)", "IT1 (A)", "IN1 (A)", "IR2 (A)", "IS2 (A)", "IT2 (A)", "IN2 (A)", "IR3 (A)", "IS3 (A)", "IT3 (A)", "IN3 (A)", "IR4 (A)", "IS4 (A)", "IT4 (A)", "IN4 (A)", "IR5 (A)", "IS5 (A)", "IT5 (A)", "IN5 (A)", "IR6v",
	                         "IS6 (A)", "IT6 (A)", "IN6 (A)", "IRL (A)", "ISL (A)", "ITL (A)", "INL (A)");
	const LabelsCosq = array("CosR", "CosS", "CosT");
	
	const LabelsPower    = array("PT (W)", "PA (W)", "PB (W)", "PC (W)");
	const LabelsReactive = array("QT (VAR)", "QA (VAR)", "QB (VAR)", "QC (VAR)");
	
	const LabelsFuse
	= array("fuR", "fuS", "fuT", "fuN", "fuR1", "fuS1", "fuT1", "fuN1", "fuR2", "fuS2", "fuT2", "fuN2", "fuR3", "fuS3", "fuT3", "fuN3", "fuR4", "fuS4", "fuT4", "fuN4", "fuR5", "fuS5", "fuT5", "fuN5",
	        "fuR6",
	        "fuS6", "fuT6", "fuN6", "fuRL", "fuSL", "fuTL", "fuNL");
	
	const ChartRowsColumns
	= array('TEMPERATURE' => array(4, 1), 'HUMIDITY' => array(4, 1), 'ACVOLTAGE' => array(6, 4), 'ACAMPERE' => array(8, 4), 'DCVOLTAGE' => array(1, 1), 'DCAMPERE' => array(1, 1),
	        'COSQ'        => array(3, 1), 'RELAY' => array(4, 8), 'DIGITALINPUT' => array(4, 8), 'DIGITALOUTPUT' => array(4, 1), 'DIGITALEXIST' => array(4, 1));
	
	
	/**********************************************/
	/**********************************************/
	/**********************************************/
	const TextRelayS
	= array("gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray",
	        "gray", "gray", "gray",
	        "gray", "gray", "gray", "gray", "gray", "gray");
	
	const TextInputS
	= array("close", "close", "gas", "lock", "door1", "door2", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off",
	        "off",
	        "off", "off", "off", "off", "off", "off");
	
	const LabelsRelayS
	                  = array("قطع کردن سکسیونر", "وصل کردن سکسیونر", "Rel3", "Rel4", "Rel5", "Rel6", "Rel7", "Rel8", "Rel9", "Rel10", "Rel11", "Rel12", "Rel13", "Rel14", "Rel15", "Rel16", "Rel17",
	                          "Rel18", "Rel19", "Rel20",
	                          "Rel21", "Rel22", "Rel23", "Rel24", "Rel25",
	                          "Rel26", "Rel27", "Rel28", "Rel29", "Rel30", "Rel31", "Rel32");
	const LabelsInputS
	                  = array("DIn1", "DIn2", "DIn3", "DIn4", "DIn5", "DIn6", "DIn7", "DIn8", "DIn9", "DIn10", "DIn11", "DIn12", "DIn13", "DIn14", "DIn15", "DIn16", "DIn17", "DIn18", "DIn19", "DIn20",
	                          "DIn21", "DIn22", "DIn23", "DIn24", "DIn25",
	                          "DIn26", "DIn27", "DIn28", "DIn29", "DIn30", "DIn31", "DIn32");
	const LabelsVoltageS
	                  = array("VAS (KV)", "VBS (KV)", "VCS (KV)", "VAL (KV)", "VBL (KV)", "VCL (KV)", "VR2 (KV)", "VS2 (KV)", "VT2 (KV)", "VR3 (KV)", "VS3 (KV)", "VT3 (KV)", "VR4 (KV)", "VS4 (KV)", "VT4 (KV)", "VR5 (KV)", "VS5 (KV)", "VT5 (KV)", "VR6 (KV)", "VS6 (KV)", "VT6 (KV)", "VRL (KV)", "VSL (KV)", "VTL (KV)",
	                          "VR11", "VS11", "VT11", "VR22", "VS22", "VT22", "VR33", "VS33", "VT33");
	const LabelsAmpereS
	                  = array("IA (A)", "IB (A)", "IC (A)", "IN (A)", "IR1 (A)", "IS1 (A)", "IT1 (A)", "IN1 (A)", "IR2 (A)", "IS2 (A)", "IT2 (A)", "IN2 (A)", "IR3 (A)", "IS3 (A)", "IT3 (A)", "IN3 (A)", "IR4 (A)", "IS4 (A)", "IT4 (A)", "IN4 (A)", "IR5 (A)", "IS5 (A)", "IT5 (A)", "IN5 (A)", "IR6 (A)",
	                          "IS6 (A)", "IT6 (A)", "IN6 (A)", "IRL (A)", "ISL (A)", "ITL (A)", "INL (A)");
	const LabelsCosqS = array("CosA", "CosB", "CosC");
	
	const LabelsPowerS    = array("PT (KW)", "PA (KW)", "PB (KW)", "PC (KW)");
	const LabelsReactiveS = array("QT (KVAR)", "QA (KVAR)", "QB (KVAR)", "QC (KVAR)");
	
	const LabelsFuseS
	= array("fuR", "fuS", "fuT", "fuN", "fuR1", "fuS1", "fuT1", "fuN1", "fuR2", "fuS2", "fuT2", "fuN2", "fuR3", "fuS3", "fuT3", "fuN3", "fuR4", "fuS4", "fuT4", "fuN4", "fuR5", "fuS5", "fuT5", "fuN5",
	        "fuR6",
	        "fuS6", "fuT6", "fuN6", "fuRL", "fuSL", "fuTL", "fuNL");
	
	const ChartRowsColumnsS
	= array('TEMPERATURE' => array(4, 1), 'HUMIDITY' => array(4, 1), 'ACVOLTAGE' => array(6, 1), 'ACAMPERE' => array(3, 1), 'DCVOLTAGE' => array(1, 1), 'DCAMPERE' => array(1, 1),
	        'COSQ'        => array(3, 1), 'RELAY' => array(2, 1), 'DIGITALINPUT' => array(1, 5), 'DIGITALEXIST' => array(4, 1), 'DIGITALOUTPUT' => array(4, 1));
	
	const NumbersName = array("0" => "zero", "1" => "one", "2" => "two", "3" => "three", "4" => "four", "5" => "five", "6" => "six", "7" => "seven", "8" => "eight", "9" => "nine");
	
	const Temporaries
	= array(
		"image"   => "image",
		"control" => "control"
	);
	
	const PagesName
	= array(
		'alldevices'  => 'alldevices',
		'login'       => 'login',
		'logout'      => 'logout',
		'users'       => 'users',
		'report'      => 'report',
		'userinfo'    => 'userinfo',
		'about'       => 'about',
		'device'      => 'device',
		'calibration' => 'calibration',
		'settings'    => 'settings',
	);
	
	define('FILLFILED', 'Please Fill all required fields');
	define('USERPASSWORDERROR', 'user name and/or password is incorrect');
	define('WEBSERVICESERVERINFO', 'http://localhost:9090');
	define('REDIRECTPAGE', 'index.php?Req=');
	define('ALLDEVICESPAGE', REDIRECTPAGE . PagesName['alldevices']);
	define('LOGINPAGE', REDIRECTPAGE . PagesName['login']);
	define('LOGOUTPAGE', REDIRECTPAGE . PagesName['logout']);
	define('USERSPAGE', REDIRECTPAGE . PagesName['users']);
	define('REPORTPAGE', REDIRECTPAGE . PagesName['report']);
	define('USERINFOPAGE', REDIRECTPAGE . PagesName['userinfo']);
	define('ABOUTPAGE', REDIRECTPAGE . PagesName['about']);
	define('DEVICEPAGE', REDIRECTPAGE . PagesName['device']);
	define('CALIBRATION', REDIRECTPAGE . PagesName['calibration']);
	define('ISLOGGEDIN', 'isLoggedIn');
	define('USERNAME', 'username');
	define('PASSWORD', 'password');
	define('SETTINGSXMLFILEPATH', 'XML/Settings.xml');
	
	/**
	 * Errors messages
	 */
	
	define('TIMEOUT_MESSAGE', _("No response received from server or device"));
	define('SUCCESS_SETTING_MESSAGE', _("Settings set successfully"));
	define('RELAY_SET_MESSAGE', _("Relay set successfully"));
	define('SET_ERROR_MESSAGE', _("Error in set settings"));
	define('RELAY_ERROR_MESSAGE', _("Error in set relay"));