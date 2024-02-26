<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreezeLabel from '@/Components/InputLabel.vue';
import BreezeInput from '@/Components/TextInput.vue';
import Datepicker from '@/Components/Datepicker.vue';
import BreezeTextArea from '@/Components/Textarea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    logbook: Object,
});
// console.log(props);
const form = useForm({
    name: props.logbook.name,
    description: props.logbook.description,
    date: props.logbook.date,
});
const submit = () => {
    form.put(route('logbooks.update', props.logbook.id));
};
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Activity
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('logbooks.index')"
                            >
                                Back
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                                <div className="flex flex-col">
                                    <div className="mb-4">
                                        <BreezeLabel for="name" value="Activity Name" />

                                        <BreezeInput
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.name"
                                            autofocus />
                                        <span className="text-red-600" v-if="form.errors.name">
                                            {{ form.errors.mame }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="description" value="Description" />

                                        <BreezeTextArea
                                            id="description"
                                            class="mt-1 block w-full"
                                            v-model="form.description"
                                            autofocus />
                                        <span className="text-red-600" v-if="form.errors.description">
                                            {{ form.errors.description }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                    <BreezeLabel for="date" value="Date" />

                                    <Datepicker id="date" class="mt-1 block w-full" v-model="form.date"
                                        autofocus/>
                                    <span className="text-red-600" v-if="form.errors.date">
                                        {{ form.errors.date }}
                                    </span>
                                </div>
                                </div>

                                <div className="mt-4">
                                    <button
                                        type="submit"
                                        className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
