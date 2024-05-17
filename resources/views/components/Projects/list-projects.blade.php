<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Projetos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<div class="flex justify-center">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="overflow-auto">
            <form id="multi-delete-form" action="{{ route('projects.deleteSelected') }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_ids" id="selected-ids">
                <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-button hidden" title="Remover" onclick="return confirm('Tem certeza que deseja excluir os projetos selecionados?')">
                    <i class="fas fa-trash-alt text-lg"></i>
                </button>
            </form>
            <a href="{{ route('projects.create') }}" class="text-gray-800 hover:text-green-900 ml-2" title="Adicionar">
                <i class="fas fa-plus text-lg"></i>
            </a>

            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        <label for="select-all-checkbox">
                            <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Endereço
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Status do Projeto
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Distrito
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        País
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($projects as $project)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $project->id }}" class="form-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-medium text-gray-900">{{ $project->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $project->address }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $project->projectstatus->status_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $project->district->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $project->country->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Editar">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2" title="Remover">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            Nenhum projeto encontrado.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const checkboxes = document.querySelectorAll('.form-checkbox');
        const multiDeleteForm = document.getElementById('multi-delete-form');
        const selectedIdsInput = document.getElementById('selected-ids');
        const deleteButton = document.querySelector('.delete-button');

        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedIds();
            toggleDeleteButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedIds();
                toggleDeleteButton();
            });
        });

        function updateSelectedIds() {
            const selectedIds = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedIds.push(checkbox.value);
                }
            });
            selectedIdsInput.value = JSON.stringify(selectedIds);
        }

        function toggleDeleteButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteButton.classList.toggle('hidden', !anyChecked);
        }
    });
</script>
</body>

</html>
