require('./bootstrap');

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import router from './router';
import StudentsIndex from './components/books/BooksIndex';

createApp({
    components: {
        BooksIndex,
    }
}).use(router).mount('#app');

window.Alpine = Alpine;

Alpine.start();
