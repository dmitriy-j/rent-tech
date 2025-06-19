@extends('layouts.app')

@section('title', 'Мои документы')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Мои документы</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left">Название документа</th>
                    <th class="py-3 px-4 text-left">Дата</th>
                    <th class="py-3 px-4 text-left">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $document['name'] }}</td>
                    <td class="py-3 px-4">{{ $document['date'] }}</td>
                    <td class="py-3 px-4">
                        <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="fas fa-eye"></i> Просмотреть
                        </a>
                        <a href="#" class="text-green-600 hover:text-green-800">
                            <i class="fas fa-download"></i> Скачать
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
