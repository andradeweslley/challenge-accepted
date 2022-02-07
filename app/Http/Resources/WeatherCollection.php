<?php

namespace App\Http\Resources;

use App\Models\Locale;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WeatherCollection extends ResourceCollection
{
    /** @var \App\Models\Locale|\Illuminate\Database\Eloquent\Collection<\App\Models\Locale> */
    private $locale;

    /**
     * Builds collection
     *
     * @param mixed $resource Resource itself
     * @param \App\Models\Locale|\Illuminate\Database\Eloquent\Collection<\App\Models\Locale> $locale   Locale data
     */
    public function __construct($resource, Locale|\Illuminate\Database\Eloquent\Collection $locale)
    {
        parent::__construct($resource);

        $this->locale = $locale;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
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
