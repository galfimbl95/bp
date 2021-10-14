<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EntryController extends Controller
{

    public function index()
    {
        function getEntryPairs()
        {
            $arrAllEntries = Entry::all()->where('user_id', Auth::user() -> id)->sortByDesc('date');
            $arrEntryPairs = [];
            $arrDates = [];


            foreach ($arrAllEntries as $entry) {
                array_push($arrDates, $entry->date->format("Y-m-d"));
            }
            $arrUniqDates = array_unique($arrDates);

            foreach ($arrUniqDates as $uniqDate) {
                $entryPair = [
                    'morning' => '',
                    'evening' => ''
                ];
                foreach ($arrAllEntries as $entry) {
                    if ($entry->date->format("Y-m-d") == $uniqDate) {
                        if ($entry->date->format("H") < "14") {
                            if ($entryPair['morning'] == '') {
                                $entryPair['morning'] = $entry;
                            } else {
                                if ($entry->date < $entryPair['morning']->date) {
                                    $entryPair['morning'] = $entry;
                                }
                            }

                        } else {
                            if ($entryPair['evening'] == '') {
                                $entryPair['evening'] = $entry;
                            } else {
                                if ($entry->date > $entryPair['evening']->date) {
                                    $entryPair['evening'] = $entry;
                                }
                            }
                        }
                    }
                }
                array_push($arrEntryPairs, $entryPair);
            }

            return $arrEntryPairs;
        }

        $arrEntryPairs = getEntryPairs();

        return view('home', [
            'arrEntryPairs' => getEntryPairs()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entries.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'sistol' => 'required|integer|min:40|max:300',
            'diastol' => 'required|integer|min:40|max:300',
            'pulse' => 'max:3'
        ]);
        $entry = new Entry($request->all());
        $entry->user_id =  Auth::user() -> id;
        $entry->save();

        return redirect()->route('entries.index')->with('success', 'Запись успешно добавлена.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        if (Gate::denies ('update-entry', $entry)) {
            abort(403);
        }
        return view('entries.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        if (Gate::denies ('update-entry', $entry)) {
            abort(403);
        }

        $request->validate([
            'date' => 'required',
            'sistol' => 'required|integer|min:40|max:300',
            'diastol' => 'required|integer|min:40|max:300',
            'pulse' => 'max:3'
        ]);

        $entry->update($request->all());
        return redirect()->route('entries.index')
            ->with('success', 'Запись обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        if (Gate::denies ('update-entry', $entry)) {
            abort(403);
        }

        $entry->delete();
        return back()->with('success', 'Запись удалена');
    }

    public function showDay(Request $request, $date){
        $dateStart = date_create_from_format( 'Y-m-d H:i:s',  $date.' 00:00:00');
        $dateEnd = date_create_from_format( 'Y-m-d H:i:s',  $date.' 23:59:59');
        $arrEntries = Entry::all()->where('user_id', Auth::user() -> id)->where('date','>', $dateStart)->where('date','<', $dateEnd)->sortByDesc('date');
        return view('entries.entryForDay', [
            'arrEntries' => $arrEntries
        ]);


    }
}
