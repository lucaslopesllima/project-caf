@extends('layouts.guest2')
@section('content')
<div class="flex flex-row items-center">
    <div class="flex flex-col me-40" style="width: 34rem;">
        <p class="text-base-content   font-bold text-2xl mb-10" >{{__('NEED A SYSTEM, E-COMMERCE, WEBSITE, BLOG OR OFFICE AUTOMATION?')}}</p>
        <p class="text-base-content ">{{__('Dymob is a company specialized in software development, prepared to meet your needs.')}}</p>
        <h3 class="text-base-content ">{{__('What do we need to know for an accurate budget?')}}</h3>
        <ul class="ms-8 list-disc">
            <li class="text-base-content ">
                <span class="text-base-content  font-bold" style="color:#27c6d9;">{{__('Automations')}}:</span>
                {{__('Describe how what needs to be automated works')}}
            </li>
            <li class="text-base-content "><span style="color:#27c6d9;" class="text-base-content  font-bold">{{__('Custom systems')}}:</span>
                {{__('Briefly describe which features may/should be necessary;')}}
            </li>
            <li class="text-base-content "><span style="color:#27c6d9;" class="text-base-content  font-bold">{{ __('Institutional website')}}:</span>
                {{__('Tell me a little about how the site is imagined')}}
            </li>
        </ul>
    </div>
    <div class="flex ms-5">
        <form class="flex flex-col" method="post" action="{{ route('budget.store') }}">
            <div class="w-full flex justify-end">
                <x-application-logo></x-application-logo>
            </div>
            @csrf
            <x-input-label class="text-base-content ">
                <x-text-input placeholder="{{__('Name')}}" name="name" class="input input-bordered w-full "></x-text-input>
            </x-input-label>
            <br>
            <x-input-label class="text-base-content ">
                <x-text-input placeholder="{{__('Telephone')}}" name="telefone" class="input input-bordered w-full "></x-text-input>
            </x-input-label>
            <br>
            <x-input-label class="text-base-content ">
                <x-text-input placeholder="{{__('E-mail')}}" name="email" class="input input-bordered w-full "></x-text-input>
            </x-input-label>
            <br>
            <x-input-label class="mb-10 text-base-content ">
                <textarea
                    cols="37"
                    placeholder="{{__('Description')}}"
                    class="textarea textarea-bordered border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  w-full text-base-content"
                    name="description"></textarea>
            </x-input-label>
            <button class="btn btn-info" type="submit"> {{ __('Request a quote') }}</button>
        </form>
    </div>
</div>
<div class="flex flex-row items-start w-full">
    <div class="self-start">
        <img src="{{$gif}}" height="150" width="150"  alt="" srcset="">
    </div>
    <div class="flex flex-col items-center justify-self-center flex-1 self-center">
        <p class="text-base-content">Sua Visão, nosso código.</p>
        <p class="text-base-content">dymob.com.br – 2025 | Todos os direitos reservados | By Dymob</p>
    </div>
</div>
@endsection