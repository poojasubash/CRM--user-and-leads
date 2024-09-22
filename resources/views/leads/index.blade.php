@extends('layouts.app')

@section('title', 'Leads')

@section('content')
    <h1 class="text-xl font-bold mb-4">Leads</h1>

    <div class="flex justify-between items-center mb-4 text-sm">
        <form id="searchForm" action="{{ route('leads.index') }}" method="GET" class="flex space-x-2">
            <input type="text" id="searchInput" name="search" value="{{ request()->query('search') }}" placeholder="Search leads..." class="border border-gray-300 px-4 py-2 rounded w-64">
            <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Search</button>
            <button type="button" id="clearSearch" class="bg-gray-500 text-white px-3 py-2 rounded ml-2">Clear</button>

        </form>
        <a href="{{ route('leads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded no-underline flex items-center">
            <i class="bi bi-plus-circle mr-2"></i> Create New Lead
        </a>
    </div>

    @if(session('success'))
        <p id="successMessage" class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <div class="overflow-x-auto text-sm">
        <table id="leadsTable" class="table-auto border-collapse border border-gray-400 w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-center cursor-pointer" onclick="showColumn(0)">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center cursor-pointer" onclick="showColumn(1)">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-center cursor-pointer" onclick="showColumn(2)">Phone</th>
                    <th class="border border-gray-300 px-4 py-2 text-center cursor-pointer" onclick="showColumn(3)">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-center cursor-pointer" onclick="showColumn(4)">Source</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="leadsTableBody">
                @foreach($leads as $lead)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <form action="{{ route('leads.updateStatus', $lead) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" id="status" class="block w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="this.form.submit()">
                                    <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
                                </select>
                            </form>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $lead->source->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('leads.show', $lead) }}" class="text-blue-500 no-underline">View</a>
                                <a href="{{ route('leads.edit', $lead->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded no-underline"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('leads.destroy', $lead) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded no-underline"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $leads->links() }}
        </div>
    </div>
    <script>
        const originalTableHTML = document.getElementById('leadsTable').innerHTML;

        function showColumn(columnIndex) {
            const table = document.getElementById('leadsTable');
            const tableBody = document.getElementById('leadsTableBody');
            const rows = tableBody.querySelectorAll('tr');
            const headers = table.querySelectorAll('thead th');

            // Hide entire table initially
            table.style.display = 'none';

            // Create new table with only the selected column
            const newTable = document.createElement('table');
            newTable.className = 'table-auto border-collapse border border-gray-400 w-full';

            // Create the header row
            const newThead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            headers.forEach((header, index) => {
                if (index === columnIndex || index === headers.length - 1) {
                    const newHeader = header.cloneNode(true);
                    newHeader.style.display = 'table-cell';
                    headerRow.appendChild(newHeader);
                } else {
                    const newHeader = document.createElement('th');
                    newHeader.style.display = 'none';
                    headerRow.appendChild(newHeader);
                }
            });
            newThead.appendChild(headerRow);
            newTable.appendChild(newThead);

            // Create the body rows
            const newTbody = document.createElement('tbody');
            rows.forEach(row => {
                const newRow = document.createElement('tr');
                const cells = row.cells;
                for (let i = 0; i < cells.length; i++) {
                    if (i === columnIndex || i === cells.length - 1) {
                        const newCell = cells[i].cloneNode(true);
                        newRow.appendChild(newCell);
                    } else {
                        const newCell = document.createElement('td');
                        newCell.style.display = 'none';
                        newRow.appendChild(newCell);
                    }
                }
                newTbody.appendChild(newRow);
            });
            newTable.appendChild(newTbody);

            // Replace original table with new table
            table.parentNode.replaceChild(newTable, table);
        }

        setTimeout(function() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.opacity = 0;
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }
        }, 3000);

        document.getElementById('clearSearch').addEventListener('click', function() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';
            document.getElementById('searchForm').submit();
        });

    </script>
@endsection
