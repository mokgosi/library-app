<template>
    <div class="flex flex-col">
        <div class="flex place-content-end mb-4">
            <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                <router-link  :to="{ name: 'transactions.create' }" class="text-sm font-medium">
                    Create New
                </router-link>
            </div>
        </div>
        <div>
            <vue-good-table
                :columns="columns"
                :rows="transactions"
                :line-numbers="true"
                :search-options="{
                    enabled: true
                }"
                :pagination-options="{
                    enabled: true,
                    mode: 'pages',
                    perPage: 5,
                    position: 'bottom',
                    perPageDropdown: [5, 10, 15],
                    dropdownAllowAll: false,
                    setCurrentPage: 1,
                    nextLabel: 'Next',
                    prevLabel: 'Prev',
                    rowsPerPageLabel: 'Rows per page',
                    ofLabel: 'of',
                    pageLabel: 'Page', // for 'pages' mode
                    allLabel: 'All',
                    // infoFn: (params) => `Showing ${params.firstRecordOnPage} to ${params.lastRecordOnPage} of page ${params.currentPage}`,
                }">
                <template #table-row="props">
                    <span v-if="props.column.field == 'before'">
                        <router-link :to="{name: 'transactions.edit', params: { id: props.row.id }, }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </router-link>
                    </span>
                    <span v-else-if="props.column.field == 'after'">
                        <a @click="deleteTransaction(props.row.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </a>
                    </span>
                    <span v-else>
                        {{props.formattedRow[props.column.field]}}
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>
</template>
<script>

import useTransactions from "../../composables/transactions"
import { onMounted, reactive } from "vue";

import 'vue-good-table-next/dist/vue-good-table-next.css'
import { VueGoodTable } from 'vue-good-table-next'

export default {
    components: { VueGoodTable },
    setup() {
        const { transactions, getTransactions, destroyTransaction} = useTransactions();

        const tdHClass = "x-3 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-100"
        const tdCClass = "px-3 py-3 text-sm font-medium whitespace-no-wrap border-b border-gray-200"

        const columns = reactive([
            {label: "Trans ID", field: 'transaction_id', tdClass: tdCClass, thClass: tdHClass},
            {label: "Member", field: 'member', tdClass: tdCClass, thClass: tdHClass},
            {label: "Title", field: 'title', tdClass: tdCClass, thClass: tdHClass},
            {label: "Date Issued", field: 'date_issued', tdClass: tdCClass, thClass: tdHClass},
            {label: "Date Due", field: 'date_due', tdClass: tdCClass, thClass: tdHClass},
            {label: 'Date Returned', field: 'date_returned', tdClass: tdCClass, thClass: tdHClass},
            {label: 'Status', field: 'status', tdClass: tdCClass, thClass: tdHClass},
            {label: 'Penalty', field: 'penalty', tdClass: tdCClass, thClass: tdHClass},
            {label: 'Edit', field: 'before', sortable: false, tdClass: tdCClass, thClass: tdHClass},
            {label: 'Delete', field: 'after', sortable: false, tdClass: tdCClass, thClass: tdHClass}
        ]);

        onMounted(getTransactions);
        
        const deleteTransaction = async (id) => {
            if (!window.confirm("Are you sure?")) {
                return;
            }
            await destroyTransaction(id);
            await getTransactions();
        };

        return {
            columns,
            transactions,
            deleteTransaction,
        };
    },
};
</script>