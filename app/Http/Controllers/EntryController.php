<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use DateTime;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        function getEntryPairs()
        {
            $arrAllEntries = Entry::all()->where('user_id', 1)->sortByDesc('date');
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

    public function create(Request $request)
    {
        $request->validate([
            'datetime' => 'required',
            'numberSistol' => 'required|integer|min:40|max:300',
            'numberDiastol' => 'required|integer|min:40|max:300',
            'numberPulse' => 'max:3'
        ]);

        $entry = new Entry;
        $entry->user_id =  1;
        $entry->date =  $request->datetime;
        $entry->sistol =  $request->numberSistol;
        $entry->diastol =  $request->numberDiastol;
        $entry->pulse =  $request->numberPulse;

        $entry->save();

        return redirect()->route('home');
    }

    public function showDay(Request $request, $date){
        $dateStart = date_create_from_format( 'Y-m-d H:i:s',  $date.' 00:00:00');
        $dateEnd = date_create_from_format( 'Y-m-d H:i:s',  $date.' 23:59:59');
        $arrEntries = Entry::all()->where('user_id', 1)->where('date','>', $dateStart)->where('date','<', $dateEnd)->sortByDesc('date');
        return view('entryForDay', [
            'arrEntries' => $arrEntries
        ]);
    }
}
