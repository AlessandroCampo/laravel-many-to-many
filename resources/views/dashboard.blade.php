@php
    use App\Models\Stack;
@endphp

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between p-6 flex-wrap">
                @foreach ($projects as $projectData)
                    @php
                        $stack = Stack::find($projectData['stack_id']);
                    @endphp
                    <div
                        class="card flex items-center gap-4 flex-col w-[300px] bg-zinc-800  text-white py-5  px-8 rounded-xl  my-4">
                        <img src="{{ $projectData['thumb'] }}" class="w-[200px] h-[100px]">
                        <div class="flex items-center gap-2">
                            <h2 class="text-xl font-semibold"> {{ $projectData['title'] }}</h2>
                        </div>

                        <p class="text-sm text-center">
                            {{ $projectData['description'] }}
                        </p>

                        <div class="tech-container flex gap-3 items-center">
                            @foreach ($projectData->technologies as $technology)
                                <img src="{{ $technology->logo_url }}" alt="{{ $technology->name }}" class="w-[50px]">
                            @endforeach
                        </div>


                        <div class="actions flex gap-2 items-center">
                            <a href="{{ route('projects.show', ['project' => $projectData]) }}"
                                class="bg-blue-600 rounded-lg w-[80px] py-1 text-center">Show</a>
                            <a href="{{ route('projects.edit', ['project' => $projectData]) }}"
                                class="bg-yellow-600 rounded-lg w-[80px] py-1 text-center">Edit</a>

                            <form action="{{ route('projects.destroy', ['project' => $projectData]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-700 rounded-lg w-[80px] py-1 text-center">Delete</button>
                            </form>


                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
