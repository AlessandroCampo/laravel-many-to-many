<?php

$form_classes = 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';

?>



<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-2 items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase">
                Crea un nuovo progetto
            </h2>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between p-6">
                <form class="max-w-sm" method="POST" action="{{ route('projects.store') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="title" class="block mb-2 text-sm text-gray-900 dark:text-white font-bold">
                            Project Title</label>
                        <input type="text" name="title" id="title" class="{{ $form_classes }}"
                            placeholder="Inserisci qui il titolo" required />
                        @error('title')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Project Description </label>
                        <textarea name="description" id="description" cols="30" rows="5" class="{{ $form_classes }}"> {{ old('description') }} </textarea>
                    </div>
                    @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div class="mb-5">
                        <label for="technologies" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Project Technologies </label>
                        <div class="checkbox-container flex flex-col gap-3">
                            @foreach ($technologies as $technology)
                                <div class="flex items-center gap-4">
                                    <input type="checkbox" name="technologies[]" id="technology_{{ $technology->id }}"
                                        value="{{ $technology->id }}">
                                    <label for="technology_{{ $technology->id }}"
                                        class="capitalize flex items-center gap-3"><img
                                            src="{{ $technology->logo_url }}" alt="" class="w-[20px]">
                                        <span>
                                            {{ $technology->name }}
                                        </span>
                                    </label><br>
                                </div>
                            @endforeach
                        </div>


                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="thumb" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">
                            Project Thumb </label>
                        <input type="text" name="thumb" id="thumb" class="{{ $form_classes }}"
                            value="{{ old('thumb') }}">
                        @error('thumb')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
