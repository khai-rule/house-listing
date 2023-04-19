<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-wrap items-center gap-2">
                <input
                    v-model="filterForm.deleted"
                    id="deleted"
                    type="checkbox"
                    class="h-4 w-4 rounded borders-gray-300 text-indigo-600 focus:ring-indigo-500"
                />
                <label for="delete">Delete</label>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch } from "vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3";

const filterForm = reactive({
    deleted: false,
});

// reactive / ref / computed
// debounce pe
watch(
    filterForm,
    debounce(
        () =>
            router.get(route("realtor.listing.index"), filterForm, {
                preserveState: true,
                preserveScroll: true,
            }),
        1000
    )
);
/*
You can use an array if you want to watch more than 1
Eg. [() => filterForm.deleted, () => filterForm.others]
watch(
    () => filterForm.deleted,
    (newVal, oldVal) => console.log(newVal, oldVal)
);
*/
</script>
