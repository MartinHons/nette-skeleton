const topbar = document.getElementById('topbar')

if (topbar) {
    const mainWrapper = document.getElementById('main-wrapper')

    mainWrapper?.addEventListener('scroll', () => {

        if (mainWrapper.scrollTop === 0) {
            topbar.style.boxShadow = ''
            topbar.style.borderBottomColor = ''
        }
        else {
            topbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.15)'
            topbar.style.borderBottomColor = 'rgba(255, 255, 255, 0.18)'
        }
    })
}