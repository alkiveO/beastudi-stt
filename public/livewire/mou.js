Livewire.on('showEditMouModal', (mou) => {
    $('#editMouModal').modal('show')

    Livewire.emit('setEditMou', mou)
});

Livewire.on('showDeleteMouModal', (mou) => {
    $('#deleteMouModal').modal('show')

    Livewire.emit('setDeleteMou', mou)
});

Livewire.on('closeModalMou', () => {
    $('#editMouModal').modal('hide')
    $('#deleteMouModal').modal('hide')
})
