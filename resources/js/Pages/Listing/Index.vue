<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";

defineProps({
    listings: Array,
});
</script>

<template>
    <!-- think of v-for as like a map(). This will render all items in the array -->
    <div v-for="listing in listings" :key="listing.id">
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                <ListingAddress :listing="listing" />
            </Link>
        </div>
        <div>
            <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
        </div>
        <div>
            <!-- By default the method is GET. So we have to specify for this -->
            <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>
        </div>
    </div>
</template>
