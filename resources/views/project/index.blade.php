<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-10 mb-4 ms-3">Projetos</h2>
        <a class="btn btn-primary ms-3 me-5" href="{{ route('project.create') }}">Cadastrar Novo Projeto</a>
        <div class="flex row mt-5 justify-content-center items-center">
            <form action="{{ route('project.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-input-label for="nameProject" class="mt-3 ms-3 mb-3">
                    Nome:&nbsp;
                    <x-text-input minleght="3" type="text" name="nameProject" id="nameProject">
                    </x-text-input>
                </x-input-label>
                <x-input-label for="dateStarted" class="mt-3 ms-3 mb-3">
                    Data Início:&nbsp;
                    <x-text-input type="date" name="dateStarted" id="dateStarted">
                    </x-text-input>
                </x-input-label>
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Filtrar</x-secondary-button>
            </form>
            <form action="{{ route('project.index')}}" method="get" class="flex row justify-content-center items-center">
                <x-secondary-button type="submit" class="ms-5 max-h-[25px]">Limpar Filtro</x-secondary-button>
            </form>
        </div>
        <div class="overflow-auto mx-auto max-h-[700px]">
            <table class="table w-full text-left ">
                <thead>
                    <tr>
                        <th class="w-1/6 px-4 py-2">Nome</th>
                        <th class="w-1/6 px-4 py-2">Data Início</th>
                        <th class="w-1/6 px-4 py-2">Data Término</th>
                        <th class="w-1/6 px-4 py-2">Responsável</th>
                        <th class="w-1/6 px-4 py-2">Status</th>
                        <th class="w-1/6 px-4 py-2">Última atualização</th>
                        <th class="w-1/6 px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr class="hover:bg-gray-900/50">
                        <td class="px-4 py-2 truncate">
                            {{ $project->name }}
                        </td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($project->date_started)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $project->date_finished ? \Carbon\Carbon::parse($project->date_finished)->format('d/m/Y') : 'Em andamento' }}
                        </td>
                        <td class="px-4 py-2 truncate">
                            {{ $project->responsible->name ?? 'Não definido' }}
                        </td>
                        <td class="px-4 py-2 truncate">
                            <span class="badge {{ $project->is_activated ? 'badge-success' : 'badge-error' }}">
                                {{ $project->is_activated ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($project->updated_at)->format('d/m/Y') }}
                        </td>
                        <td>
                            <a href="{{ route('project.edit', ['project' => $project]) }}" class="btn btn-ghost btn-xs">Editar</a>
                            <a href="{{ route('project.show', ['project' => $project]) }}" class="btn btn-info btn-xs">Detalhes</a>
                            <form action="{{ route('project.toggleActivation', ['project' => $project]) }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn {{ $project->is_activated ? 'btn-warning' : 'btn-success' }} btn-xs">
                                    {{ $project->is_activated ? 'Desativar' : 'Ativar' }}
                                </button>
                            </form>
                            <form action="{{ route('project.destroy', ['project' => $project]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja apagar este projeto?')">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex align-items-start">
            @include('paginator', ['paginator' => $projects])
        </div>
    </main>
</x-app-layout>