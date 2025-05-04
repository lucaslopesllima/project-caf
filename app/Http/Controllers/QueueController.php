<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    function index(Request $request) {
        
            $where = ['was_attended' => 0];
        
            $sql = "
                SELECT *
                FROM (
                    SELECT 
                        id,
                        nome,
                        priority,
                        created_at,
                        ROW_NUMBER() OVER (ORDER BY priority ASC, id ASC) AS posicao
                    FROM pessoas
                    WHERE was_attended = :was_attended";
        
            $bindings = ['was_attended' => 0];
        
            if (!is_null($request->priority)) {

                $sql .= " AND priority = :priority";
                $bindings['priority'] = $request->priority;
            }
        
            if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

                $sql .= " AND created_at BETWEEN :startDate AND :endDate";
                $bindings['startDate'] = Carbon::parse($request->dateStart)->startOfDay()->toDateTimeString();
                $bindings['endDate'] = Carbon::parse($request->dateEnd)->endOfDay()->toDateTimeString();

            } elseif (!is_null($request->dateStart)) {

                $sql .= " AND created_at >= :startDate";
                $bindings['startDate'] = Carbon::parse($request->dateStart)->startOfDay()->toDateTimeString();
            } elseif (!is_null($request->dateEnd)) {
                
                $sql .= " AND created_at <= :endDate";
                $bindings['endDate'] = Carbon::parse($request->dateEnd)->endOfDay()->toDateTimeString();
            }
        
            $sql .= ") AS fila";
        
            if (!is_null($request->namePerson)) {
                $sql .= " WHERE nome LIKE :namePerson";
                $bindings['namePerson'] = '%' . $request->namePerson . '%';

            }
        
            $perPage = 10;
            $currentPage = $request->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
        
            $paginated = collect(DB::select("$sql LIMIT $perPage OFFSET $offset", $bindings));
        
            $total = count(DB::select($sql, $bindings));
        
            $queue = new \Illuminate\Pagination\LengthAwarePaginator(
                            $paginated,
                            $total,
                            $perPage,
                            $currentPage,
                            ['path' => $request->url(), 'query' => $request->query()]
                        );
        
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
