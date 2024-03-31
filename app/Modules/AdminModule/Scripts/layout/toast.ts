const container = document.getElementById('toast-container')

if (container) {
    container.querySelectorAll('.toast').forEach(toast => {
        toast.classList.add('show')
    })
}