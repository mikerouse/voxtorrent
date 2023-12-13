import './bootstrap';

// I only want this to run on the create torrent page
if (document.getElementById('createTorrent')) {
    console.info('createTorrent page detected');
} else {
    console.error('createTorrent page: Livewire is not loaded yet');
}