<?php

namespace App\GraphQL\Subscriptions;

use App\Models\Room;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;

class NewMessagesInRoom extends GraphQLSubscription
{
    /**
     * Check if subscriber is allowed to listen to the subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function authorize(Subscriber $subscriber, Request $request): bool
    {
        return true;

        $User = $subscriber->context->user;
        $roomId = $subscriber->args['roomId'];

        // get the room entity
        $Room = Room::findOrFail($roomId);

        // if the room is public -> everyone is allowed
        if ($Room->public) {
            return true;
        }

        // if the user is creator of the room -> allowed
        if ($Room->creator_id === $User->id) {
            return true;
        }

        // otherwise the user is not allowed
        return false;
    }

    /**
     * Filter which subscribers should receive the subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  mixed  $root
     * @return bool
     */
    public function filter(Subscriber $subscriber, $root): bool
    {
        return true;

        $user = $subscriber->context->user;

        // Don't broadcast the subscription to the same
        // person who updated the post.
        return $root->updated_by !== $user->id;
    }
}
