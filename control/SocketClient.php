<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SocketConnSer;

/**
 * Description of SocketClient
 *
 * @author manon
 */
class SocketClient
{
	//put your code here
	
	const socketServerName = '127.0.0.1';
	
	public static function __clientConnect($Command)
	{
		/*$fp = stream_socket_client('tcp://' . \SocketConnSer\SocketClient::socketServerName . ':50000', $errno, $errstr, 30);
		if ($fp){
			fwrite($fp, $Command."#");
			//$returnResult = array();
			//$returnResult[] = fgets($fp, 1024);
			//while (!substr($returnResult[])) {
				echo fgets($fp, 4);
			//}
			fclose($fp);
		}*/
		
		/* Get the port for the WWW service. */
		$service_port = 50000;
		
		/* Get the IP address for the target host. */
		$address = gethostbyname('127.0.0.1');
		
		/* Create a TCP/IP socket. */
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket !== FALSE)
		{
			$result = socket_connect($socket, $address, $service_port);
			if ($result !== FALSE)
			{
				socket_write($socket, $Command, strlen($Command));
				//socket_read($socket,5 );
				socket_close($socket);
			}
		}
	}
}
