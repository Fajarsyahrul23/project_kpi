@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">BPD Management</h1>
        <div class="flex items-center space-x-3">

    <!-- Preview KPI -->
    <a href="{{ route('bpd.preview.pdf') }}"
       target="_blank"
       class="inline-flex items-center gap-2
              px-4 py-2
              rounded-md
              bg-gray-600 hover:bg-gray-700
              text-white text-sm font-medium
              shadow transition duration-150">

        <!-- Icon book-open -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>

        <span>Preview KPI</span>
    </a>

    <!-- Create BPD -->
    <button type="button"
            onclick="toggleModal('createModal')"
            class="inline-flex items-center gap-2
                   px-4 py-2
                   rounded-md
                   bg-indigo-600 hover:bg-indigo-700
                   text-white text-sm font-medium
                   shadow transition duration-150">

        <!-- Icon plus -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-4 w-4"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
            <path d="M12 5v14M5 12h14"/>
        </svg>

        <span>Create BPD</span>
    </button>

</div>

    </div>

    <!-- Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    
                    <!-- No BPD dengan sort -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('bpd.index', ['sort' => ($sort == 'asc' ? 'desc' : 'asc')]) }}">
                            No BPD
                            @if($sort == 'asc')
                                &#9650;
                            @else
                                &#9660;
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Objective
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $no = ($bpds->currentPage() - 1) * $bpds->perPage() + 1;
                @endphp
                @forelse($bpds as $bpd)
                <tr> 
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bpd->no_bpd }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($bpd->objective, 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <!-- Measurements icon -->
                      <a href="{{ route('kpi.index', $bpd->id_bpd) }}"
                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full inline-block">Details KPI</a>
                                    
    <span class="mx-2 text-gray-400 font-semibold">|</span>
                        <!-- Edit icon -->
                      <button onclick="openEditModal({{ $bpd }})"

    class="text-yellow-500 hover:text-yellow-700 transition">
    <svg xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 inline-block"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L9.832 16.82a4.5 4.5 0 01-1.897 1.13l-2.685.805.805-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487zM19.5 7.125V19.5A2.25 2.25 0 0117.25 21.75H4.5A2.25 2.25 0 012.25 19.5V6.75A2.25 2.25 0 014.5 4.5h9.75" />
    </svg>
</button>

    <span class="mx-2 text-gray-400 font-semibold">|</span>
                        <!-- Delete icon -->
                            <button onclick="openDeleteModal({{ $bpd->id_bpd }}, '{{ $bpd->no_bpd }}')"
    class="text-red-600 hover:text-red-800 transition">
    <svg xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 inline-block"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
    </svg>
</button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No BPD records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $bpds->links() }}</div>

    <!-- Modals (Create, Edit, Delete) -->
    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" onclick="toggleModal('createModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="relative z-50 inline-block align-bottom bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('bpd.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Create New BPD</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No BPD</label>
                            <select name="no_bpd" id="create_no_bpd" required onchange="fillObjective(this.value,'create_objective')" class="w-full border rounded-md p-2">
                                <option value="">Select BPD</option>
                                @foreach($masterBpds as $master)
                                <option value="{{ $master->no_bpd }}">{{ $master->no_bpd }} - {{ Str::limit($master->objective, 30) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Objective</label>
                            <input type="text" id="create_objective" name="objective" readonly class="w-full border rounded-md p-2 bg-gray-200 cursor-not-allowed" placeholder="Objective otomatis mengikuti No BPD">
                        </div>
                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Save</button>
                            <button type="button" onclick="toggleModal('createModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" onclick="toggleModal('editModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="relative z-50 inline-block align-bottom bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Edit BPD</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No BPD</label>
                            <select name="no_bpd" id="edit_no_bpd" required onchange="fillObjective(this.value,'edit_objective')" class="w-full border rounded-md p-2">
                                <option value="">Select BPD</option>
                                @foreach($masterBpds as $master)
                                <option value="{{ $master->no_bpd }}">{{ $master->no_bpd }} - {{ Str::limit($master->objective,30) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Objective</label>
                            <input type="text" id="edit_objective" name="objective" readonly class="w-full border rounded-md p-2 bg-gray-200 cursor-not-allowed">
                        </div>
                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Update</button>
                            <button type="button" onclick="toggleModal('editModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 opacity-75 transition-opacity" onclick="toggleModal('deleteModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="relative z-50 inline-block align-bottom bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Delete BPD</h3>
                        <p class="text-sm text-gray-500 mt-2">Are you sure you want to delete BPD <strong id="delete_no_bpd"></strong>? This action cannot be undone.</p>
                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Delete</button>
                            <button type="button" onclick="toggleModal('deleteModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                        </div>
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
        if(found) document.getElementById(targetId).value = found.objective;
    }

    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle('hidden');
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
