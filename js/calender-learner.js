document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    const pastelPalette = [
        { bg: '#A7C7E7', text: '#1f4e79' },
        { bg: '#B5EAD7', text: '#1b6b5a' },
        { bg: '#FFDAC1', text: '#8a4b2d' },
        { bg: '#E2C7F0', text: '#5a2d82' }
    ];

    const coloredEvents = window.scheduleEvents.map((event, index) => {
        const colorSet = pastelPalette[index % pastelPalette.length];

        return {
            ...event,
            backgroundColor: colorSet.bg,
            borderColor: colorSet.bg,
            textColor: colorSet.text
        };
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'interaction'],
        initialView: 'dayGridMonth',
        events: coloredEvents,

        eventClick: function(info) {
            const scheduleId = info.event.id;

            // hapus highlight sebelumnya
            document.querySelectorAll('.schedule-card')
                .forEach(card => card.classList.remove('active-highlight'));

            // cari card berdasarkan schedule_id
            const targetCard = document.querySelector(
                `.schedule-card[data-schedule-id="${scheduleId}"]`
            );

            if (targetCard) {
                targetCard.classList.add('active-highlight');

                targetCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });

    calendar.render();
});
