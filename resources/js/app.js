import './bootstrap';

// I only want this to run on the create torrent page
if (document.getElementById('createTorrent')) {
    
    console.info('createTorrent page detected');

    // If we are on the create torrent page, we need to load the Livewire script
    document.addEventListener('DOMContentLoaded', (event) => {
        if (window.Livewire) {
            // Listen for keyup on the #hashtags input
            document.getElementById('hashtags').addEventListener('keyup', function (event) {
                // Check if the spacebar was pressed
                if (event.key === " " || event.key === "Spacebar") {
                    console.log('Spacebar pressed');
                    // Get the value of the input
                    let hashtags = this.value;

                    // Remove all hashtags
                    hashtags = hashtags.replace(/#/g, '');

                    // Split the string into an array on spaces
                    hashtags = hashtags.split(' ');

                    // Remove all empty elements
                    hashtags = hashtags.filter(function (el) {
                        return el !== '';
                    });

                    // Make sure we have at least one hashtag
                    if (hashtags.length > 0) {
                        // Send the hashtags to the server
                        window.Livewire.dispatch('setHashtags', { '$incomingHashtags': hashtags });
                    } else {
                        // If we don't have any hashtags, send an empty array
                        console.log('No hashtags');
                    }
                }
            });
        } else {
            console.error('createTorrent page: Livewire is not loaded yet');
        }
    });

}