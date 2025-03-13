<section class="d-flex justify-center align-center">
    <header class="d-flex justify-center align-center">
        <h2 class="text-lg font-medium  text-base-content">
            {{ __('Register Information') }}
        </h2>
        <p class="mt-1 text-sm text-base-content">
            {{ __("Update register informations.") }}
        </p>
    </header>
    <form method="post" action="{{ route('pessoa.update',['pessoa'=>$pessoa]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @include('people.partials.person-form')
    </form>
</section>
