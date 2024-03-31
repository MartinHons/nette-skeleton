if (document.getElementById('sidebar')) {
    document.getElementById('hamburger')?.addEventListener('click', () => {
        document.body.classList.toggle('hide-sidebar')
    })

    document.addEventListener('DOMContentLoaded', checkSidebar)
    window.addEventListener('resize', checkSidebar)
    function checkSidebar() {
        if(document.documentElement.clientWidth <= 992) {
            console.log('add')
            document.body.classList.add('hide-sidebar')
        }
        else {
            console.log('rmove')
            document.body.classList.remove('hide-sidebar')
        }
    }
}
