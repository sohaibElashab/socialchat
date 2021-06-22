<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use DateTime;

use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

class likePostEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $id;
    // public $idPost;
    public $etat;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id , $etat)
    {
        $this->id = $id;
        // $this->idPost = $idPost;
        $this->etat = $etat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('likePost.'.$this->id);
    }

    public function broadcastWith()
    {
        return ['id' => $this->id , 'etat' => $this->etat]; 
    }


}
