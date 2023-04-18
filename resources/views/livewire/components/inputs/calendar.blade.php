<div >
    <div wire:ignore>
        <div id="schedule"></div>
    </div>
    @include('livewire.components.inputs.calendar_components.modal')
    @include('livewire.components.inputs.calendar_components.drop-modal')
</div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('schedule');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            initialView: 'dayGridMonth',
            events: @json($events),
            eventsSources: {
                events: @json($this->loadEvents(
                    \Illuminate\Support\Carbon::now()->firstOfYear()->format('Y-m-d'),
                    \Illuminate\Support\Carbon::now()->lastOfYear()->format('Y-m-d')
                ))
            },
            eventClick: function (info) {
                Livewire.emit('showDropEventModal', info.event.id);
            },
            eventRender: function (info) {
                var element = info.el;
                var data = info.event.extendedProps;
                var tooltip = data.category + ": " + data.description;
                element.setAttribute('title', tooltip);
            },
            dateClick: function(info) {
                Livewire.emit('showCreateModal', info.dateStr);
            }
        });
        calendar.render();
        Livewire.on('createdEvent', function (event) {
            calendar.addEvent(event);
        });
        Livewire.on('deletedEvent', function (event) {
            let eventObject = calendar.getEventById(event.id);
            if (eventObject) {
                eventObject.remove();
            }
        });
        Livewire.on('refreshFullCalendar', function () {
            calendar.refetchEvents();
        });
    });
</script>
