import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router';

export default function useBooks() {

    const book = ref([])
    const books = ref([])
    const categories = ref([])
    const errors = ref('')
    const router = useRouter()

    const getBooks = async () => {
        let response = await axios.get('/api/books')
        books.value = response.data.data;
    }

    const getBook = async (id) => {
        let response = await axios.get(`/api/books/${id}`)
        book.value = response.data.data;
    }

    const storeBook = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/books', data)
            await router.push({ name: 'books.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const getCategories = async () => {
        let response = await axios.get('/api/categories')
        categories.value = response.data.data;
    }

    const updateBook = async (id) => {
        errors.value = ''
        try {
            await axios.put(`/api/books/${id}`, book.value);
            await router.push({ name: 'books.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyBook = async (id) => {
        await axios.delete(`/api/books/${id}`);
    }

    return {
        errors,
        book,
        books,
        categories,
        getBook,
        getBooks,
        storeBook,
        updateBook,
        destroyBook,
        getCategories
    }
}