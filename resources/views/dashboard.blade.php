<x-app-layout>
    <main class="flex-1 p-6 ">
        <h2 class="text-2xl font-bold mt-4">Seja Bem vindo, {{ Auth::user()->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div class="card bg-base-200 p-4">Você não possui pagamentos pendentes</div>
            <div class="card bg-base-200 p-4">Você não possui vendas para enviar</div>
            <div class="card bg-base-200 p-4">Você não possui vendas para empacotar</div>
        </div>
        <h3 class="text-xl font-bold mt-6">Configurações adicionais</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div class="card bg-base-200 p-4">
                <h4 class="font-bold">Frete grátis</h4>
                <p>Configure o frete grátis e conquiste mais clientes.</p>
                <a href="#" class="link link-primary">Configurar</a>
            </div>
            <div class="card bg-base-200 p-4">
                <h4 class="font-bold">Sua loja em ordem</h4>
                <p>Organize seus produtos para que seus clientes possam encontrá-los facilmente.</p>
                <a href="#" class="link link-primary">Organizar</a>
            </div>
            <div class="card bg-base-200 p-4">
                <h4 class="font-bold">Carrinhos abandonados</h4>
                <p>Recupere vendas ao configurar e-mails para os clientes que abandonaram suas compras.</p>
                <a href="#" class="link link-primary">Configurar</a>
            </div>
        </div>
    </main>
</x-app-layout>