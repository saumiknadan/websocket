<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use App\Models\User;
use App\Models\Chat;
use App\Models\ChatRequest;

use Auth;

class SocketController extends Controller implements MessageComponentInterface
{
    //
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if(isset($queryarray['token']))
        {
            User::where('token', $queryarray['token'])->update([ 'connection_id' => $conn->resourceId ]);
        }
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {

    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        
        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if(isset($queryarray['token']))
        {
            User::where('token' , $queryarray['token'])->update([ 'connection_id' => 0]);
        }

    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has ocurred:{$e->getMessage()} \n";
        $conn->close();
    }


}
