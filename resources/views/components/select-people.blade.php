<div class="autocomplete-container" style="position: relative; width: 300px;">
    <input type="text" placeholder="Digite um nome..." id="autocomplete-" oninput="filtrarPessoas('')" onclick="mostrarDropdown('')">
    <div id="dropdown-" class="dropdown-options hidden" style="position: absolute; top: 100%; background: white; border: 1px solid #ccc; width: 100%; max-height: 150px; overflow-y: auto; z-index: 10;"></div>
</div>

<script>
  window.pessoasCache = window.pessoasCache || null;

  async function carregarPessoas() {
    if (window.pessoasCache === null) {
      const response = await fetch('/api/pessoas');
      window.pessoasCache = await response.json();
    }
  }

  async function filtrarPessoas(id) {
    await carregarPessoas();
    const input = document.getElementById('autocomplete-' + id);
    const dropdown = document.getElementById('dropdown-' + id);
    const valor = input.value.toLowerCase();

    dropdown.innerHTML = '';
    const resultados = window.pessoasCache.filter(p =>
      p.nome.toLowerCase().includes(valor)
    );

    if (valor === '' || resultados.length === 0) {
      dropdown.classList.add('hidden');
      return;
    }

    resultados.forEach(pessoa => {
      const item = document.createElement('div');
      item.textContent = pessoa.nome;
      item.onclick = () => {
        input.value = pessoa.nome;
        dropdown.classList.add('hidden');
        // opcional: setar ID em campo oculto
        if (document.getElementById('pessoa_id-' + id)) {
          document.getElementById('pessoa_id-' + id).value = pessoa.id;
        }
      };
      dropdown.appendChild(item);
    });

    dropdown.classList.remove('hidden');
  }

  function mostrarDropdown(id) {
    filtrarPessoas(id);
  }

  document.addEventListener('click', function (event) {
    document.querySelectorAll('.dropdown-options').forEach(el => el.classList.add('hidden'));
  });
</script>