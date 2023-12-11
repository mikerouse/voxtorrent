import './bootstrap';
import Quill from 'quill';
import QuillMention from 'quill-mention';
import 'quill/dist/quill.snow.css';
import 'quill-mention/dist/quill.mention.css';

// I only want this to run on the create torrent page
if (document.getElementById('createTorrent')) {
    console.info('createTorrent page detected');

    // If we are on the create torrent page, we need to load the Livewire script

    if (window.Livewire) {

        var hashtags = new Set();
    
        var toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'link', { 'color': [] }, { 'background': [] }, 'blockquote', { 'list': 'ordered'}, { 'list': 'bullet' }];
    
        class Counter {
            constructor(quill, options) {
              this.quill = quill;
              this.options = options;
              this.container = document.querySelector(options.container);
              quill.on('text-change', this.update.bind(this));
              this.update(); // Account for initial contents
            }
          
            calculate() {
              let text = this.quill.getText();
              if (this.options.unit === 'word') {
                text = text.trim();
                // Splitting empty text returns a non-empty array
                return text.length > 0 ? text.split(/\s+/).length : 0;
              } else {
                return text.length;
              }
            }
          
            update() {
              var length = this.calculate();
              var label = this.options.unit;
              if (length !== 1) {
                label += 's';
              }
              this.container.innerText = length + ' ' + label;
            }}
          
          
          Quill.register('modules/counter', Counter);
          
    
        var quill = new Quill('#editor', {
            modules: {
                mention: {
                    allowedChars: /^[#A-Za-zÅÄÖåäö]*$/,
                    mentionDenotationChars: ["#"],
                    source: function (searchTerm, renderList, mentionChar) {
                        let values;
    
                        if (searchTerm.length < 3) {
                            values = [];
                        } else {
                            values = [{ value: searchTerm }];
                        }
    
                        renderList(values, searchTerm);
                    },
                    onSelect: function (item, insertItem) {
                        // Insert the selected item
                        insertItem(item);
                        // Add selected hashtag to the Set
                        hashtags.add('#' + item.value);
        
                        // Send update back to the component
                        updateHashtags(); 
                    }
                },
                toolbar: toolbarOptions,
                counter: {
                    container: '#counter',
                    unit: 'word'},
            },
            placeholder: 'what\'s the cause? and why does it matter? set topics using #hashtags',
            theme: 'snow'
        });
    
        quill.on('text-change', function() {
            var text = quill.getText();
        
            // Regular expression to match hashtags followed by specific terminators
            var hashtagRegex = /#(\w+)[.,;: ]/g;
            var matches;
        
            while ((matches = hashtagRegex.exec(text)) !== null) {
                // Add the captured hashtag (without the terminator) to the hashtags array
                hashtags.add('#' + matches[1]);
            }
        
            updateHashtags();
        });
    
        // Define updateHashtags function
        function updateHashtags() {
            if (window.Livewire) {
                if (hashtags.size > 0) {
                    // Send update to the component
                    window.Livewire.dispatch('updateHashtags', { incomingHashtags: Array.from(hashtags) });
                }
            } else {
                console.error('update hashtags method: Livewire is not loaded yet');
            }
        }
    
        // Handle torrent submission by listening to the click event on the 'post' submit button
        document.getElementById('createTorrent').addEventListener('submit', function(event) {
            event.preventDefault(); // prevent the form from submitting normally

            // Integrate Delta more deeply so that we can send Delta to the component, store Delta and bring back Delta later
            // However, right now we don't have time for this, so we'll just send the HTML to the component 
            var delta = quill.getContents();
            // CHeck if the delta is empty
            if (delta.ops.length === 1 && delta.ops[0].insert === '\n') {
                // If it is, then log an error to the console
                console.error('Delta is empty');
                // And return false to prevent the form from being submitted
                return false;
            }

            // Check we have hastags and log an error if we don't and prevent the form from being submitted
            if (hashtags.size === 0) {
                console.error('No hashtags');
                // Stop further propagation of the event
                event.stopPropagation();
            }

            // We need to get the text content of the editor
            var myEditor = document.querySelector('#editor')
            var TorrentHtml = myEditor.children[0].innerHTML
            // Copy this to a hidden textarea so that it can be submitted with the form
            document.getElementById('torrentDescription').value = TorrentHtml;

            var formData = new FormData(document.getElementById('createTorrent'));
            // within formData, we need to JSON.stringify the torrentDescription
            formData.set('torrentDescription', JSON.stringify(TorrentHtml));
        
            var data = {};
            for (let pair of formData.entries()) {
                let key = pair[0];
                let value = pair[1];
                console.log(`Adding item - Key: ${key}, Value: ${value}`);
                data[key] = value;
            }
        
            if (window.Livewire) {
                window.Livewire.dispatch('handleFormSubmission', { data: data });
            } else {
                console.error('submitTorrent form: Livewire is not loaded yet');
            }
        });

        window.Livewire.on('torrent-created', (options) => {
            console.info('torrent created event received', options);
            // When this event is fired scroll the #preparingTorrent DIV into view
            document.getElementById('preparingTorrent').scrollIntoView();
            // Update the #torrentSharingLink input with the torrent sharing link
            // First, build the link by taking the website URL and appending /vox/{torrentId}
            options.torrentSharingLink = window.location.origin + '/vox/' + options.id;
            document.getElementById('torrentSharingLink').value = options.torrentSharingLink;
            // Highlight the input for convenience
            document.getElementById('torrentSharingLink').select();
        });

        window.Livewire.on('noDescription', () => {
            console.error('No description was received by the server');
            console.error("torrentDescription: " + document.getElementById('torrentDescription').value);
        });
    
    } else {
        console.error('createTorrent page: Livewire is not loaded yet');
    }

}