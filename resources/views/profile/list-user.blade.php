<x-app-layout>
    <main class="w-full">
        <h2 class="text-2xl font-bold ms-10 mt-4 mb-4 ms-3">Usuário Cadastrados</h2>
        <a class="btn btn-primary ms-3" href="{{ route('register') }}">Cadastrar</a>
        <div class="overflow-y-auto overflow-x-auto ms-10 h-[650px]"">
            <table class="table">
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
                    <tr class="hover:bg-gray-900/50">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img
                                            src="{{ asset('storage/imagens' . $user->profile_image_path) }}"
                                            alt="Foto de perfil" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{$user->name}}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            Gerente de projetos
                        </td>
                        <td>{{$user->email}}</td>
                        <th align="right">
                            <a  href="{{ route('profile.edit',['profile'=>$user]) }}" class="btn btn-ghost btn-xs">Editar</a>
                        </th>
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