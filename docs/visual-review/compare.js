'use strict';
let selectedPage = 'home';
let selectedDevice = 'desktop';
const frame = document.querySelector('#concept-frame');
const capture = document.querySelector('#live-capture');
function fitPreview() {
    const canvas = document.querySelector('#iframe-canvas');
    const width = selectedDevice === 'desktop' ? 1440 : 390;
    const height = selectedDevice === 'desktop' ? 1000 : 844;
    const scale = canvas.clientWidth / width;
    frame.width = width;
    frame.height = height;
    frame.style.transform = `scale(${scale})`;
    document.querySelectorAll('.preview-canvas').forEach(el => el.style.height = `${height * scale}px`);
}
function updateComparison() {
    const mockUrl = `${selectedPage}.html`;
    frame.src = `${mockUrl}?embedded=1`;
    frame.title = `Proposed ${selectedPage === 'home' ? 'Home' : 'Solutions'} page`;
    capture.src = `captures/${selectedPage}-${selectedDevice}.jpg`;
    capture.alt = `Current live ${selectedPage === 'home' ? 'Home' : 'Solutions'} page at ${selectedDevice} size`;
    capture.width = selectedDevice === 'desktop' ? 1440 : 390;
    capture.height = selectedDevice === 'desktop' ? 1000 : 844;
    document.querySelector('#open-concept').href = mockUrl;
    document.querySelector('#open-proposed').href = mockUrl;
    document.querySelector('#open-live').href = `https://ascend-ai.co.uk/${selectedPage === 'home' ? '' : 'solutions'}`;
    document.querySelector('.comparison-grid').classList.toggle('mobile-view', selectedDevice === 'mobile');
    document.querySelectorAll('[data-page-choice]').forEach(button => button.setAttribute('aria-pressed', String(button.dataset.pageChoice === selectedPage)));
    document.querySelectorAll('[data-device]').forEach(button => button.setAttribute('aria-pressed', String(button.dataset.device === selectedDevice)));
    requestAnimationFrame(fitPreview);
}
document.querySelectorAll('[data-page-choice]').forEach(button => button.addEventListener('click', () => { selectedPage = button.dataset.pageChoice; updateComparison(); }));
document.querySelectorAll('[data-device]').forEach(button => button.addEventListener('click', () => { selectedDevice = button.dataset.device; updateComparison(); }));
new ResizeObserver(fitPreview).observe(document.querySelector('#iframe-canvas'));
fitPreview();
