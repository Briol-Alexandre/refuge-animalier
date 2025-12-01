<template>
    <div
        class="relative col-start-2 col-span-8 row-start-2 row-span-6 bg-softGray/40 rounded-2xl flex flex-col p-5 gap-5">
        <div class="flex justify-between relative">
            <div>
                <dialog ref="modal" class="absolute top-1/2 left-1/2 -translate-1/2 bg-white rounded-btn border border-softGray z-20">
                    <input type="text">
                </dialog>
                <button @click="openModal"
                        class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                    <Filters/>
                    Filtres
                </button>

            </div>

            <input type="search" name="search" id="search"
                   class="bg-white p-1 border rounded-lg border-main-yellow" placeholder="Rechercher…">
        </div>
        <TableComponent
            :cols="cols"
            :fields="fields"
            :rows="rows"
        />
        <Pagination :links="paginationLinks"/>

    </div>
</template>

<script>
import TableComponent from '@/components/TableComponent.vue';
import Pagination from '@/components/Pagination.vue';
import Filters from '@/components/svgs/Filters.vue';

export default {
    name: '',
    components: {Pagination, TableComponent, Filters},
    props: ['cols', 'fields', 'rows', 'paginationLinks'],

    data() {
        return {
        };
    },

    methods: {
        openModal() {
            const modal = this.$refs.modal;
            modal.showModal();
            modal.addEventListener('click', this.clickOutside)
        },
        clickOutside(event) {
            const modal = this.$refs.modal;
            if (event.target === modal) {
                modal.close();
            }
        }
    }
};
</script>

<style>

</style>
