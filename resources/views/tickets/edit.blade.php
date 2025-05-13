<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Ticket
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('tickets.update', $ticket) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Título</label>
                        <input type="text" name="title" id="title" value="{{ $ticket->title }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Descrição</label>
                        <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded mt-1" required>{{ $ticket->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded mt-1">
                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Aberto</option>
                            <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Fechado</option>
                        </select>
                    </div>

                    <div>
                        <button style="background: blue" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
                        <a href="{{ route('tickets.index') }}" class="ml-4 text-gray-600">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
