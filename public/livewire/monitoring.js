Livewire.on('showDetailKonstribusiModal', (monitoring) => {
    $('#detailKontribusiModal').modal('show')

    Livewire.emit('setDetailKontribusi', monitoring)
})

Livewire.on('showEditMonitoringModal', (monitoring) => {
    $('#editMonitoringModal').modal('show')

    Livewire.emit('setEditMonitoring', monitoring)
});

Livewire.on('showDeleteMonitoringModal', (monitoring) => {
    $('#deleteMonitoringModal').modal('show')

    Livewire.emit('setDeleteMonitoring', monitoring)
})

Livewire.on('closeModalMonitoring', () => {
    $('#editMonitoringModal').modal('hide')
    $('#deleteMonitoringModal').modal('hide')
})
