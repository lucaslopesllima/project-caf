<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <section class="d-flex justify-center align-center">
        <script defer>
            const pessoas = [{
                    id: 1,
                    nome: "João Silva"
                },
                {
                    id: 2,
                    nome: "Maria Souza"
                },
                {
                    id: 3,
                    nome: "Carlos Lima"
                }
            ];

            const questionarios = [{
                    id: 1,
                    titulo: "Avaliação Inicial",
                    perguntas: [{
                            id: 101,
                            texto: "Como você se sente hoje?",
                            tipo: "texto"
                        },
                        {
                            id: 102,
                            texto: "Está com dores?",
                            tipo: "sim_nao"
                        }
                    ]
                },
                {
                    id: 2,
                    titulo: "Retorno Mensal",
                    perguntas: [{
                            id: 201,
                            texto: "Houve evolução?",
                            tipo: "sim_nao"
                        },
                        {
                            id: 202,
                            texto: "Observações:",
                            tipo: "texto"
                        }
                    ]
                }
            ];

            function popularSelect(id, dados) {
                const select = document.getElementById(id);
                dados.forEach(d => {
                    const option = document.createElement("option");
                    option.value = d.id;
                    option.textContent = d.nome || d.titulo;
                    select.appendChild(option);
                });
            }

            function mostrarFormulario() {
                const qid = parseInt(document.getElementById("questionario").value);
                const container = document.getElementById("formulario");
                container.innerHTML = "";

                const questionario = questionarios.find(q => q.id === qid);
                if (!questionario) return;

                questionario.perguntas.forEach(pergunta => {
                    const wrapper = document.createElement("div");
                    wrapper.className = "mb-4";

                    const label = document.createElement("label");
                    label.className = "block font-medium text-gray-700 mb-1";
                    label.textContent = pergunta.texto;

                    wrapper.appendChild(label);

                    let input;
                    if (pergunta.tipo === "texto") {
                        input = document.createElement("input");
                        input.type = "text";
                        input.className = "w-full border rounded px-3 py-2";
                    } else if (pergunta.tipo === "sim_nao") {
                        input = document.createElement("select");
                        input.className = "w-full border rounded px-3 py-2";
                        input.innerHTML = `
            <option value="">Selecione</option>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
          `;
                    }

                    input.name = `resposta_${pergunta.id}`;
                    wrapper.appendChild(input);
                    container.appendChild(wrapper);
                });

                document.getElementById("submitBtn").classList.remove("hidden");
            }

            function enviarRespostas(e) {
                e.preventDefault();
                const pessoaId = document.getElementById("pessoa").value;
                const questionarioId = document.getElementById("questionario").value;
                const respostas = {};

                document.querySelectorAll("#formulario [name^=resposta_]").forEach(input => {
                    respostas[input.name] = input.value;
                });

                console.log("Enviando dados para o servidor:");
                console.log({
                    pessoaId,
                    questionarioId,
                    respostas
                });

                alert("Respostas enviadas com sucesso!");
            }

            window.addEventListener("DOMContentLoaded", () => {
                popularSelect("pessoa", pessoas);
                popularSelect("questionario", questionarios);
            });
        </script>

        <div class="max-w-xl mx-auto bg-white shadow p-6 rounded-xl space-y-6">
            <h1 class="text-2xl font-bold text-gray-800">Responder Questionário</h1>

            <!-- Pessoa -->
            <div>
                <label for="pessoa" class="block text-sm font-medium text-gray-700 mb-1">Pessoa</label>
                <select id="pessoa" class="w-full border rounded px-3 py-2">
                    <option value="">Selecione uma pessoa</option>
                </select>
            </div>

            <!-- Questionário -->
            <div>
                <label for="questionario" class="block text-sm font-medium text-gray-700 mb-1">Questionário</label>
                <select id="questionario" onchange="mostrarFormulario()" class="w-full border rounded px-3 py-2">
                    <option value="">Selecione um questionário</option>
                </select>
            </div>

            <!-- Formulário dinâmico -->
            <form onsubmit="enviarRespostas(event)">
                <div id="formulario"></div>
                <button type="submit" id="submitBtn" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hidden">
                    Enviar Respostas
                </button>
            </form>
        </div>

        <div class="flex items-center justify-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
        </form>
    </section>
</div>