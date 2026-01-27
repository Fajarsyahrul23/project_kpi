@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">BPD Management</h1>
            <div class="space-x-2">
                <a href="{{ route('bpd.export.pdf') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow transition duration-150 z-10 relative">
                    Export PDF
                </a>
                <button onclick="toggleModal('createModal')" type="button"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow transition duration-150 z-10 relative">
                    Create BPD
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg relative z-0">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No BPD
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Objective
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bpds as $bpd)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $bpd->no_bpd }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ Str::limit($bpd->objective, 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 relative z-10">
                                <a href="{{ route('kpi.index', $bpd->id_bpd) }}"
                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full inline-block">Measurements</a>
                                <button onclick="openEditModal({{ $bpd }})"
                                    class="text-yellow-600 hover:text-yellow-900 inline-block cursor-pointer">Edit</button>
                                <button onclick="openDeleteModal({{ $bpd->id_bpd }}, '{{ $bpd->no_bpd }}')"
                                    class="text-red-600 hover:text-red-900 inline-block cursor-pointer">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                No BPD records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $bpds->links() }}
        </div>

        <!-- Create Modal -->
        <div id="createModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" aria-hidden="true"
                    onclick="toggleModal('createModal')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('bpd.store') }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Create New BPD</h3>
                           <div class="mt-4 space-y-4">
    <!-- Select No BPD -->
    <div>
        <label for="create_no_bpd" class="block text-sm font-medium text-gray-700">
            No BPD
        </label>
        <select 
            name="no_bpd" 
            id="create_no_bpd" 
            required
            onchange="fillObjective(this.value, 'create_objective')"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
        >
            <option value="">Select BPD</option>
            @foreach($masterBpds as $master)
                <option value="{{ $master->no_bpd }}">
                    {{ $master->no_bpd }} - {{ Str::limit($master->objective, 30) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Objective (readonly, background abu-abu, tinggi sama seperti textarea) -->
    <div>
        <label for="create_objective" class="block text-sm font-medium text-gray-700">
            Objective
        </label>
        <input 
            type="text"
            id="create_objective"
            name="objective"
            readonly
            class="block w-full sm:text-sm border border-gray-300 rounded-md p-2 bg-gray-200 text-gray-700 cursor-not-allowed h-[76px]"
            placeholder="Objective otomatis mengikuti No BPD"
        >
    </div>
</div>

<!-- Buttons -->
<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    <button type="submit"
        class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:text-sm">
        Save
    </button>
    <button type="button" onclick="toggleModal('createModal')"
        class="mt-3 w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:text-sm">
        Cancel
    </button>
</div>

<!-- Script untuk isi Objective otomatis -->
<script>
    const objectives = {
        @foreach($masterBpds as $master)
            '{{ $master->no_bpd }}': "{{ addslashes($master->objective) }}",
        @endforeach
    };

    function fillObjective(noBpd, inputId) {
        document.getElementById(inputId).value = objectives[noBpd] || '';
    }
</script>

                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" onclick="toggleModal('editModal')">
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit BPD</h3>
                         <div class="mt-4 space-y-4">
    <div>
        <label for="edit_no_bpd" class="block text-sm font-medium text-gray-700">No BPD</label>
        <select name="no_bpd" id="edit_no_bpd" required
            onchange="fillObjective(this.value, 'edit_objective')"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
            <option value="">Select BPD</option>
            @foreach($masterBpds as $master)
                <option value="{{ $master->no_bpd }}">{{ $master->no_bpd }} -
                    {{ Str::limit($master->objective, 30) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="edit_objective" class="block text-sm font-medium text-gray-700">
            Objective
        </label>
        <input 
            type="text"
            id="edit_objective"
            name="objective"
            value="Objective otomatis mengikuti no BPD"
            readonly
            class="block w-full max-w-[1200px] sm:text-sm border border-gray-300 rounded-md p-2 bg-gray-200 text-gray-700 cursor-not-allowed h-[76px] text-ellipsis"
        >
    </div>
</div>

                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                            <button type="button" onclick="toggleModal('editModal')"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" onclick="toggleModal('deleteModal')">
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete BPD</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete BPD <strong id="delete_no_bpd"></strong>? This
                                            action cannot be undone and will delete all associated KPIs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                            <button type="button" onclick="toggleModal('deleteModal')"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const masterBpds = @json($masterBpds);

        function fillObjective(no_bpd, targetId) {
            const found = masterBpds.find(b => b.no_bpd == no_bpd);
            if (found) {
                document.getElementById(targetId).value = found.objective;
            }
        }

        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            modal.classList.toggle('hidden');
        }

        function openEditModal(bpd) {
            document.getElementById('edit_no_bpd').value = bpd.no_bpd;
            document.getElementById('edit_objective').value = bpd.objective;
            document.getElementById('editForm').action = `{{ url('bpd') }}/${bpd.id_bpd}`;
            toggleModal('editModal');
        }

        function openDeleteModal(id, no_bpd) {
            document.getElementById('delete_no_bpd').innerText = no_bpd;
            document.getElementById('deleteForm').action = `{{ url('bpd') }}/${id}`;
            toggleModal('deleteModal');
        }
    </script>
@endsection