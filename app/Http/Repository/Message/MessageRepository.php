<?php

namespace App\Http\Repository\Message;

use App\Models\Message;
use Illuminate\Support\Collection;

interface MessageRepository
{
    public function get(): \Illuminate\Database\Eloquent\Collection;

    public function store(Collection $collection): Message;
}
