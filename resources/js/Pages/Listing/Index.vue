<template>
    <Filters :filters="filters"/>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- think of v-for as like a map(). This will render all items in the array -->
        <Listing
            v-for="listing in listings.data"
            :key="listing.id"
            :listing="listing"
        />

        <div v-if="listings.data.length" class="w-full flex justify-center my-4">
            <Pagination :links="listings.links" />
        </div>
    </div>
</template>

<script setup>
import Listing from "@/Pages/Listing/Index/Components/Listing.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Filters from "@/Pages/Listing/Index/Components/Filters.vue";

// Once we add paginate, it is no longer an array
// defineProps({
//     listings: Array,
// });

defineProps({
    listings: Object,
    filters: Object
});
</script>
