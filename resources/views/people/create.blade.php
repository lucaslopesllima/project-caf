<section class="d-flex justify-center align-center">
    <header class="d-flex justify-center align-center">
        <h2 class="text-lg font-medium  text-base-content">
            {{ __('Add new beneficiary') }}
        </h2>
    </header>
    <form method="post" action="{{ route('pessoa.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        @include('people.partials.person-form')
    </form>
</section>
