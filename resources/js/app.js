require('./bootstrap');

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import router from './router';
import BooksIndex from './components/books/BooksIndex';

const app = createApp({
    components: {
        BooksIndex,
    }
}).use(router)

app.config.globalProperties.$filters = {
    currency(value) {
      return 'R ' + value + '.00'
    }
}

app.mount('#app');

window.Alpine = Alpine;

Alpine.start();
