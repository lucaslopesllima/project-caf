<div>
    <label for="pessoa" class="block text-md font-medium text-gray-700 mb-1">Pessoa</label>
    <select id="pessoa" class="min-w-[550px] border rounded px-3 py-2">
        <option value="">Selecione uma pessoa</option>
    </select>
</div>
<div>
    <label for="questionario" class="block text-md font-medium text-gray-700 mb-1">Questionário</label>
    <select id="questionario" onchange="showForm()" class="min-w-[550px] rounded px-3 py-2">
        <option value="">Selecione um questionário</option>
    </select>
</div>
<form onsubmit="sendAnswer(event)" style="display: flex; justify-content: center; align-items: center;">
    <div id="formulario"></div>
    <button type="submit" id="submitBtn" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hidden">
        Enviar Respostas
    </button>
</form>
<script>
    function showForm() {
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
            if (pergunta.tipo === "text") {

                input = document.createElement("input");
                input.type = "text";
                input.className = "w-full border rounded px-3 py-2";
            } else if (pergunta.tipo === "alternative") {

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
    
function sendAnswer(e) {
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


function popularSelect(id, dados) {
    const select = document.getElementById(id);
    dados.forEach(d => {
        const option = document.createElement("option");
        option.value = d.id;
        option.textContent = d.nome || d.titulo;
        select.appendChild(option);
    });
}


window.addEventListener("DOMContentLoaded", () => {
    popularSelect("pessoa", pessoas);
    popularSelect("questionario", questionarios);
});
</script>