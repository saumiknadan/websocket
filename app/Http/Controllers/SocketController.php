<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {

    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has ocurred:{$e->getMessage()} \n";
        $conn->close();
    }


}
