@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    KPI for BPD: {{ $bpd->no_bpd }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $bpd->objective }}
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
               <a href="{{ route('kpi.import.view', $bpd->id_bpd) }}"
   class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm
          text-sm font-medium text-gray-700 bg-white hover:bg-gray-50
          focus:outline-none transition duration-150 relative z-10">
    <!-- Upload Icon (hi-upload style) -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"fill="none"viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round"stroke-linejoin="round"stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0 0l-4-4m4 4l4-4"/></svg>
    <!-- Text -->
    <span>Import KPI</span>
</a>


<button onclick="toggleModal('createModal')" type="button"
    class="inline-flex items-center gap-2 px-4 py-2 rounded-md shadow-sm
           text-sm font-medium text-white
           bg-indigo-600 hover:bg-indigo-700
           focus:outline-none transition duration-150 relative z-10">
    
    <!-- ICON PLUS -->
    <svg xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4v16m8-8H4"/>
    </svg>

    <!-- TEXT -->
    <span>Create KPI</span>
</button>


            </div>
        </div>

        <!-- Table -->
        <div class="flex flex-col relative z-0">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No BPD</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Objective</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Definition</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Periode</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Target</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actual</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Com Target</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Com Actual</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Note</th>
                                    <th scope="col"
                                        class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kpis as $kpi)
                                    <tr>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kpi->bpd->no_bpd }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ Str::limit($kpi->bpd->objective, 20) }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ Str::limit($kpi->definition, 30) }}</td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $kpi->periode ? $kpi->periode->format('M-y') : '-' }}
                                        </td>
                                       <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kpi->target }}</td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kpi->actual }}</td>

<td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kpi->com_target_percent }}
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kpi->com_actual_percent }}
                                        </td> 
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ Str::limit($kpi->note, 15) }}</td>
<td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 relative z-10">

    <!-- EDIT KPI (SAMA DENGAN BPD) -->
    <button onclick="openEditModal(this)"
        data-kpi='@json($kpi)'
        class="text-yellow-500 hover:text-yellow-700 transition inline-block cursor-pointer"
        title="Edit KPI">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 inline-block"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L9.832 16.82a4.5 4.5 0 01-1.897 1.13l-2.685.805.805-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487zM19.5 7.125V19.5A2.25 2.25 0 0117.25 21.75H4.5A2.25 2.25 0 012.25 19.5V6.75A2.25 2.25 0 014.5 4.5h9.75" />
        </svg>
    </button>

    <!-- DELETE KPI (SAMA DENGAN BPD) -->
    <button onclick="openDeleteModal({{ $kpi->id_kpi }})"
        class="text-red-600 hover:text-red-800 transition inline-block cursor-pointer"
        title="Delete KPI">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 inline-block"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
        </svg>
    </button>

</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500">No KPIs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div id="createModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" aria-hidden="true"
                    onclick="toggleModal('createModal')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form action="{{ route('kpi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_bpd" value="{{ $bpd->id_bpd }}">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New KPI</h3>
                            <div class="mt-4 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                                <!-- Definition -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Definition</label>
                                    <textarea name="definition" rows="2"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2"></textarea>
                                </div>
                                <!-- Periode -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Periode</label>
                                    <input type="date" name="periode"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <!-- Target -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Target (Text)</label>
                                    <input type="text" name="target"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <!-- Actual -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Actual (Text)</label>
                                    <input type="text" name="actual"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <!-- Com Target -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Com Target (Numeric)</label>
                                    <input type="number" step="0.01" name="com_target"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <!-- Com Actual -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Com Actual (Numeric)</label>
                                    <input type="number" step="0.01" name="com_actual"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <!-- Note -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Note</label>
                                    <textarea name="note" rows="2"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                            <button type="button" onclick="toggleModal('createModal')"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
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
                    class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit KPI</h3>
                            <div class="mt-4 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Definition</label>
                                    <textarea name="definition" id="edit_definition" rows="2"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Periode</label>
                                    <input type="date" name="periode" id="edit_periode"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Target</label>
                                    <input type="text" name="target" id="edit_target"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Actual</label>
                                    <input type="text" name="actual" id="edit_actual"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Com Target</label>
                                    <input type="number" step="0.01" name="com_target" id="edit_com_target"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Com Actual</label>
                                    <input type="number" step="0.01" name="com_actual" id="edit_com_actual"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Note</label>
                                    <textarea name="note" id="edit_note" rows="2"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2"></textarea>
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
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete KPI</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete this KPI? This action cannot be undone.
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
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            modal.classList.toggle('hidden');
        }

        function openEditModal(button) {
            const kpi = JSON.parse(button.getAttribute('data-kpi'));

            document.getElementById('edit_definition').value = kpi.definition ?? '';
            document.getElementById('edit_periode').value = kpi.periode ? kpi.periode.split('T')[0] : '';
            document.getElementById('edit_target').value = kpi.target ?? '';
            document.getElementById('edit_actual').value = kpi.actual ?? '';
            document.getElementById('edit_com_target').value = kpi.com_target ?? '';
            document.getElementById('edit_com_actual').value = kpi.com_actual ?? '';
            document.getElementById('edit_note').value = kpi.note ?? '';

            document.getElementById('editForm').action = `{{ url('kpi') }}/${kpi.id_kpi}`;

            toggleModal('editModal');
        }


        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `{{ url('kpi') }}/${id}`;
            toggleModal('deleteModal');
        }
    </script>
@endsection