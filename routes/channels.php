<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Proceeding.{id}', function ($proceeding, $id) {
    return (int) $proceeding->id === (int) $id;
});

Broadcast::channel('App.Models.PolicyBrief.{id}', function ($policybrief, $id) {
    return (int) $policybrief->id === (int) $id;
});

