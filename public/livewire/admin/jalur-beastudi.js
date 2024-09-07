Livewire.on('showAddJalurBeastudiModal', () => {
    $('#addJalurBeastudiModal').modal('show')
})

Livewire.on('showEditJalurBeastudiModal', (jalurBeastudi) => {
    $('#editJalurBeastudiModal').modal('show')

    Livewire.emit('setEditJalurBeastudi', jalurBeastudi)
})

Livewire.on('showDeleteJalurBeastudiModal', (jalurBeastudi) => {
    $('#deleteJalurBeastudiModal').modal('show')

    Livewire.emit('setDeleteJalurBeastudi', jalurBeastudi)
})

Livewire.on('closeModalJalurBeastudi', () => {
    $('#addJalurBeastudiModal').modal('hide')
    $('#editJalurBeastudiModal').modal('hide')
    $('#deleteJalurBeastudiModal').modal('hide')
})
