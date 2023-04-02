<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});

const login = () => form.post(route("login.store"));
</script>

<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div class="py-2">
                <label for="email" class="label">E-Mail (username)</label>
                <input
                    id="email"
                    type="text"
                    class="input"
                    v-model="form.email"
                />
                <div class="input-error">Potential Erros</div>
            </div>

            <div class="py-2">
                <label for="password" class="label">Password (username)</label>
                <input
                    id="password"
                    type="password"
                    class="input"
                    v-model="form.password"
                />
                <div class="input-error">Potential Erros</div>
            </div>

            <div class="py-4">
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
        </div>
    </form>
</template>
