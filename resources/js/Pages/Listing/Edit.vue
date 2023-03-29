<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    listing: Object,
});

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});

const update = () =>
    form.put(route("listing.update", { listing: props.listing.id }));
</script>

<template>
    <!-- .prevent is e.preventDefault - prevent it from reloading after submit -->
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input type="text" v-model.number="form.beds" class="input" />
                <div v-if="form.errors.beds" class="error-msg">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input type="text" v-model.number="form.baths" class="input" />
                <div v-if="form.errors.baths" class="error-msg">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input type="text" v-model="form.area" class="input" />
                <div v-if="form.errors.area" class="error-msg">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input type="text" v-model="form.city" class="input" />
                <div v-if="form.errors.city" class="error-msg">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input type="text" v-model="form.code" class="input" />
                <div v-if="form.errors.code" class="error-msg">
                    {{ form.errors.code }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input type="text" v-model="form.street" class="input" />
                <div v-if="form.errors.street" class="error-msg">
                    {{ form.errors.street }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input type="text" v-model="form.street_nr" class="input" />
                <div v-if="form.errors.street_nr" class="error-msg">
                    {{ form.errors.street_nr }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="">Price</label>
                <input type="text" v-model.number="form.price" class="input" />
                <div v-if="form.errors.price" class="error-msg">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-2">
                <button type="submit" class="btn-primary">Update</button>
            </div>
        </div>
    </form>
</template>

<style scoped>
label {
    margin-right: 2em;
}
div {
    padding: 2px;
}
input[type="text"] {
    margin: 8px 0;
    outline: 1px solid black;
}
</style>
