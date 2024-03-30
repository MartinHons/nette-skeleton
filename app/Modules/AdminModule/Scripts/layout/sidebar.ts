if (document.getElementById('sidebar')) {
    document.getElementById('hamburger')?.addEventListener('click', () => {
        document.body.classList.toggle('hide-sidebar')
    })

    document.addEventListener('DOMContentLoaded', checkSidebar)
    window.addEventListener('resize', checkSidebar)
    function checkSidebar() {
        if(document.documentElement.clientWidth <= 992) {
            document.body.classList.add('hide-sidebar')
        }
        else {
            document.body.classList.remove('hide-sidebar')
        }
    }
}
