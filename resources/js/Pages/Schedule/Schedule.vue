<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

const calendarOptions = {
    selectable: true,
    plugins: [ dayGridPlugin, interactionPlugin ],
    initialView: 'dayGridMonth',
    events: [{'test': "test"}],
    eventsSources: {
        events: [{'test': "test"}]
    },
    eventClick: (info) => {
        console.log(info);
    },
    eventRender: (info) => {
        var element = info.el;
        var data = info.event.extendedProps;
        var tooltip = data.category + ": " + data.description;
        element.setAttribute('title', tooltip);
    },
    dateClick: (info) => {
        console.log(info);
    }
};

// selectable: true,
//     initialView: 'dayGridMonth',
//     events: @json($events),
// eventsSources: {
//     events: @json($this->loadEvents(
//         \Illuminate\Support\Carbon::now()->firstOfYear()->format('Y-m-d'),
//                 \Illuminate\Support\Carbon::now()->lastOfYear()->format('Y-m-d')
// ))
// },
// eventClick: function (info) {
//     Livewire.emit('showDropEventModal', info.event.id);
// },
// eventRender: function (info) {
//     var element = info.el;
//     var data = info.event.extendedProps;
//     var tooltip = data.category + ": " + data.description;
//     element.setAttribute('title', tooltip);
// },
// dateClick: function(info) {
//     Livewire.emit('showCreateModal', info.dateStr);
// }
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schedule
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <FullCalendar :options="calendarOptions" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
