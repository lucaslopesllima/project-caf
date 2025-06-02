<x-app-layout>
    <x-backward-button href="{{ route('project.index') }}"></x-backward-button>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projetos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section class="d-flex justify-center align-center">
                <header class="d-flex justify-center align-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Adicionar novo projeto') }}
                    </h2>
                </header>
                <form method="post" action="{{ route('project.store') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
                    @include('project.partials.form')
                </form>
            </section>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const responsibleTypeSelect = document.getElementById('responsible_type');
            const responsibleIdSelect = document.getElementById('responsible_id');

            function loadResponsibles() {
                const type = responsibleTypeSelect.value;
                if (!type) return;

                responsibleIdSelect.innerHTML = '<option value="">Carregando...</option>';

                fetch(`/api/responsibles?type=${type}`)
                    .then(response => response.json())
                    .then(data => {
                        responsibleIdSelect.innerHTML = '<option value="">Selecione o responsável</option>';
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;
                            responsibleIdSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Erro ao carregar responsáveis:', error);
                        responsibleIdSelect.innerHTML = '<option value="">Erro ao carregar</option>';
                    });
            }

            responsibleTypeSelect.addEventListener('change', loadResponsibles);

            if (responsibleTypeSelect.value) {
                loadResponsibles();
            }
        });
    </script>
    @endpush
</x-app-layout>