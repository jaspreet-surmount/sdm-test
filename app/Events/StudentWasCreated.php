<?php

namespace App\Events;

use App\Events\Event;
use App\Student;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentWasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $student;

    /**
     * Create a new event instance.
     *
     * @param Student $student
     * @return \App\Events\StudentWasCreated
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['student.'.$this->student->id];
    }
}
