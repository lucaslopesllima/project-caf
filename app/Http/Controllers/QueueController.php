<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class QueueController extends Controller
{

    /**
     * Returns a list of people who have not yet been attended, with optional filtering by priority or date range.
     *
     * This function queries the Pessoa model for records where the 'was_attended' field is 0.
     * You can optionally filter the results by priority and/or by a creation date range.
     * The results are ordered first by priority (ascending) and then by ID (ascending).
     *
     * @param int|null    $priority  Priority level to filter by (optional).
     * @param string|null $dateStart Start date in a format recognized by Carbon (optional).
     * @param string|null $dateEnd   End date in a format recognized by Carbon (optional).
     *
     * @return \Illuminate\Support\Collection List of Pessoa objects filtered according to the given criteria.
     */
    function index($priority = null, $dateStart = null, $dateEnd = null) {

        $query = Pessoa::where('was_attended', 0);

        if (!is_null($priority)) {
            $query->where('priority', $priority);
        }

        if (!is_null($dateStart) && !is_null($dateEnd)) {

            $query->whereBetween('created_at', [
                Carbon::parse($dateStart)->startOfDay(),
                Carbon::parse($dateEnd)->endOfDay()
            ]);

        } elseif (!is_null($dateStart)) {

            $query->where('created_at', '>=', Carbon::parse($dateStart)->startOfDay());
        } elseif (!is_null($dateEnd)) {

            $query->where('created_at', '<=', Carbon::parse($dateEnd)->endOfDay());
        }

        $queue =  $query->orderBy('priority', 'asc')
                     ->orderBy('id', 'asc')
                     ->paginate(10);

        return view('queue.index', compact('queue'));
    }

    /**
     * Set the attended status for a person.
     *
     * @param int $personId
     * @param bool $attended true to mark as attended, false to revert
     * @return bool true if updated, false if not found
     */
    function setAttendedStatus(Request $request) {

        $person = Pessoa::find($request->person_id);

        if ($person) {
            $person->was_attended = $request->attended;
            $person->save();
            return redirect()->route('queue.index')->with('success', 'Marcado como atendido com sucesso!');
        }

        return redirect()->route('queue.index')->with('Error', 'Erro ao marcar como atendido!');
        
    }

    public function setPriority(Request $request)
    {
    
        $person = Pessoa::find($request->person_id);
        $person->priority = $request->priority;
        $person->save();

        return redirect()->route('queue.index')->with('success', 'Prioridade atualizada com sucesso!');
    }
}
