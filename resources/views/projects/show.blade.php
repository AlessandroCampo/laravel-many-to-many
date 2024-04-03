<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-2 items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase">
                {{-- {{ __('Dashboard') }} --}}
                I miei progetti
            </h2>
            <a href="{{ route('projects.create') }}
            ">
                <i class="fa-solid fa-circle-plus text-xl text-cyan-600"></i>
            </a>
        </div>

    </x-slot>

    <div class="card-big flex flex-col gap-12 items-center my-5 bg-slate-900 text-white p-12 w-2/3 mx-auto">
        <h2 class="text-center text-3xl font-bold uppercase ">{{ $project->title }}</h2>
        <img src="{{ $project->thumb }}" alt="{{ $project->title }}" class="w-[400px]">
        <p class="text-xl">{{ $project->description }} </p>
        <div class="flex flex-col gap-3 items-center">
            <p class="text-2xl font-extrabold"> Tecnologie usate in questo progetto </p>
            <div class="flex">
                @foreach ($technologies as $technology)
                    <img src="{{ $technology->logo_url }}" alt="{{ $technology->name }}" class="w-[100px]">
                @endforeach

            </div>
        </div>
        <div class="actions flex gap-3 items-center justify-center">

            <a href="{{ route('projects.edit', ['project' => $project]) }}"
                class="bg-yellow-600 rounded-lg w-[80px] py-1 text-center">Edit</a>

            <form action="{{ route('projects.destroy', ['project' => $project]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-700 rounded-lg w-[80px] py-1 text-center">Delete</button>
            </form>
        </div>

    </div>

</x-app-layout>
