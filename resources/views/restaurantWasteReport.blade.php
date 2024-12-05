<x-layout>
    <x-navbar />
    <div style = "background-color: #43553D;width: 100vw;min-height:93vh;position:relative;overflow:hidden;font-family:&quot;Inter&quot;, serif;">
    <div style = "background-color: white;width: 90vw;height:90vh;position:absolute;right:0;bottom:0;border-radius: 12px 0 0 0;">
    
        <div class="container mt-4">
            <h3 class="text-center mb-4" style="color: #4b5320;">Waste Report</h3>

            <!-- Check ada waste log apa ngga -->
            @if($wasteLogs->isEmpty())
                <p class="text-center">No waste logs found.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date Logged</th>
                            <th>Waste Type</th>
                            <th>Weight (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- display waste log dlm bentuk table -->
                        @foreach ($wasteLogs as $log)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($log->DateLogged)->format('d-m-Y') }}</td>
                                <td>{{ $log->WasteType }}</td>
                                <td>{{ $log->Weight }} kg</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

</x-layout>
