<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

//* page.props.flash.success
const page = usePage();
// This just makes it shorter to write in the HTML
const flashSuccess = computed(() => page.props.flash.success);

// const timer = ref(0);
// setInterval(() => timer.value++, 1000);
</script>

<template>
    <Link href="/listing">Listings</Link>&nbsp;
    <Link href="/listing/create">New Listing</Link>
    <!-- <div>The page with time {{ timer }}</div> -->
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot></slot>
</template>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
