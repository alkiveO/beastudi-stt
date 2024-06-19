Livewire.on('showDeleteMonitoringModal', (monitoring) => {
    $('#deleteMonitoringModal').modal('show')

    Livewire.emit('setDeleteMonitoring', monitoring)
})

Livewire.on('closeModalMonitoring', () => {
    //$('#editMouModal').modal('hide')
    $('#deleteMonitoringModal').modal('hide')
})
