<template>
    <div
        class="relative col-start-2 col-span-8 row-start-2 row-span-6 bg-softGray/40 rounded-2xl flex flex-col p-5 gap-5">
        <div class="flex justify-between items-start">
            <div>
                <slot name="filters"></slot>
            </div>

            <input type="search" name="search" id="search" v-model="search"
                   class="bg-white p-1 border rounded-lg border-main-yellow" placeholder="Rechercher par le nom…">
        </div>
        <TableComponent
            :cols="cols"
            :fields="fields"
            :rows="filteredRows"
            @row-click="openShowModal"
        />
        <Pagination :links="paginationLinks" />
    </div>
    <Teleport to="body">
        <slot />
    </Teleport>
</template>

<script>
import TableComponent from '@/components/TableComponent.vue';
import Pagination from '@/components/Pagination.vue';
import Filters from '@/components/svgs/Filters.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import Modal from '@/components/widget/Modal.vue';
import Close from '@/components/svgs/Close.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import AnimalCreateForm from '@/components/widget/form/AnimalCreateForm.vue';
import { Button } from '@/components/ui/button/index.js';
import AnimalShow from '@/components/Modals/AnimalShow.vue';

export default {
    name: '',
    components: {
        AnimalShow,
        Button,
        Close,
        Pagination,
        TableComponent,
        Filters,
        InputLabel,
        Select,
        Modal,
        ImageAdd,
        TextareaLabel,
        AnimalCreateForm
    },
    props: ['cols', 'fields', 'rows', 'paginationLinks', 'filters'],

    computed: {
        filteredRows() {
            let filtered = this.rows;

            if (this.filters && Object.keys(this.filters).length > 0) {
                const cols = Object.keys(this.filters);

                cols.forEach((col) => {
                    const value = this.filters[col];
                    if (value !== '') {
                        filtered = filtered.filter(row => row[col] === value);
                    }
                });
            }

            if (this.search) {
                const searchTerm = this.search.toLowerCase();
                filtered = filtered.filter(row =>
                    Object.values(row).some(value =>
                        String(value).toLowerCase().includes(searchTerm)
                    )
                );
            }

            return filtered;
        }

    },

    data() {
        return {
            isModalOpen: false,
            isShowModalOpen: false,
            selectedRow: null,
            search: ''
        };
    },

    methods: {
        openModal() {
            this.isModalOpen = !this.isModalOpen;
        },
        openShowModal(row) {
            this.$emit('row-click', row);
        }
    }
};
</script>

<style>

</style>
