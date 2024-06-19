Livewire.on('showEditMouModal', (mou) => {
    $('#editMouModal').modal('show')

    Livewire.emit('setEditMou', mou)
});

Livewire.on('setProdi', (prodi_id) => {
    let selectProdi = document.getElementById('edit-prodi');
    selectProdi.value = prodi_id;
    $(selectProdi).selectpicker('refresh');
});

Livewire.on('showDeleteMouModal', (mou) => {
    $('#deleteMouModal').modal('show')

    Livewire.emit('setDeleteMou', mou)
});

Livewire.on('closeModalMou', () => {
    $('#editMouModal').modal('hide')
    $('#deleteMouModal').modal('hide')
})
