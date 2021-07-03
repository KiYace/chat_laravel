<?php

namespace Tests\Feature\Api;

use App\Events\ChatMessage;
use App\Events\NewMessage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddMessage()
    {
        Event::fake();

        $response = $this->addMessage();
        $response->assertStatus(201);
        $this->assertNotEmpty($response->getContent());
        Event::assertDispatched(ChatMessage::class);
    }

    public function testMessageList()
    {
        $this->addMessage();

        $response = $this->getJson('api/message');
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }

    public function testAddMessageValidation()
    {
        $response = $this->postJson('api/message', [
            'nickname' => 'Kirill',
        ]);

        $response->assertStatus(422);
    }

    private function addMessage()
    {
        return $this->postJson('api/message', [
            'nickname' => 'Kirill',
            'message' => 'Hello World!'
        ]);
    }
}
