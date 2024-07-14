<?php

namespace App\Enums;

enum StatusType: string
{
    case Pending = 'Pending';        // This status indicates that the contact submission has been received but has not yet been processed or reviewed.
    case InProgress = 'In Progress'; // This status might indicate that the contact submission is currently being addressed or worked on by the team.
    case Approved = 'Approved';      // This status could signify that the contact submission has been reviewed and accepted or approved.
    case Rejected = 'Rejected';      // This status might be used when the contact submission is not valid or does not meet certain criteria, and thus is rejected by the organization.
    case Closed = 'Closed';          // This status indicates that the contact submission has been resolved or dealt with and is now considered closed.
    case Escalated = 'Escalated';    // This status could signify that the contact submission has been escalated to a higher level of authority or department for further handling.
    case OnHold = 'On Hold';         // This status might be used when the processing of the contact submission is temporarily paused or delayed.
    case Flagged = 'Flagged';        // This status might be used to highlight contact submissions thapent require special attention or consideration.
    public static function isValid(string $value): bool
    {
        return match ($value) {
            self::Pending, self::InProgress, self::Approved,
            self::Rejected, self::Closed, self::Escalated,
            self::OnHold, self::Flagged => true,
            default => false,
        };
    }
    public static function toSelectArray(): array
    {
        return [
            'Pending' => 'Pending',
            'InProgress' => 'In Progress',
            'Approved' => 'Approved',
            'Rejected' => 'Rejected',
            'Closed' => 'Closed',
            'Escalated' => 'Escalated',
            'OnHold' => 'On Hold',
            'Flagged' => 'Flagged',
        ];
    }

}
