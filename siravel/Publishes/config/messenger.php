<?php

return [

    'user_model' => App\Models\User::class,

    'message_model' => Informate\Models\Features\Messenger\Message::class,

    'participant_model' => Informate\Models\Features\Messenger\Participant::class,

    'thread_model' => Informate\Models\Features\Messenger\Thread::class,

    /**
     * Define custom database table names - without prefixes.
     */
    'messages_table' => null,

    'participants_table' => null,

    'threads_table' => null,
];
