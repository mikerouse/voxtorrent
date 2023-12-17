import './bootstrap';
import Chart from 'chart.js/auto';

document.addEventListener('livewire:load', function () {
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded');
        return;
    }
    // Rest of your chart initialization code...
});