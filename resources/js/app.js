import './bootstrap';
import Quill from 'quill';
import QuillMention from 'quill-mention';
import 'quill/dist/quill.snow.css';
import 'quill-mention/dist/quill.mention.css';

if (window.Livewire) {

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