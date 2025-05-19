<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-5 mb-4 ">Fila de espera</h2>
        <div class="flex row ms-10 justify-content-center items-center">
            <form action="{{ route('queue.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="namePerson" class="mt-3 ms-3 mb-3">
                    Nome:&nbsp;
                    <x-text-input minleght="3"  value="{{ request('namePerson') }}" type="text" name="namePerson" id="namePerson">
                    </x-text-input>
                </x-input-label>
                <select name="priority" class="focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ms-5" style="border: 1px solid  #cecece;">
                    <option value="">-- Prioridade --</option>
                    <option value="1" {{ request('priority') == 1 ? 'selected' : '' }}>1 - Alta</option>
                    <option value="2" {{ request('priority') == 2 ? 'selected' : '' }}>2 - Média</option>
                    <option value="3" {{ request('priority') == 3 ? 'selected' : '' }}>3 - Baixa</option>
                </select>
                <x-input-label for="dateStart" class="mt-3 ms-3 mb-3">
                    Data Inicio:&nbsp;
                    <x-text-input  type="text" name="dateStart" id="dateStart" value="{{ request('dateStart') }}">
                    </x-text-input>
                </x-input-label>
                <x-input-label for="dateEnd" class="mt-3 ms-3 mb-3">
                    Data Fim:&nbsp;
                    <x-text-input type="text" name="dateEnd" id="dateEnd" value="{{ request('dateEnd') }}">
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('queue.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto ms-10 me-10 h-max-[600px]">
            <table class="table w-full text-left">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Posição</th>
                        <th class="w-1/6 px-4 py-2">Nome do questionario</th>
                        <th class="w-1/6 px-4 py-2">Prioridade</th>
                        <th class="w-1/6 px-4 py-2">Cadastrado em</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $priorityLabels = [
                            1 => '1 - Prioridade Alta',
                            2 => '2 - Prioridade Média',
                            3 => '3 - Prioridade Baixa',
                        ];
                    @endphp
                    @foreach ($queue as $person)
                    <tr class="hover:bg-gray-900/50">
                        <td class="px-4 py-2 max-w-32">
                            {{ $person->posicao }}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{$person->nome}}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{ $priorityLabels[$person->priority] ?? 'Sem prioridade' }}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{  \Carbon\Carbon::parse($person->created_at)->format('d/m/Y')}}
                        </td>
                        <td class="flex">
                            <form method="POST" id="form-update-priority-{{$person->id}}" action="{{ route('queue.setPriority')}}">
                                @csrf
                                <button onclick="askForPriority('{{$person->id}}')" class="btn btn-ghost btn-xs" type="button">Editar prioridade</button>
                                <input type="hidden" name="priority" id="priority{{$person->id}}" >
                                <input type="hidden" name="person_id" value="{{$person->id}}">
                            </form>
                            <form method="POST" action="{{ route('queue.setAttended')}}">
                                @csrf
                                <input type="hidden" name="person_id" value="{{$person->id}}">
                                <input type="hidden" name="attended" value="1">
                                <button class="btn btn-danger btn-xs" type="submit">Marcar Atendido</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="flex align-items-start ms-12">
            @include('paginator', ['paginator' => $queue])
        </div>
    </main>
</x-app-layout>

<script>
    async function askForPriority(personId) {
        event.preventDefault();
        const { value: priority, isConfirmed } = await Swal.fire({
            title: 'Definir Prioridade',
            input: 'number',
            inputLabel: '1 - Prioridade Alta\n2 - Prioridade Média\n3 - Prioridade Baixa',
            inputAttributes: {
                min: 1,
                step: 1
            },
            inputValidator: (value) => {
                if (!value) return 'Você precisa inserir um valor!';
                if (isNaN(value) || value < 1) return 'Digite um número válido maior que zero!';
                if (value != 1 && value != 2 && value != 3) return 'Informe uma prioridade válida!';
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        });

        if (isConfirmed) {
            document.getElementById('priority'+personId).value = priority;
            document.getElementById('form-update-priority-'+personId).submit();
        }
    }

    flatpickr("#dateStart", {
        dateFormat: "d/m/Y", 
        locale: "pt" 
    });

    flatpickr("#dateEnd", {
        dateFormat: "d/m/Y", 
        locale: "pt" 
    });
</script>
