<x-layout>
    <x-navbar />
    @if (auth()->user()->role != 'farmer')
        <div class="alert alert-warning" role="alert">
            You do not have the required permissions to access this section.
        </div>
    @else
        <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
            <!-- Subscription Section -->
            <span style="font-size: 20px;font-weight: 600;">Your Subscriptions</span>
            <x-farmer-subscription />

            <!-- Calendar Section -->
            <div class="mt-5">
                <span style="font-size: 20px;font-weight: 600;">Drop-off Schedule Calendar</span>
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- List View Section -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Compost Drop-offs
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            @forelse($compostSchedules as $schedule)
                                <div class="mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ \Carbon\Carbon::parse($schedule->ScheduledDate)->format('d M Y') }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($schedule->ScheduledDate)->format('H:i') }}</small>
                                        </div>
                                        <span
                                            class="badge fs-6 px-3 py-2 bg-{{ $schedule->Status === 'Scheduled' ? 'warning' : ($schedule->Status === 'Completed' ? 'success' : 'danger') }}">
                                            {{ $schedule->Status }}
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <strong>From:</strong> {{ optional($schedule->senderCompostProducer)->Name ?? 'N/A' }}
                                    </div>
                                </div>
                            @empty
                                <p>No upcoming compost deliveries</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Crop Drop-offs
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            @forelse($cropSchedules as $schedule)
                                <div class="mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ \Carbon\Carbon::parse($schedule->ScheduledDate)->format('d M Y') }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($schedule->ScheduledDate)->format('H:i') }}</small>
                                        </div>
                                        <span
                                            class="badge fs-6 px-3 py-2 bg-{{ $schedule->Status === 'Scheduled' ? 'warning' : ($schedule->Status === 'Completed' ? 'success' : 'danger') }}">
                                            {{ $schedule->Status }}
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <strong>To:</strong> {{ optional($schedule->recipientRestaurantOwner)->Name ?? 'N/A' }}
                                    </div>
                                </div>
                            @empty
                                <p>No upcoming crop deliveries</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Scripts -->
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: [
                        // Compost Drop-offs
                        @foreach ($compostSchedules as $schedule)
                            {
                                title: 'Compost Drop-off from {{ optional($schedule->senderCompostProducer)->Name }}',
                                start: '{{ $schedule->ScheduledDate }}',
                                color: '#198754',
                                status: '{{ $schedule->Status }}'
                            },
                        @endforeach
                        // Crop Drop-offs
                        @foreach ($cropSchedules as $schedule)
                            {
                                title: 'Crop Drop-off to {{ optional($schedule->recipientRestaurantOwner)->Name }}',
                                start: '{{ $schedule->ScheduledDate }}',
                                color: '#0d6efd',
                                status: '{{ $schedule->Status }}'
                            },
                        @endforeach
                    ],
                    eventRender: function(event, element) {
                        element.find('.fc-title').append('<br/>' + event.status);
                    }
                });
            });
        </script>
    @endif
</x-layout>
