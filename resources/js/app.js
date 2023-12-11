import './bootstrap';

// I only want this to run on the create torrent page
if (document.getElementById('createTorrent')) {
    console.info('createTorrent page detected');

    // If we are on the create torrent page, we need to load the Livewire script

    if (window.Livewire) {
    
    } else {
        console.error('createTorrent page: Livewire is not loaded yet');
    }

}