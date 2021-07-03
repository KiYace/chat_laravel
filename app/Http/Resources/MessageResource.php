<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Message",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID",
 *          readOnly=true
    *     ),
 *     @OA\Property(
 *          property="nickname",
 *          type="string",
 *          description="Ник",
    *     ),
 *     @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Сообщение",
    *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="string",
 *          description="Дата создания",
 *          readOnly=true
    *     ),
 * )
 */
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Message $this
         */
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'message' => $this->message,
            'created_at' => $this->created_at->format('d.m.y H:i:s')
        ];
    }
}
