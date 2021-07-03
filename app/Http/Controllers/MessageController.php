<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Events\NewMessage;
use App\Http\Repository\Message\MessageRepository;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller
{
    private MessageRepository $messageRepo;

    /**
     * MessageController constructor.
     * @param MessageRepository $messageRepo
     */
    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }

    /**
     * @OA\Get(
     *     path="/api/message",
     *     summary="Список сообщений",
     *     tags={"Message"},
     *     description="Список сообщений",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Message")
     *             ),
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $messages = $this->messageRepo->get();
        return MessageResource::collection($messages);
    }

    /**
     * @OA\Post(
     *     path="/api/message",
     *     summary="Отправка сообщения",
     *     tags={"Message"},
     *     description="Отправка сообщения",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="nickname",
     *                 type="string",
     *                 description="Ник"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Сообщение"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Message")
     *             ),
     *         )
     *     )
     * )
     * @param MessageRequest $request
     * @return MessageResource|\Illuminate\Http\JsonResponse
     */
    public function create(MessageRequest $request)
    {
        if (! $request->filled('message')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }

        $message = $this->messageRepo->store(collect($request));

        event(new ChatMessage($message->id, $request->nickname, $request->message, $message->created_at->format('d.m.y H:i:s')));

        return new MessageResource($message);
    }
}
