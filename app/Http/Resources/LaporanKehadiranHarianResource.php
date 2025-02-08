<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanKehadiranHarianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'nama'   => $this->user->name ?? '-',
            'status' => $this->present_at ? 'Hadir' : ucfirst($this->reason),
            'waktu'  => Carbon::parse($this->created_at)->locale('id')->isoFormat('D MMMM Y H:m:s'),
            $this->mergeWhen($this->present_at === null, [
                'keterangan' => $this->description,
            ]),
            // 'keterangan' => $this->present_at === null ? $this->description : '-',
        ];
    }
}
