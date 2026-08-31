<?php

namespace App;

/**
 * Step 6:
 * Populate the enum with the values:
 * 
 * PENDING = 'pending';
 * IN_PROGRESS = 'in progress';
 * COMPLETED = 'completed';
 */
enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';

    /**
     * This method is used to get the label of the status.
     * e.g. $idea->status->label() will return 'Pending', 'In Progress', 'Completed'.
     */
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }
}
