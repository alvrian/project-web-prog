<x-layout>
    <x-navbar/>
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-success bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0" style="color: #4b5320;">Waste Report</h3>
                    <a href="{{ route('waste_log.create') }}" class="btn btn-success">
                        Add New Entry
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date Logged</th>
                                <th>Waste Type</th>
                                <th>Weight (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wasteLogs as $log)
                                <tr>
                                    <td>{{ $log->DateLogged }}</td>
                                    <td>{{ $log->WasteType }}</td>
                                    <td>{{ number_format($log->Weight, 2) }}</td>
                                </tr>
                                <a href="{{ route('waste_log.show', $entry->id) }}" class="btn btn-light">View
                                    Details</a>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No waste logs found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $wasteLogs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
