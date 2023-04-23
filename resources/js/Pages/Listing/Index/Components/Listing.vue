<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/UI/ListingSpace.vue";
import Price from "@/Components/UI/Price.vue";
import { useMonthlyPayment } from "@/Composable/useMonthlyPayment";

const props = defineProps({
    listing: Object,
});

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>

<template>
    <Box>
        <div>
            <Link :href="route('listing.show', { listing: listing.id })">
                <ListingAddress :listing="listing" class="text-xl font-bold" />
                <ListingSpace :listing="listing" class="text-sm" />
                <div class="flex items-center gap-2">
                    <Price :price="listing.price" class="text-md" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> per/month
                    </div>
                </div>
            </Link>
        </div>

        <!-- <div>
             By default the method is GET. So we have to specify for this
            <Link
                :href="route('listing.destroy', { listing: listing.id })"
                method="DELETE"
                as="button"
                >Delete</Link
            >
        </div> -->
    </Box>
</template>
