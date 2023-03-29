<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/UI/ListingSpace.vue";
import Price from "@/Components/UI/Price.vue";

defineProps({
    listing: Object,
});
</script>

<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center">
            <div class="w-full text-center text-gray-500">No Images</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>Basic Info</template>
                <ListingAddress :listing="listing" class="text-xl font-bold" />
                <ListingSpace :listing="listing" class="text-sm" />
                <Price :price="listing.price" class="text-md" />
            </Box>

            <Box>
                <template #header> Offer </template>
                Make an offer
            </Box>
        </div>
    </div>
</template>
