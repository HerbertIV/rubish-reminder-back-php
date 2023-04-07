<div wire:ignore>
    <div id="schedule"></div>
    <!-- Modal layout -->
    <div wire:ignore.self
         class="modal fade"
         id="eventModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="eventModalLabel"
         aria-hidden="true"
         wire:keydown.escape="closeModal()"
         wire:model="createModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding event -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="saveEvent()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('schedule');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            initialView: 'dayGridMonth',
            events: @json($events),
            eventClick: function (info) {
                alert('Event: ' + info.event.title);
                alert('Start: ' + info.event.start);
                alert('End: ' + info.event.end);
                alert('Description: ' + info.event.extendedProps.description);
                alert('Category: ' + info.event.extendedProps.category);
                alert('All Day: ' + info.event.allDay);
            },
            eventRender: function (info) {
                var element = info.el;
                var data = info.event.extendedProps;
                var tooltip = data.category + ": " + data.description;
                element.setAttribute('title', tooltip);
            },
            eventSources: [
                {
                    url: '{{ $this->loadEvents('01-01-2022', '01-01-2023') }}',
                    method: 'GET',
                    extraParams: {
                        '_token': '{{ csrf_token() }}'
                    },
                    failure: function () {
                        alert('There was an error while fetching events!');
                    }
                }
            ],
            dateClick: function(info) {
                console.log(info.dateStr);
                Livewire.emit('showCreateModal', info.dateStr);
            }
        });
        calendar.render();
        Livewire.on('refreshFullCalendar', function () {
            calendar.refetchEvents();
        });
    });
</script>
