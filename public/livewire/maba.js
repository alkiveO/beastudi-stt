Livewire.on('showEditMabaModal', (maba) => {
    $('#editMabaModal').modal('show')

    Livewire.emit('setEditMaba', maba)
});

Livewire.on('showDeleteMabaModal', (maba) => {
    $('#deleteMabaModal').modal('show')

    Livewire.emit('setDeleteMaba', maba)
});

Livewire.on('closeModalMaba', () => {
    $('#editMabaModal').modal('hide')
    $('#deleteMabaModal').modal('hide')
})
