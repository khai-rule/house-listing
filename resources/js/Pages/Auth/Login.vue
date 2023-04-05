<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div class="py-2">
                <label for="email" class="label">E-Mail</label>
                <input
                    id="email"
                    type="text"
                    class="input"
                    v-model="form.email"
                />
                <div v-if="form.errors.email" class="input-error">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="py-2">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    type="password"
                    class="input"
                    v-model="form.password"
                />
                <div v-if="form.errors.password" class="input-error">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="py-4">
                <button class="btn-primary w-full" type="submit">Login</button>

                <div class="mt-4 text-center">
                    <div class="text-sm">
                        Need an account?
                        <Link
                            :href="route('user-account.create')"
                            class="text-gray-500"
                            >Click here
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

// The useForm is automatically connected to the Auth Controller
const form = useForm({
    email: null,
    password: null,
});

const login = () => form.post(route("login.store"));
</script>
