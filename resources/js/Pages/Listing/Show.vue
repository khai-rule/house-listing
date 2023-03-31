<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/UI/ListingSpace.vue";
import Price from "@/Components/UI/Price.vue";
import { ref } from "vue";
import { useMonthlyPayment } from "@/Composable/useMonthlyPayment";

const interestRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
});

const { monthlyPayment } = useMonthlyPayment(
    props.listing.price,
    interestRate,
    duration
);
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
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label"
                        >Interest rate ({{ interestRate }})</label
                    >
                    <input
                        v-model.number="interestRate"
                        type="range"
                        min="0.1"
                        max="3.0"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
                    />

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 my-2">
                        <div class="text-gray-400 my-2">
                            Your monthly payment
                        </div>
                        <Price :price="monthlyPayment" class="text-xl" />
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>
