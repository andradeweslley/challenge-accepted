<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocaleResource;
use App\Http\Resources\WeatherCollection;
use App\Http\Resources\WeatherResource;
use App\Models\Locale;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|array',
            'period.begin' => 'required|date_format:Y-m-d',
            'period.end' => 'required|date_format:Y-m-d',

            'locale' => 'required|integer'
        ], [
            'period.required' => 'Período não informado',

            'period.begin.required' => 'Data inicial de pesquisa não informado',
            'period.begin.date_format' => 'Data inicial no formato inválido. Informe como AAAA-MM-DD.',

            'period.end.required' => 'Data final de pesquisa não informado',
            'period.end.date_format' => 'Data final no formato inválido. Informe como AAAA-MM-DD.',

            'locale.required' => 'Localidade não informado',
            'locale.integer' => 'Localidade deve conter apenas números',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Há campos com erros',
                'additional' => $validator->messages(),
            ], 422);
        }

        // Encontra primeiro a localidade
        $locale = Locale::find($request->get('locale'));

        if (!$locale) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Localidade não encontrada',
            ], 404);
        }

        // Coloca o período em uma variável para melhor trativa
        $period = $request->get('period');

        // Encontra a previsão para o período solicitado
        $weather = Weather::where('locale_id', $locale->id)
            ->whereBetween('date', [$period['begin'], $period['end']])
            ->get();

        return new WeatherCollection($weather, $locale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
