<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WeatherCollection extends ResourceCollection
{
    private $locale;

    public function __construct($resource, $locale)
    {
        parent::__construct($resource);

        $this->locale = $locale;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'period' => $request->get('period'),
            'locale' => new LocaleResource($this->locale),
            'weather' => $this->collection,
        ];
    }
}
