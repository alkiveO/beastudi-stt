Livewire.on('showAddPeriodeModal', () => {
    $('#addPeriodeModal').modal('show')
})

Livewire.on('showEditPeriodeModal', (periode) => {
    $('#editPeriodeModal').modal('show')

    Livewire.emit('setEditPeriode', periode)
})

Livewire.on('showDeletePeriodeModal', (periode) => {
    $('#deletePeriodeModal').modal('show')

    Livewire.emit('setDeletePeriode', periode)
})

Livewire.on('closeModalPeriode', () => {
    $('#addPeriodeModal').modal('hide')
    $('#editPeriodeModal').modal('hide')
    $('#deletePeriodeModal').modal('hide')
})
