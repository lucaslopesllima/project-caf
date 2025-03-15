<div class="mx-auto p-6 rounded-lg ">
    <x-text-input placeholder="Nome do questionario" name="name_questionnaire" value="{{$name_questionnrie??''}}" class="w-full p-2 border rounded mb-4" ></x-text-input>
    <input type="text" id="search" placeholder="Filtrar pergunta..." class="w-full p-2 border rounded mb-4" onkeyup="filterQuestions()">
        <ul id="questionList" style="overflow-x: auto; height: 350px;" class="space-y-2">
            @isset($questions_from_questionnaire)
                @foreach ($questions as $question)
                    <li class="flex items-center space-x-2">
                    <input type="checkbox" 
                               name="questions[]" 
                               value="{{ $question->id }}" 
                               class="question-checkbox"
                               {{ collect($questions_from_questionnaire)->contains('id', $question->id) ? 'checked' : '' }}>
                        <span>{{$question->texto}}</span>
                    </li>
                @endforeach
            @else
                @foreach ($questions as $question)
                    <li class="flex items-center space-x-2">
                        <input type="checkbox" name="questions[]" value="{{$question->id}}" class="question-checkbox">
                        <span>{{$question->texto}}</span>
                    </li>
                @endforeach
            @endisset
        </ul>
    <div class="flex justify-center w-full mt-3">
        <x-primary-button  class="mt-3">{{ __('Save') }}</x-primary-button>
    </div>
</div>

<script>
    function filterQuestions() {
        let input = document.getElementById("search").value.toLowerCase();
        let items = document.querySelectorAll("#questionList li");

        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? "flex" : "none";
        });
    }
</script>