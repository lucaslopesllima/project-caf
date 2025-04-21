<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-4 mb-4 ms-3">Usuário Cadastrados</h2>
        <a class="btn btn-primary ms-3" href="{{ route('register') }}">Cadastrar</a>
        <div class="overflow-y-auto overflow-x-auto ms-10 h-[650px]">
            <table class="table min-h-32 ">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Contato</th>
                        <th align="right">Ação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-900/50 ">
                        <td >
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{$user->name}}</div>
                                </div>
                            </div>
                        </td>
                        <td >
                            {{$user->role}}
                        </td>
                        <td >{{$user->email}}</td>
                        <td align="right" >
                            <a  href="{{ route('profile.edit',['profile'=>$user->id]) }}" class="btn btn-ghost btn-xs">Editar</a>
                            @if (auth()->user()->id != $user->id)
                                <form action="{{ route('profile.destroy', ['profile' => $user]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" value="{{$user->id}}"> 
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Tem certeza que deseja apagar?')">
                                            Apagar
                                        </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Contato</th>
                        <th align="right">Ação</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</x-app-layout>