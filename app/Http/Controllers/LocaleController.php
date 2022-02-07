<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocaleResource;
use App\Models\Locale;
use App\Repository\SearchRepository;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SearchRepository $searchRepository)
    {
        $locales = request()->has('q')
            ? $searchRepository->search(request('q'))
            : Locale::all();

        return LocaleResource::collection($locales);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \App\Http\Resources\LocaleResource
     */
    public function show($id)
    {
        $locale = Locale::findOrFail($id);

        return new LocaleResource($locale);
    }
}
