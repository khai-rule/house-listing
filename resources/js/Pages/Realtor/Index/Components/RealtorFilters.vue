<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <input
                    v-model="filterForm.deleted"
                    id="deleted"
                    type="checkbox"
                    class="h-4 w-4 rounded borders-gray-300 text-indigo-600 focus:ring-indigo-500"
                />
                <label for="delete">Delete</label>
            </div>

            <div>
                <select class="input-filter-l w-24" v-model="filterForm.by">
                    <option
                        v-for="label in sortLabels"
                        :key="label[0]"
                        :value="label[1]"
                    >
                        {{ label[0] }}
                    </option>
                </select>
                <select class="input-filter-r w-40" v-model="filterForm.order">
                    <option
                        v-for="option in sortOption"
                        :key="option.value"
                        :value="option.value"
                    >
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch, computed } from "vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3";

const sortLabels = [
    ["Added", "created_at"],
    ["Price", "price"],
];

const sortBy = {
    created_at: [
        {
            label: "Latest",
            value: "desc",
        },
        {
            label: "Oldest",
            value: "asc",
        },
    ],
    price: [
        {
            label: "High to Low",
            value: "desc",
        },
        {
            label: "Low to High",
            value: "asc",
        },
    ],
};

const sortOption = computed(() => sortBy[filterForm.by]);

const filterForm = reactive({
    deleted: false,
    by: "created_at",
    order: "desc",
});

// reactive / ref / computed
// debounce pe
watch(
    filterForm,
    // debounce(
    () =>
        router.get(route("realtor.listing.index"), filterForm, {
            preserveState: true,
            preserveScroll: true,
        }),
    1000
    // )
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
