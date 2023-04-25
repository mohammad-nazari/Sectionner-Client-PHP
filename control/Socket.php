<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SocketConnSer;

/**
 * Description of Socket
 *
 * @author manon
 */
class SocketServer {
    //put your code here
    
    const socketServerName = 'tcp://0.0.0.0:8000';
    
    public static function __startServer(){
    
        $socket = stream_socket_server(\SocketConnSer\SocketServer::socketServerName, $errno, $errstr);
        if (!$socket) {
            return "$errstr ($errno)<br />\n";
        } else {
          while ($conn = stream_socket_accept($socket)) {
            fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
            fclose($conn);
          }
          fclose($socket);
        }
    
    }

    
    
}

\SocketConnSer\SocketServer::__startServer();