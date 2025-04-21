<div>
    <label for="pessoa" class="block text-md font-medium text-gray-700 mb-1">Pessoa</label>
    <select id="pessoa" name="personId" class="min-w-[550px] border rounded px-3 py-2">
        <option value="">Selecione uma pessoa</option>
        @foreach ($people as $person)
        <option value="{{$person->id}}">{{ $person->nome }}</option>
        @endforeach
    </select>
    <p id="pessoa-error" class="text-red-500 text-sm mt-1 hidden">Por favor, selecione uma pessoa</p>
</div>
<div class="mt-4">
    <label for="questionario" class="block text-md font-medium text-gray-700 mb-1">Questionário</label>
    <select id="questionario" name="questionnaireId" onchange="validateAndShowForm()" class="min-w-[550px] border rounded px-3 py-2">
        <option value="">Selecione um questionário</option>
        @foreach ($questionnaires as $questionnaire)
        <option value="{{$questionnaire->id}}">{{ $questionnaire->nome }}</option>
        @endforeach
    </select>
    <p id="questionario-error" class="text-red-500 text-sm mt-1 hidden">Por favor, selecione um questionário</p>
</div>
<div id="loading" class="mt-4 text-center hidden">
    <p>Carregando perguntas...</p>
</div>
<div id="formulario" name="respostas[]"></div>
<div id="form-error" class="text-red-500 text-sm mt-2 mb-2 hidden">Por favor, preencha todos os campos obrigatórios</div>
<button type="button" onclick="sendAnswer(event)" id="submitBtn" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hidden">
    Enviar Respostas
</button>
<script>
    // Validar seleções e exibir o formulário
    function validateAndShowForm() {
        const pessoaId = document.getElementById("pessoa").value;
        const pessoaError = document.getElementById("pessoa-error");

        if (!pessoaId) {
            pessoaError.classList.remove("hidden");
            return;
        } else {
            pessoaError.classList.add("hidden");
        }

        const questionarioId = document.getElementById("questionario").value;
        if (questionarioId) {
            showForm();
        }
    }

    async function showForm() {

        const questionarioId = document.getElementById("questionario").value;
        const questionarioError = document.getElementById("questionario-error");

        if (!questionarioId) {
            questionarioError.classList.remove("hidden");
            return;
        } else {
            questionarioError.classList.add("hidden");
        }

        const container = document.getElementById("formulario");
        const loading = document.getElementById("loading");

        container.innerHTML = "";

        loading.classList.remove("hidden");

        try {
            const response = await fetch(`/getWholeQuestions/${questionarioId}`);

            if (!response.ok) {
                throw new Error(`Erro ao carregar perguntas: ${response.status}`);
            }

            const data = await response.json();

            if (data.questions && data.questions.length > 0) {

                data.questions.forEach(pergunta => {
                    const wrapper = document.createElement("div");
                    wrapper.className = "mb-4";

                    const label = document.createElement("label");
                    label.className = "block font-medium text-gray-700 mb-1";
                    label.textContent = pergunta.texto;

                    if (pergunta.obrigatorio) {
                        const required = document.createElement("span");
                        required.className = "text-red-500 ml-1";
                        required.textContent = "*";
                        label.appendChild(required);
                    }

                    wrapper.appendChild(label);

                    let input;
                    if (pergunta.type === "text") {

                        input = document.createElement("input");
                        input.type = "text";
                        input.className = "w-full border rounded px-3 py-2";
                        if (pergunta.obrigatorio) {
                            input.required = true;
                        }

                    } else if (pergunta.type === "alternative") {

                        input = document.createElement("select");
                        input.className = "w-full border rounded px-3 py-2";

                        const defaultOption = document.createElement("option");
                        defaultOption.value = "";
                        defaultOption.textContent = "Selecione";
                        input.appendChild(defaultOption);

                        const simOption = document.createElement("option");
                        simOption.value = "sim";
                        simOption.textContent = "Sim";
                        input.appendChild(simOption);

                        const naoOption = document.createElement("option");
                        naoOption.value = "nao";
                        naoOption.textContent = "Não";
                        input.appendChild(naoOption);

                        if (pergunta.obrigatorio) {
                            input.required = true;
                        }
                    }

                    input.name = `resposta_${pergunta.id}`;
                    input.dataset.questionId = pergunta.id;
                    input.dataset.required = pergunta.obrigatorio ? "true" : "false";

                    wrapper.appendChild(input);
                    container.appendChild(wrapper);
                });

                document.getElementById("submitBtn").classList.remove("hidden");
            } else {
                container.innerHTML = "<p class='text-gray-500'>Nenhuma pergunta encontrada para este questionário.</p>";
            }
        } catch (error) {
            console.error("Erro ao carregar as perguntas:", error);
            container.innerHTML = `<p class='text-red-500'>Erro ao carregar as perguntas. Por favor, tente novamente.</p>`;
        } finally {
            loading.classList.add("hidden");
        }
    }

    async function sendAnswer(e) {

        e.preventDefault();

        const pessoaId = document.getElementById("pessoa").value;
        const questionarioId = document.getElementById("questionario").value;
        const formError = document.getElementById("form-error");

        if (!pessoaId || !questionarioId) {
            if (!pessoaId) {
                document.getElementById("pessoa-error").classList.remove("hidden");
            }

            if (!questionarioId) {
                document.getElementById("questionario-error").classList.remove("hidden");
            }

            return;
        }

        try {

            const inputs = document.querySelectorAll("#formulario [name^=resposta_]");
            const answer = {};
            let hasError = false;

            inputs.forEach(input => {
                const isRequired = input.dataset.required === "true";
                const value = input.value.trim();

                if (isRequired && !value) {
                    input.classList.add("border-red-500");
                    hasError = true;
                } else {
                    input.classList.remove("border-red-500");
                    const questionId = input.dataset.questionId;
                    answer[questionId] = value;
                }
            });

            if (hasError) {
                formError.classList.remove("hidden");
                return;
            } else {
                formError.classList.add("hidden");
            }

            document.getElementById('formAnswer').submit();

        } catch (error) {
            console.error("Erro ao enviar respostas:", error);
            alert("Ocorreu um erro ao enviar as respostas. Por favor, tente novamente.");
        } 
    }
</script>