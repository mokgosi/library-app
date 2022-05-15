import { createRouter, createWebHistory  } from 'vue-router';

import BooksIndex from '../components/books/BooksIndex';
import BookCreate from '../components/books/BookCreate';
import BookEdit from '../components/books/BookEdit';

import CategoriesIndex from '../components/categories/CategoriesIndex';
import CategoryCreate from '../components/categories/CategoryCreate';
import CategoryEdit from '../components/categories/CategoryEdit';

import MembersIndex from '../components/members/MembersIndex';
import MemberCreate from '../components/members/MemberCreate';
import MemberEdit from '../components/members/MemberEdit';

import TransactionsIndex from '../components/transactions/TransactionsIndex';
import TransactionCreate from '../components/transactions/TransactionCreate';
import TransactionEdit from '../components/transactions/TransactionEdit';

import Dashboard from '../components/Dashboard';


const routes = [
    {
        path: '/dashboard',
        name: 'dashbord',
        component: Dashboard
    }, {
        path: '/books',
        name: 'books.index',
        component: BooksIndex
    }, {
        path: '/books/create',
        name: 'books.create',
        component: BookCreate,
    }, {
        path: '/books/edit',
        name: 'books.edit',
        component: BookEdit,
        props: true
    }, {
        path: '/categories',
        name: 'categories.index',
        component: CategoriesIndex
    }, {
        path: '/categories/create',
        name: 'categories.create',
        component: CategoryCreate,
    }, {
        path: '/categories/edit',
        name: 'categories.edit',
        component: CategoryEdit,
        props: true
    },  {
        path: '/members',
        name: 'members.index',
        component: MembersIndex,
    }, {
        path: '/members/create',
        name: 'members.create',
        component: MemberCreate,
    }, {
        path: '/members/edit',
        name: 'members.edit',
        component: MemberEdit,
        props: true
    },  {
        path: '/transactions',
        name: 'transactions.index',
        component: TransactionsIndex,
    }, {
        path: '/transactions/create',
        name: 'transactions.create',
        component: TransactionCreate,
    }, {
        path: '/transactions/edit',
        name: 'transactions.edit',
        component: TransactionEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});