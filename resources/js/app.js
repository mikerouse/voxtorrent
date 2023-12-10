import './bootstrap';
import Quill from 'quill';
import QuillMention from 'quill-mention';
import 'quill/dist/quill.snow.css';
import 'quill-mention/dist/quill.mention.css';

if (window.Livewire) {

    var toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'link', { 'color': [] }, { 'background': [] }, 'blockquote', { 'list': 'ordered'}, { 'list': 'bullet' }];

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
            },
            toolbar: toolbarOptions,
        },
        placeholder: 'what\'s the cause? and why does it matter? set topics using #hashtags',
        theme: 'snow'
    });

    quill.on('text-change', function() {
        var text = quill.getText();
    
        // Regular expression to match hashtags followed by specific terminators
        var hashtagRegex = /#(\w+)[.,;: ]/g;
        var matches;
        var hashtags = [];
    
        while ((matches = hashtagRegex.exec(text)) !== null) {
            // Add the captured hashtag (without the terminator) to the hashtags array
            hashtags.push('#' + matches[1]);
        }
    
        if (window.Livewire) {
            if (hashtags.length > 0) {
                console.log('Completed hashtags found: ', hashtags);
                console.log('Type of hashtags: ' + typeof hashtags);
                window.Livewire.dispatch('updateHashtags', { incomingHashtags: hashtags });
            } else {
                console.log('No completed hashtags found');
            }
        } else {
            console.error('Livewire is not loaded yet');
        }
    });

} else {
    console.error('1 Livewire is not loaded yet');
}