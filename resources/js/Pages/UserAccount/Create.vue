<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">

            <div class="py-2">
                <label for="name" class="label">Your Name</label>
                <input
                    id="name"
                    type="text"
                    class="input"
                    v-model="form.name"
                />
                <div v-if="form.errors.name" class="input-error">
                    {{ form.errors.name }}
                </div>
            </div>

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

            <div class="py-2">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    class="input"
                    v-model="form.password_confirmation"
                />
            </div>

            <div class="py-4">
                <button class="btn-primary w-full" type="submit">
                    Create Account
                </button>

                <div class="mt-4 text-center">
                    <div class="text-sm">
                        Already have an account?
                        <Link
                            :href="route('login')"
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
    name: null,
    email: null,
    password: null,
    password_confirmation: null, // This fieldname needs to be exactly this
});

const register = () => form.post(route("user-account.store"));
</script>
