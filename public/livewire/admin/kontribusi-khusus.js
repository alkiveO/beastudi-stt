Livewire.on('showEditKontribusiKhususModal', (kontribusiKhusus) => {
    $('#editKontribusiKhususModal').modal('show')

    Livewire.emit('setEditKontribusiKhusus', kontribusiKhusus)
})

Livewire.on('showDeleteKontribusiKhususModal', (kontribusiKhusus) => {
    $('#deleteKontribusiKhususModal').modal('show')

    Livewire.emit('setDeleteKontribusiKhusus', kontribusiKhusus)
})

Livewire.on('closeModalKontribusiKhusus', () => {
    $('#editKontribusiKhususModal').modal('hide')
    $('#deleteKontribusiKhususModal').modal('hide')
})
