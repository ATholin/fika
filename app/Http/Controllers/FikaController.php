<?php

namespace App\Http\Controllers;

use App\Fika;
use App\Http\Requests\CreateFikaRequest;
use App\Time;
use Badcow\PhraseGenerator\PhraseGenerator;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FikaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('fika.create');
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return Application|Factory|View
//     */
//    public function create()
//    {
//        return view('fika.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFikaRequest $request
     * @return RedirectResponse
     */
    public function store(CreateFikaRequest $request)
    {
        $validated = $request->validated();

        $fika = new Fika([
            'title' => $validated['title'],
            'slug' => Str::snake(PhraseGenerator::generate(), '-')
        ]);

        $fika->save();

        foreach ($validated['times'] as $t) {
            $time = new Time;

            $time->start = $t['start'];

            $end = $t['end'];
            $time->end = Carbon::parse("$end", 'Europe/Stockholm')->addMinutes(30)->format('H:i');

            $time->fika()->associate($fika);
            $time->save();
        }

        return redirect()->to(route('fika.show', $fika));
    }

    /**
     * Display the specified resource.
     *
     * @param Fika $fika
     * @return Application|Factory|View
     */
    public function show(Fika $fika)
    {
        return view('fika.show', [
            'fika' => $fika->load('times')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return void
     */
    public function edit()
    {
        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update()
    {
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy()
    {
        return;
    }

    public function times(Fika $fika)
    {
        $times = $fika->times()->get(['start', 'end']);
        return json_encode($times);

//        $filterTimes = $times->filter(function (Time $time) {
//            $end = $time->getAttribute('end');
//            $date = Carbon::parse("$end", 'Europe/Stockholm');
//            return $date->isAfter(now());
//        });
//
//        return json_encode($filterTimes->map(function(Time $time) {
//            return [
//                'start' => $time->getAttribute('start'),
//                'end' => $time->getAttribute('end')
//            ];
//        }));
    }
}
